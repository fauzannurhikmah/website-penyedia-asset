<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetDetail extends Model
{
    use HasFactory;
    protected $fillable = ['asset_id', 'user_id', 'software_id', 'render_id', 'file_id', 'category_id', 'image_id', 'preview_id', 'download', 'like'];
    protected $with = ['user', 'image', 'file', 'category', 'tags', 'preview', 'software', 'render'];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class, 'asset_detail_id');
    }

    public function preview()
    {
        return $this->belongsTo(Preview::class);
    }

    public function software()
    {
        return $this->belongsTo(Software::class);
    }

    public function render()
    {
        return $this->belongsTo(Render::class);
    }
}
