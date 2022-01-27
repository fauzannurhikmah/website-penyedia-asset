<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'thumbnail'];

    public function checkRequestFile()
    {
        if (request('thumbnail')) {
            Storage::delete($this->thumbnail);
            $thumbnail = Storage::putFile('category', request('thumbnail'));
        } else {
            $thumbnail = $this->thumbnail;
        }

        return $thumbnail;
    }

    public function assets()
    {
        return $this->hasMany(AssetDetail::class);
    }
}
