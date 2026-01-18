<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\ResponseHelper;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with(['category', 'authors'])->get();
        return ResponseHelper::success('جميع الكتب', $books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        // إنشاء الكتاب بدون الصورة
        $book = Book::create($request->except('cover', 'authors'));

        // رفع الصورة
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = $request->ISBN . "." . $file->extension();
            Storage::putFileAs('book-images', $file, $filename);
            $book->cover = $filename;
            $book->save();
        }

        // ربط المؤلفين بالكتاب
        if ($request->has('authors') && is_array($request->authors)) {
            $book->authors()->attach($request->authors);
        }

        // تحميل العلاقات لإرجاعها في الاستجابة
        $book->load(['category', 'authors']);

        return ResponseHelper::success("تمت إضافة الكتاب", $book);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book->load(['category', 'authors']);
        return ResponseHelper::success("تفاصيل الكتاب", $book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        // تحديث بيانات الكتاب بدون الصورة والمؤلفين
        $book->update($request->except('cover', 'authors'));

        // معالجة تعديل صورة الكتاب
        if ($request->hasFile('cover')) {
            // حذف الصورة القديمة
            if ($book->cover) {
                Storage::delete('book-images/' . $book->cover);
            }

            // رفع الصورة الجديدة
            $file = $request->file('cover');
            $filename = $request->ISBN . "." . $file->extension();
            Storage::putFileAs('book-images', $file, $filename);
            $book->cover = $filename;
            $book->save();
        }

        // sync للمؤلفين (يحذف القديم ويضيف الجديد)
        if ($request->has('authors') && is_array($request->authors)) {
            $book->authors()->sync($request->authors);
        }

        // تحميل العلاقات
        $book->load(['category', 'authors']);

        return ResponseHelper::success("تمت تعديل الكتاب", $book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {

        // حذف الصورة إن وجدت
        if ($book->cover) {
            Storage::delete('book-images/' . $book->cover);
        }

        // حذف علاقات المؤلفين
        $book->authors()->detach();

        $book->delete();
        return ResponseHelper::success("تمت حذف الكتاب", $book);
    }
}
