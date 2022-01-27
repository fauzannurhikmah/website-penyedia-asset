<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'description', 'licensing'];
    protected $with = ['detail'];

    public function detail()
    {
        return $this->hasMany(AssetDetail::class);
    }
}
