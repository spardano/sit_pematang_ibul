<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Bumdes;

class BumdesController extends Controller
{
    public function getBumdes()
    {
        $bumdes = Bumdes::orderBy('created_at', 'desc')->get();

        $data_baru = array();
        $multiplied = $bumdes->map(function ($item) {

            $temp['id'] = $item->id;
            $temp['nama_usaha'] = $item->nama_usaha;
            $temp['jenis_usaha'] = $item->jenis_usaha;
            $temp['pengelola'] = $item->pengelola;
            $temp['lokasi'] = $item->lokasi;
            $temp['alamat'] = $item->alamat;
            $temp['thumbnail'] = $item->getFirstMediaUrl('bumdes');
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
