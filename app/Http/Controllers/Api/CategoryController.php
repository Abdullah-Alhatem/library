<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\ResponseHelper;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories =  Category::all();
        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|unique:categories'
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return ResponseHelper::success("تمت إضافة الصنف" , $category);
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => "required|max:50|unique:categories,name,$id"
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        return ResponseHelper::success("تم تعديل الصنف" , $category);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return ResponseHelper::success("تم حذف الصنف" , $category);
    }
}
