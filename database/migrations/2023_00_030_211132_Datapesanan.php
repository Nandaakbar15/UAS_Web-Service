<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Datapesanan extends Migration{
    
    public function up(){
        Schema::create('Datapesanan', function (Blueprint $table) {
            $table->increments('id_pemesanan')->unique();
            $table->integer('id_produk')->index('id_produk_foreign');
            $table->integer('jumlah_beli')->unsigned();
            $table->integer('jumlah_harga')->unsigned();
            $table->integer('user_id')->index('user_id_foreign');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('Datapesanan');
    }
}