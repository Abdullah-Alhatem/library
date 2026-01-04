<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\ResponseHelper;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();
        return ResponseHelper::success('جميع المؤلفين', $authors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:70|unique:authors'
        ]);

        $author = new Author();
        $author->name = $request->name;
        $author->save();

        return ResponseHelper::success("تمت إضافة المؤلف", $author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => "required|max:70|unique:authors,name,$id"
        ]);

        $author = Author::find($id);

        if (!$author) {
            return ResponseHelper::failed("المؤلف غير موجود");
        }

        $author->name = $request->name;
        $author->save();

        return ResponseHelper::success("تم تعديل المؤلف", $author);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return ResponseHelper::failed("المؤلف غير موجود");
        }

        $author->delete();

        return ResponseHelper::success("تم حذف المؤلف", $author);
    }
}
