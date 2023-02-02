<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datapesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class DataPesananController extends Controller{
    // fungsi untuk melihat semua data
    public function index()
    {
        $datapesanan = Datapesanan::OrderBy("id", "DESC")->get();
        // $response = [
        //     "total_count" => $datapesanan["total"],
        //     "limit" => $datapesanan["per_page"],
        //     "pagination" => [
        //         "next_page" => $datapesanan["next_page_url"],
        //         "current_page" => $datapesanan["current_page"]
        //     ],
        //     "data" => $datapesanan["data"],
        // ];


        // return response()->json($response, 200);
        return response()->json($datapesanan, 200);
    }

    public function store(Request $request)
    {
        $acceptHeader = $request->header('Accept');
        $contentTypeHeader = $request->header('Content-Type');

        if($acceptHeader === 'application/json'){
            $input = $request->all();
            $validationRules = [
                'id_produk' => 'required',
                'jumlah_beli' => 'required',
                'jumlah_harga' => 'required',
            ];

            $validator = Validator::make($input, $validationRules);

            if ($validator->fails()){
                return response()->json($validator->errors(),400);
            }

            $datapesanan = Datapesanan::create($input);
            return response()->json($datapesanan, 200);
        } else {
            return response("Media tidak support!", 415);
        }
    }

     // fungsi melihat data berdasarkan id nya
     public function show(Request $request, $id)
     {
         $acceptHeader = $request->header('Accept');
 
         if($acceptHeader === 'application/json'){
             $datapesanan = Datapesanan::select('id_pemesanan','id_produk')->find($id);
 
             if(!$datapesanan){
                 abort(404);
             }
     
             return response()->json($datapesanan, 200);
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

            $datapemesanan = Datapesanan::find($id);

            if(!$datapemesanan){
                abort(404);
            }

            $validationRules = [
                'id_produk' => 'required',
                'jumlah_beli' => 'required',
                'jumlah_harga' => 'required',
            ];

            $validator = Validator::make($input, $validationRules);

            if ($validator->fails()){
                return response()->json($validator->errors(),400);
            }

            $datapemesanan->fill($input);
            $datapemesanan->save();

            return response()->json($datapemesanan, 200);
        } else {
            return response("Media tidak support", 415);
        }
    }

    public function destroy(Request $request, $id )
    {
        $acceptHeader = $request->header('Accept');

        if($acceptHeader == 'application/json')
        {
            $datapemesanan = Datapesanan::find($id);

            $datapemesanan->delete();
            $message = ['message' => 'Data berhasil di hapus', 'id_pemesanan' => $id];

            return response()->json($message, 200);
        } else {
            return response("Media tidak support untuk method request ini", 415);
        }


    }
}