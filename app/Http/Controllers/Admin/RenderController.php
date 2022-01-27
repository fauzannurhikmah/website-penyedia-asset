<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Render;

class RenderController extends Controller
{
    public function index()
    {
        return view('admin.render.index');
    }

    public function getData()
    {
        $render = Render::select(['id', 'name', 'slug'])->orderBy('id', 'desc')->get();
        return response()->json($render, 200);
    }

    public function getSeparateData()
    {
        $render = Render::orderBy('id', 'desc')->paginate(6);
        if (request('keywords')) {
            $render = Render::where('name', 'LIKE', '%' . request('keywords') . '%')->paginate(6);
        }
        return response()->json($render, 200);
    }

    public function create()
    {
        request()->validate(['render' => 'required|unique:renders,name']);
        $data = Render::create([
            'name' => request('render'),
            'slug' => \Str::slug(request('render')),
        ]);

        return response()->json($data, 200);
    }

    public function show(Render $render)
    {
        $render = $render->only(['name', 'slug']);
        return response()->json($render, 200);
    }

    public function update(Render $render)
    {
        request()->validate(['render' => 'required|unique:renders,name,' . $render->id]);
        $render->update([
            'name' => request('render'),
            'slug' => \Str::slug(request('render')),
        ]);

        return response()->json(null, 200);
    }

    public function destroy(Render $render)
    {
        $render->delete();
        return response()->json(null, 200);
    }
}
