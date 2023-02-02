<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Produk extends Migration{
    
    public function up(){
        Schema::create('produk', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string("nama_produk");
            $table->string("harga_produk");
            $table->string("deskripsi_produk");
            $table->integer('user_id')->index('user_id_foreign');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('produk');
    }
}