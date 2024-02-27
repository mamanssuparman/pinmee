<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MengikutiController extends Controller
{
    public function getdatamengikuti(Request $request, $id){
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
}
