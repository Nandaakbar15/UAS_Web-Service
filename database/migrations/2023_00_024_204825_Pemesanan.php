<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pemesanan extends Migration{
    
    public function up(){
        Schema::create('Pemesanan', function (Blueprint $table) {
            $table->increments("id_pemesanan")->unique();
            $table->integer("id_konsumen")->index("id_konsumen_foreign");
            $table->string("total_biaya");
            $table->string("status");
            $table->string("tanggal");
            $table->integer('user_id')->index('user_id_foreign');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('Pemesanan');
    }
}