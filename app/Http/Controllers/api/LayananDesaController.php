<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\LayananDesa;
use App\Models\PengajuanLayanan;
use App\Models\PivotLayananField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class LayananDesaController extends Controller
{


    public function checkPengajuan(Request $request, $id_layanan)
    {
        $pengajuan = PengajuanLayanan::where('id_user', $request['user']['id'])->where('id_layanan_desa', $id_layanan)->where('status_pengajuan', 1)->first();

        if ($pengajuan) {
            return response()->json([
                'status' => false,
                'message' => 'Anda Sudah Melakukan Pengajuan Layanan Ini, Silahkan Tunggu hingga Proses Selesai'
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Anda bisa melakukan leyanan'
        ]);
    }

    public function getLayanan(Request $request)
    {

        $layananDesa = LayananDesa::all();

        return response()->json([
            'status' => true,
            'data' => $layananDesa
        ]);
    }

    public function getDetailLayanan(Request $request, $id)
    {
        $layananDetail = LayananDesa::where('id', $id)->first();

        $data['layanan'] = $layananDetail;

        $data['field'] = $layananDetail->field->map(function ($item) {

            $temp['name'] = $item->field->name;
            $temp['label'] = $item->field->label;
            $temp['placeholder'] = $item->field->placeholder;
            $temp['type'] = $item->field->type;
            $temp['helper_text'] = $item->field->helper_text;
            $temp['required'] = $item->field->required;

            if ($item->field->type == 'select') {
                $temp['options'] = explode(",", $item->field->options);
            } else {
                $temp['options'] =  $item->field->options;
            }

            return $temp;
        });

        if ($layananDetail) {
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        }

        return response()->json([
            'status' => false,
            'data' => 'Layanan Tidak Tersedia'
        ]);
    }

    public function storeLayanan(Request $request, $id_layanan)
    {

        $field_layanan = PivotLayananField::with('field')->where('id_layanan_desa', $id_layanan)->get();

        foreach ($field_layanan as $item) {
            if ($item->field->type != 'document') {
                $obj_field[$item->field->name] = $request[$item->field->name];
            }
        }

        $pengajuan = PengajuanLayanan::updateOrCreate([
            'id_user' => $request['user']['id'],
            'id_layanan_desa' => $id_layanan,
            'status_pengajuan' => 0
        ], [
            'id_user' => $request['user']['id'],
            'id_layanan_desa' => $id_layanan,
            'nik' => $request['user']['nik'],
            'data_field' => json_encode($obj_field),
            'status_pengajuan' => 1
        ]);

        if ($pengajuan) {
            return response()->json([
                'status' => true,
                'message' => 'Pengajuan Berhasil Disimpan'
            ]);
        }
    }

    public function uploadBerkas(Request $request, $id_layanan, $field_name)
    {

        $cekPengajuanLayanan = PengajuanLayanan::where('id_user', $request['user']['id'])->where('id_layanan_desa', $id_layanan)->where('status_pengajuan', 1)->first();

        if ($cekPengajuanLayanan) {
            return response()->json([
                'status' => false,
                'message' => 'Anda sudah melakukan pengajuan untuk layanan ini dan pengajuan sedang dalam proses'
            ]);
        }

        if (!$request->has('file')) {
            return response()->json([
                'status' => false,
                'message' => 'Dokument tidak ditemukan'
            ], 422);
        }

        $dokumenRename = time() . '_' . $request->field . '_' . $request['user']['id'] . '.' . $request->file->extension();
        $path = '/berkas/layanan_desa';
        $destinationPath = public_path($path);
        $request->file->move($destinationPath, $dokumenRename);

        $dok['field_name'] = $field_name;
        $dok['file'] = URL::to($path . '/' . $dokumenRename);

        $pengajuan = PengajuanLayanan::updateOrCreate([
            'id_user' => $request['user']['id'],
            'id_layanan_desa' => $id_layanan,
            'status_pengajuan' => 0
        ], [
            'id_user' => $request['user']['id'],
            'id_layanan_desa' => $id_layanan,
            'nik' => $request['user']['nik'],
            'uploaded_dokumen' => json_encode($dok),
            'status_pengajuan' => 0
        ]);


        if ($pengajuan) {
            return response()->json([
                'status' => true,
                'message' => 'upload dokumen berhasil dilakukan',
                'path' => URL::to($path . '/' . $dokumenRename),
            ]);
        }
    }
}
