<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konsumen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Kernel;

class KonsumenController extends Controller{
    // fungsi melihat semua data
    public function index()
    {
        $konsumen = Konsumen::OrderBy("id", "DESC")->get();
        return response()->json($konsumen, 200);
    }

    // fungsi membuat data
    public function store(Request $request)
    {
        $acceptHeader = $request->header("Accept");

        if($acceptHeader == 'application/json'){
            $input = $request->all();
            $validationRules = [
                'nama_konsumen' => 'required|min:5',
                'alamat' => 'required|min:5',
                'telp' => 'required',
                'email' => 'required',
                'user_id' => 'required',
            ];

            $validator = Validator::make($input, $validationRules);

            if ($validator->fails()){
                return response()->json($validator->errors(),400);
            }

            $konsumen = Konsumen::create($input);
            return response()->json($konsumen, 200);
        } else {
            return response("Media tidak support!", 300);
        }
    }

    // fungsi melihat data hanya berdasarkan idnya saja
    public function show(Request $request, $id)
    {
        $acceptHeader = $request->header("Accept");
        
        if($acceptHeader == 'application/json'){
            $konsumen = Konsumen::select('id','nama_konsumen')->find($id);

            if(!$konsumen){
                abort(404);
            }
    
            return response()->json($konsumen, 200);
        } else {
            return response("Media tidak support", 400);
        }
    }

    // fungsi untuk mengedit data
    public function update(Request $request, $id)
    {
        $acceptHeader = $request->header("Accept");

        if($acceptHeader === 'application/json'){
            $input = $request->all();

            $konsumen = Konsumen::find($id);

            if(!$konsumen){
                abort(404);
            }

            $validationRules = [
                'nama_konsumen' => 'required|min:5',
                'alamat' => 'required|min:5',
                'telp' => 'required',
                'email' => 'required',
                'user_id' => 'required',
            ];

            $validator = Validator::make($input, $validationRules);

            if ($validator->fails()){
                return response()->json($validator->errors(),400);
            }

            $konsumen->fill($input);
            $konsumen->save();

            return response()->json($konsumen, 200);
        } else {
            return response("Media tidak support", 400);
        }
    }

    public function destroy(Request $request, $id)
    {
        $acceptHeader = $request->header('Accept');

        if($acceptHeader == 'application/json')
        {
            $konsumen = Konsumen::find($id);

            $konsumen->delete();
            $message = ['message' => 'Data berhasil di hapus', 'id_konsumen' => $id];

            return response()->json($message, 200);
        } else {
            return response("Media tidak support untuk method request ini", 415);
        }
    }

}