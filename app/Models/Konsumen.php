<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model{
    protected $table = "konsumen";

    protected $fillable = ["nama_konsumen", "alamat", "telp", "email", "user_id"];

    public $timestamps = true;
}