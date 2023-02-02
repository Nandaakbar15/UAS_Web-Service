<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ProdukController extends Controller{
    // fungsi untuk melihat semua data
    public function index()
    {
        $produk = Produk::OrderBy("id", "DESC")->get();

        // $response = [
        //     "total_count" => $produk["total"],
        //     "limit" => $produk["per_page"],
        //     "pagination" => [
        //         "next_page" => $produk["next_page_url"],
        //         "current_page" => $produk["current_page"]
        //     ],
        //     "data" => $produk["data"],
        // ];


        return response()->json($produk, 200);
    }

    // fungsi menambahkan data
    public function store(Request $request)
    {
        $acceptHeader = $request->header('Accept');
        $contentTypeHeader = $request->header('Content-Type');

        if($acceptHeader === 'application/json'){
            $input = $request->all();
            $validationRules = [
                'nama_produk' => 'required',
                'harga_produk' => 'required',
                'deskripsi_produk' => 'required',
                'user_id' => 'required',
            ];

            $validator = Validator::make($input, $validationRules);

            if ($validator->fails()){
                return response()->json($validator->errors(),400);
            }

            $produk = Produk::create($input);
            return response()->json($produk, 200);
        } else {
            return response("Media tidak support!", 415);
        }
    }


    // fungsi melihat data berdasarkan id nya
    public function show(Request $request, $id)
    {
        $acceptHeader = $request->header('Accept');

        if($acceptHeader === 'application/json'){
            $produk = Produk::select('id','nama_produk')->find($id);

            if(!$produk){
                abort(404);
            }
    
            return response()->json($produk, 200);
        } else {
            return response("Media tidak support!", 415);
        }

    }


    // fungsi untuk mengupdate data atau mengedit data
    public function update(Request $request, $id)
    {
        $acceptHeader = $request->header('Accept');

        if($acceptHeader === 'application/json'){
            $input = $request->all();

            $produk = Produk::find($id);

            if(!$produk){
                abort(404);
            }

            $validationRules = [
                'nama_produk' => 'required',
                'harga_produk' => 'required',
                'deskripsi_produk' => 'required',
                'user_id' => 'required',
            ];

            $validator = Validator::make($input, $validationRules);

            if ($validator->fails()){
                return response()->json($validator->errors(),400);
            }

            $produk->fill($input);
            $produk->save();

            return response()->json($produk, 200);
        } else {
            return response("Media tidak support", 415);
        }
    }

    public function destroy(Request $request, $id )
    {
        $acceptHeader = $request->header('Accept');

        if($acceptHeader == 'application/json')
        {
            $produk = Produk::find($id);

            $produk->delete();
            $message = ['message' => 'Data berhasil di hapus', 'id_produk' => $id];

            return response()->json($message, 200);
        } else {
            return response("Media tidak support untuk method request ini", 415);
        }


    }
}