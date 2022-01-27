<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Models\{Asset, AssetDetail, File, Image, Preview, Tag, User};
use Illuminate\Support\Facades\{DB, Request, Storage};
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function store(UploadRequest $request)
    {
        DB::beginTransaction();
        try {
            $asset = Asset::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'licensing' => $request->licensing,
            ]);

            $preview = Preview::create([
                'youtube_link' => $request->youtube,
                'sketchfab_link' => $request->sketchfab,
            ]);

            $fileName = Storage::putFile('file3d', $request->file('file'));
            $file = File::create([
                'name' => $fileName,
                'size' => $request->file('file')->getSize()
            ]);

            $previewName = Storage::putFile('preview', $request->file('preview'));
            $imagePreview = Image::create([
                'name' => $previewName,
                'size' => $request->file('preview')->getSize()
            ]);

            $user = User::whereId($request->user_id)->first();
            $asset_detail = $user->assets()->create([
                'asset_id' => $asset->id,
                'software_id' => $request->software,
                'file_id' => $file->id,
                'render_id' => $request->render,
                'category_id' => $request->category,
                'image_id' => $imagePreview->id,
                'preview_id' => $preview->id,
                'download' => 0,
                'like' => 0
            ]);

            $tags = Str::of($request->tags)->explode(',');
            foreach ($tags as $tag) {
                if ($tag != "ti-valid") {
                    Tag::create([
                        'asset_detail_id' => $asset_detail->id,
                        'name' => Str::lower($tag),
                        'slug' => Str::slug($tag),
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            Storage::delete([$fileName, $previewName]);
            DB::rollback();
            return response()->json($e, 500);
        }
        return response()->json(null, 200);
    }

    public function download(Asset $asset)
    {
        if (auth()->check()) {
            $user = User::whereId(auth()->id())->first();
            if ($asset->licensing) {
                return redirect()->route('subcription');
                // can beres
            } else {
                if (!$user->downloads()->where('asset_id', $asset->id)->first() && $user->id != $asset->detail->first()->user_id) {
                    $downloader = $asset->detail->first()->download;
                    $asset->detail()->update(['download' => $downloader + 1]);
                    $user->downloads()->create(['asset_id' => $asset->id]);
                }
                return Storage::download($asset->detail->first()->file->name, $asset->name);
            }
        }
    }
}
