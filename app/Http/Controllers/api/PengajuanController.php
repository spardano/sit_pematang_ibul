<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\PengajuanLayanan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function getPengajuan(Request $request)
    {
        $pengajuan = PengajuanLayanan::with('layanan_desa')->where('id_user', $request['user']['id'])->get();
        return response()->json([
            'status' => true,
            'data' => $pengajuan
        ]);
    }
}
