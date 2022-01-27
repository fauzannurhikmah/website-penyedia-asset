<?php

namespace App\Http\Controllers;

use App\Models\{Asset, AssetDetail, Category, Download};
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

    public function index()
    {
        $assets = Asset::orderBy('id', 'desc')->limit(4)->get();
        $allAsset = Asset::all()->count();
        return view('home', compact('assets', 'allAsset'));
    }

    public function show(Asset $asset)
    {
        return view('detail-asset', compact('asset'));
    }

    public function allShow()
    {
        $assets = Asset::orderBy('id', 'desc')->paginate(9);
        if (request('sort_by') == 'newest')
            $assets = Asset::orderBy('id', 'asc')->paginate(9);

        if (request('sort_by') == 'oldest')
            $assets = Asset::orderBy('id', 'desc')->paginate(9);

        if (request('search')) {
            $assets = Asset::where('name', 'LIKE', '%' . request('search') . '%')->paginate(9);
        }
        return view('all-assets', compact('assets'));
    }

    public function category()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('categories', compact('categories'));
    }

    public function listDownload()
    {
        $downloads = Download::where('user_id', auth()->id())->paginate(10);
        return view('download-history', compact('downloads'));
    }

    public function listUpload()
    {
        return view('upload-list');
    }

    public function myAssets()
    {
        $uploads = AssetDetail::with('asset')->where('user_id', request('user'))->orderBy('id', 'desc')->paginate(10);
        return response()->json($uploads, 200);
    }

    public function deletMyAssets(AssetDetail $asset)
    {
        $asset->tags()->delete();
        if ($asset->preview())
            $asset->preview()->delete();

        if ($asset->image())
            Storage::delete($asset->image->name);

        if ($asset->file())
            Storage::delete($asset->file->name);

        $asset->asset()->delete();
        return response()->json(null, 200);
    }

    public function byCategory(Category $category)
    {
        $assets = AssetDetail::with('asset')->where('category_id', $category->id)->paginate(9);
        return view('sort-list-by', compact('assets'));
    }
}
