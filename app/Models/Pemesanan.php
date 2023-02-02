<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model{
    protected $table = "pemesanan";

    protected $fillable = ["id_konsumen", "total_biaya", "status", "tanggal"];

    public $timestamps = true;
}