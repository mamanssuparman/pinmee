<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PinController extends Controller
{
    public function getdatapin(Request $request, $id){
        $dataUser = User::where('id', $id)->first();
        $dataJumlahFollower = DB::select('SELECT COUNT(id_user) as jmlfollower FROM follows where id_follow ='.$id);
        $dataJumlahFollow   = DB::select('SELECT COUNT(id_follow) as jmlfollow FROM follows where id_user ='.$id);
        $dataFollow         = Follow::where('id_follow', $id)->where('id_user', auth()->user()->id)->first();
        return response()->json([
            'dataUser'          => $dataUser,
            'jumlahFollower'    => $dataJumlahFollower,
            'jumlahFollow'      => $dataJumlahFollow,
            'dataUserActive'    => auth()->user()->id,
            'dataFollow'        => $dataFollow
        ], 200);
    }

    public function getdata(Request $request){
        $explore = Foto::with(['likefotos', 'favorites'])->withCount(['likefotos', 'comments'])->where('id_user', $request->idUser)->paginate(4);
        return response()->json([
            'data'      => $explore,
            'statuscode'    => 200,
            'idUser'        => auth()->user()->id
        ]);
    }
    public function getdatamypin(Request $request){
        $id= auth()->user()->id;
        $dataUser       = User::where('id', $id)->firstOrFail();
        $dataJumlahPengikut      = DB::select('SELECT COUNT(id_follow) as jmlpengikut FROM follows where id_follow='.$id);
        $dataJumlahmengikut      = DB::select('SELECT COUNT(id_follow) as jmlmengikuti FROM follows where id_user='.$id);
        $dataFollower           = Follow::with('user')->where('id_follow', $id)->get();
        return response()->json([
            'datauser'      => $dataUser,
            'datajumlahpengikut'    => $dataJumlahPengikut,
            'datajumlahmengikuti'   => $dataJumlahmengikut,
            'dataFollower'          => $dataFollower,
        ], 200);
    }

    public function savepin(Request $request){
        $request->validate([
            'filefoto'      => 'required|mimes:png,jpg|max:1024',
            'judul'         => 'required',
            'deskripsi'     => 'required'
        ]);

        $file_foto          = $request->file('filefoto');
        $ektensi_foto       = $file_foto->extension();
        $nama_foto          = 'Pinme-'.date('dmyhis').'.'.$ektensi_foto;
        $file_foto->move(public_path('/assets'), $nama_foto);
        $data_store = [
            'judul_foto'        => $request->judul,
            'deskripsi_foto'    => $request->deskripsi,
            'url'               => $nama_foto,
            'id_user'           => auth()->user()->id
        ];
        Foto::create($data_store);
        return redirect()->back()->with('success', 'Data berhasil di simpan');
    }
}
