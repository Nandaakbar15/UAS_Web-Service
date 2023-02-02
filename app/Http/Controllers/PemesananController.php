<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PemesananController extends Controller{
    // fungsi untuk melihat semua data
    public function index()
    {
        $pemesanan = Pemesanan::OrderBy("id", "DESC")->get();
        return response()->json($pemesanan, 200);
    }

    // fungsi untuk menambahkan data
    public function store(Request $request)
    {
        $acceptHeader = $request->header('Accept');

        if($acceptHeader == 'application/json')
        {
            $input = $request->all();
            $validationRules = [
                'id_konsumen' => 'required',
                'total_biaya' => 'required',
                'status' => 'required',
                'tanggal' => 'required'
            ];

            $validator = Validator::make($input, $validationRules);

            if ($validator->fails()){
                return response()->json($validator->errors(),400);
            }

            $pemesanan = Pemesanan::create($input);
            return response()->json($pemesanan, 200);
        } else {
            return response("Media tidak support", 400);
        }
    }

    // fungsi melihat data berdasarkan id nya saja
    public function show(Request $request, $id)
    {
        $acceptHeader = $request->header('Accept');

        if($acceptHeader == 'application/json'){
            $pemesanan = Pemesanan::select('id_pemesanan')->find($id);

            if(!$pemesanan){
                abort(404);
            }
    
            return response()->json($pemesanan, 200);
        } else {
            return response("Media tidak support", 400);
        }
    }

    // fungsi untuk mengedit data
    public function update(Request $request, $id)
    {
        $acceptHeader = $request->header('Accept');

        if($acceptHeader == 'application/json'){
            $input = $request->all();

            $pemesanan = Pemesanan::find($id);

            if(!$pemesanan){
                abort(404);
            }

            $validationRules = [
                'id_konsumen' => 'required',
                'total_biaya' => 'required',
                'status' => 'required',
                'tanggal' => 'required'
            ];

            $validator = Validator::make($input, $validationRules);

            if ($validator->fails()){
                return response()->json($validator->errors(),400);
            }

            $pemesanan->fill($input);
            $pemesanan->save();

            return response()->json($pemesanan, 200);
        } else {
            return response("Media tidak support!", 404);
        }
    }

    // fungsi untuk menghapus data
    public function destroy(Request $request, $id)
    {
        $acceptHeader = $request->header('Accept');

        if($acceptHeader == 'application/json'){
            $pemesanan = Pemesanan::find($id);

            $pemesanan->delete();
            $message = ['message' => 'Data berhasil di hapus', 'id_pemesanan' => $id];

            return response()->json($message, 200);
        } else {
            return response("Media tidak support", 404);
        }
    }
}