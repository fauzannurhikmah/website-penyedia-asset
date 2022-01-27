<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;

class AssetController extends Controller
{
    public function index()
    {
        return view('admin.asset.index');
    }

    public function getData()
    {
        $assets = Asset::orderBy('id', 'desc')->paginate(10);
        return response()->json($assets, 200);
    }

    public function show(Asset $asset)
    {
        return view('admin.asset.show', compact('asset'));
    }
}
