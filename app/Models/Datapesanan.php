<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datapesanan extends Model{
    protected $table = "datapesanan";

    protected $fillable = ["id_produk", "jumlah_beli", "jumlah_harga"];

    public $timestamps = true;
}