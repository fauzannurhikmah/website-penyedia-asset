<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Software;

class SoftwareController extends Controller
{
    public function index()
    {
        return view('admin.software.index');
    }

    public function getData()
    {
        $software = Software::select(['id', 'name', 'slug'])->orderBy('created_at', 'desc')->get();
        return response()->json($software, 200);
    }

    public function getSeparateData()
    {
        $software = Software::orderBy('id', 'desc')->paginate(6);
        if (request('keywords')) {
            $software = Software::where('name', 'LIKE', '%' . request('keywords') . '%')->paginate(6);
        }
        return response()->json($software, 200);
    }

    public function show(Software $software)
    {
        $software = $software->only(['name', 'slug']);
        return response()->json($software, 200);
    }

    public function create()
    {
        request()->validate(['software' => 'required|unique:software,name']);
        $data = Software::create([
            'name' => request('software'),
            'slug' => \Str::slug(request('software'))
        ]);

        return response()->json($data, 200);
    }

    public function update(Software $software)
    {
        request()->validate(['software' => 'required|unique:software,name,' . $software->id]);
        $software->update([
            'name' => request('software'),
            'slug' => \Str::slug(request('software'))
        ]);
        return response()->json(null, 200);
    }

    public function destroy(Software $software)
    {
        $software->delete();
        return response()->json(null, 200);
    }
}
