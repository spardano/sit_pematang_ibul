<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\JenisPekerjaan;
use App\Models\PengajuanLayanan;
use Barryvdh\DomPDF\Facade\Pdf;


class converToPDFController extends Controller
{
    public function webview()
    {
        $pengajuan = PengajuanLayanan::where('id', 13)->first();
        $intJenisKerja = JenisPekerjaan::where('id', $pengajuan->user->penduduk->jenis_pekerjaan)->first();
        $intAgama = Agama::where('id', $pengajuan->user->penduduk->agama)->first();
        $field_data = json_decode($pengajuan->data_field);

        $data['pengajuan'] = $pengajuan;
        $data['field_data'] = $field_data;

        if (
            $pengajuan->layanan_desa->slug == 'surat-keterangan-catatan-kepolisian' ||
            $pengajuan->layanan_desa->slug == 'surat-keterangan-kematian' ||
            $pengajuan->layanan_desa->slug == 'surat-keterangan-menikah'
        ) {

            $data['jenis_pekerjaan'] = $intJenisKerja->jenis_pekerjaan;
            $data['agama'] = $intAgama->agama;
        }

        return view('formsuratPDF.surat-keterangan-menikah', $data);
    }

    public function downloadPdf($record)
    {

        $pengajuan = PengajuanLayanan::where('id', $record)->first();
        $intJenisKerja = JenisPekerjaan::where('id', $pengajuan->user->penduduk->jenis_pekerjaan)->first();
        $intAgama = Agama::where('id', $pengajuan->user->penduduk->agama)->first();
        $field_data = json_decode($pengajuan->data_field);

        $data['pengajuan'] = $pengajuan;
        $data['field_data'] = $field_data;

        if ($pengajuan->layanan_desa->slug == 'surat-keterangan-tidak-mampu') {
            $pdf = Pdf::loadView('formsuratPDF.sktm', $data);
        } elseif ($pengajuan->layanan_desa->slug == 'surat-keterangan-usaha') {
            $data['jenis_pekerjaan'] = $intJenisKerja->jenis_pekerjaan;
            $data['agama'] = $intAgama->agama;
            $pdf = Pdf::loadView('formsuratPDF.surat-izin-usaha', $data);
        } elseif ($pengajuan->layanan_desa->slug == 'surat-keterangan-kematian') {
            $data['jenis_pekerjaan'] = $intJenisKerja->jenis_pekerjaan;
            $data['agama'] = $intAgama->agama;
            $pdf = Pdf::loadView('formsuratPDF.surat-kematian', $data);
        } elseif ($pengajuan->layanan_desa->slug == 'permohonan-surat-izin-keramaian') {
            $pdf = Pdf::loadView('formsuratPDF.surat-izin-keramaian', $data);
        } elseif ($pengajuan->layanan_desa->slug == 'surat-keterangan-catatan-kepolisian') {
            $data['jenis_pekerjaan'] = $intJenisKerja->jenis_pekerjaan;
            $data['agama'] = $intAgama->agama;
            $pdf = Pdf::loadView('formsuratPDF.skck', $data);
        } else {
            $data['jenis_pekerjaan'] = $intJenisKerja->jenis_pekerjaan;
            $data['agama'] = $intAgama->agama;
            $pdf = Pdf::loadView('formsuratPDF.surat-keterangan-menikah', $data);
        }

        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream();
    }
}
