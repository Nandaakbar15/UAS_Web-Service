<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Konsumen extends Migration{
    
    public function up(){
        Schema::create('Konsumen', function (Blueprint $table) {
            $table->increments("id")->unique();
            $table->string("nama_konsumen");
            $table->string("alamat");
            $table->string("telp");
            $table->string("email");
            $table->integer('user_id')->index('user_id_foreign');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('Konsumen');
    }
}