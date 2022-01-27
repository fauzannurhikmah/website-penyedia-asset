<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function getData()
    {
        $categories = Category::select(['id', 'name', 'slug', 'thumbnail'])->orderBy('created_at', 'DESC')->get();
        return response()->json($categories, 200);
    }

    public function getSeparateData()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(6);
        if (request('keywords')) {
            $categories = Category::where('name', 'LIKE', '%' . request('keywords') . '%')->paginate(6);
        }
        return response()->json($categories, 200);
    }

    public function store()
    {
        request()->validate(['category' => 'required|unique:categories,name', 'thumbnail' => 'required|image|mimes:jpg,png,jpeg|max:1024']);
        $thumbnail = Storage::putFile('category', request('thumbnail'));
        $data = Category::create([
            'name' => request('category'),
            'thumbnail' => $thumbnail,
            'slug' => Str::slug(request('category')),
        ]);

        return response()->json($data, 200);
    }

    public function show(Category $category)
    {
        return response()->json($category, 200);
    }

    public function update(Category $category)
    {
        request()->validate(['category' => 'required|unique:categories,name,' . $category->id, 'thumbnail' => 'image|mimes:jpg,png,jpeg|max:1024']);
        $data = $category->update([
            'name' => request('category'),
            'thumbnail' => $category->checkRequestFile(),
            'slug' => Str::slug(request('category')),
        ]);
        return response()->json(request(), 200);
    }

    public function destroy(Category $category)
    {
        Storage::delete($category->thumbnail);
        $category->delete();
        return response()->json(null, 200);
    }
}
