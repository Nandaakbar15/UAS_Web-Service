<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model{
    protected $table = "produk";

    protected $fillable = ["nama_produk", "harga_produk", "deskripsi_produk", "user_id"];

    public $timestamps = true;
}