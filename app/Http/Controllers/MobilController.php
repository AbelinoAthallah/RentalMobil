<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Mobil_model;
use Auth;

class MobilController extends Controller
{
    public function store(Request $request)
    {
        if(Auth::User()->level=="admin"){
        $validator=Validator::make($request->all(),[
            'nama_mobil'=>'required',
            'id_jenis_mobil'=>'required',
            'plat_nomer'=>'required',
            'kondisi'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),
            400);
        }else{
            $insert=Mobil_model::insert([
                'nama_mobil'=>$request->nama_mobil,
                'id_jenis_mobil'=>$request->id_jenis_mobil,
                'plat_nomer'=>$request->plat_nomer,
                'kondisi'=>$request->kondisi
            ]);
            if($insert){
                $status="Sukses menambahkan data!";
            }else{
                $status="Gagal menambahkan data!";
            }
            return response()->json(compact('status'));
        }
        }else{
        return response()->json(['status'=>'anda bukan admin']);
        }
    }

    public function update($id,Request $req)
    {
        if(Auth::User()->level=="admin"){
        $validator=Validator::make($req->all(),
        [
            'nama_mobil'=>'required',
            'id_jenis_mobil'=>'required',
            'plat_nomer'=>'required',
            'kondisi'=>'required'
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah=Mobil_model::where('id', $id)->update([
            'nama_mobil'=>$req->nama_mobil,
            'id_jenis_mobil'=>$req->id_jenis_mobil,
            'plat_nomer'=>$req->plat_nomer,
            'kondisi'=>$req->kondisi
        ]);
        if($ubah){
            return Response()->json(['status'=>'Data berhasil diubah!']);
        }else{
            return Response()->json(['status'=>'Data gagal diubah!']);
        }
        }else{
        return response()->json(['status'=>'anda bukan admin']);
        }
    }
    public function destroy($id)
    {
        if(Auth::User()->level=="admin"){
        $hapus=Mobil_model::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>'Data berhasil dihapus!']);
        }else{
            return Response()->json(['status'=>'Data gagal dihapus!']);
        }
        }else{
        return response()->json(['status'=>'anda bukan admin']);
        }
    }

    public function tampil_mobil()
    {
        if(Auth::User()->level=="admin"){
        $data_mobil=Mobil_model::get();
        return Response()->json($data_mobil);
        
        }else{
        return response()->json(['status'=>'anda bukan admin']);
        }
    }
}
