<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\PengajuanLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PengajuanController extends Controller
{
    public function getPengajuan(Request $request)
    {
        $pengajuan = PengajuanLayanan::with('layanan_desa')->where('id_user', $request['user']['id'])->get();

        $data_baru = array();
        $multiplied = $pengajuan->map(function ($item) {
            $temp['id'] = $item->id;
            $temp['status_pengajuan'] = $item->status_pengajuan;
            $temp['alasan_penolakan'] = $item->alasan_penolakan;
            $temp['nama_layanan'] = $item->layanan_desa->nama_layanan;
            $temp['path_dokumen'] = URL::to($item->id . '/download/pdf');
            $temp['created_at'] = $item->created_at;
            return $temp;
        });

        $data_baru = $multiplied->all();

        return response()->json([
            'status' => true,
            'data' => $data_baru
        ]);
    }
}
