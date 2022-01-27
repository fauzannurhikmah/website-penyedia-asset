<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetDetailsTable extends Migration
{

    public function up()
    {
        Schema::create('asset_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->references('id')->on('assets')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('software_id');
            $table->foreignId('render_id');
            $table->foreignId('file_id');
            $table->foreignId('category_id');
            $table->foreignId('image_id');
            $table->foreignId('preview_id')->nullable();
            $table->integer('download')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_details');
    }
}
