<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'asset_id', 'history'];
    protected $with = ['asset'];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
