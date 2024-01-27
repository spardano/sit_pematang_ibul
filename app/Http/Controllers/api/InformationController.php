<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function getInformations()
    {
        $info = Informasi::where('status_publish', 1)->orderBy('created_at', 'desc')->get();

        $data_baru = array();
        $multiplied = $info->map(function ($item) {

            $temp['id'] = $item->id;
            $temp['judul_informasi'] = $item->judul_informasi;
            $temp['deskripsi'] = $item->deskripsi;
            $temp['penulis'] = $item->user->name;
            $temp['thumbnail'] = $item->getFirstMediaUrl('informasi');
            $temp['created_at'] = $item->created_at;
            return $temp;
        });

        $data_baru = $multiplied->all();

        return response()->json([
            'status' => true,
            'data' => $data_baru
        ]);
    }

    public function getSingleInformations($id)
    {
        $info = Informasi::with('user')->where('id', $id)->first();
        $data['informasi'] = $info;
        $data['gambar'] = $info->getFirstMediaUrl('informasi');

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }
}
