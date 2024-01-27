<?php

namespace App\Http\Controllers;

use App\Models\PengajuanLayanan;
use Barryvdh\DomPDF\Facade\Pdf;


class converToPDFController extends Controller
{
    public function webview()
    {
        $pengajuan = PengajuanLayanan::where('id', 8)->first();
        $field_data = json_decode($pengajuan->data_field);

        $data['pengajuan'] = $pengajuan;
        $data['field_data'] = $field_data;

        return view('formsuratPDF.surat-izin-keramaian', $data);
    }
    public function downloadPdf($record)
    {

        $pengajuan = PengajuanLayanan::where('id', $record)->first();

        $field_data = json_decode($pengajuan->data_field);

        $data['pengajuan'] = $pengajuan;
        $data['field_data'] = $field_data;

        if ($pengajuan->layanan_desa->slug == 'surat-keterangan-tidak-mampu') {
            $pdf = Pdf::loadView('formsuratPDF.sktm', $data);
        } elseif ($pengajuan->layanan_desa->slug == 'surat-keterangan-usaha') {
            $pdf = Pdf::loadView('formsuratPDF.surat-izin-usaha', $data);
        } elseif ($pengajuan->layanan_desa->slug == 'surat-keterangan-kematian') {
            $pdf = Pdf::loadView('formsuratPDF.surat-kematian', $data);
        } elseif ($pengajuan->layanan_desa->slug == 'permohonan-surat-izin-keramaian') {
            $pdf = Pdf::loadView('formsuratPDF.surat-izin-keramaian', $data);
        } elseif ($pengajuan->layanan_desa->slug == 'surat-keterangan-catatan-kepolisian') {
            $pdf = Pdf::loadView('formsuratPDF.skck', $data);
        } else {
            $pdf = Pdf::loadView('formsuratPDF.surat-keterangan-menikah', $data);
        }

        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream();
    }
}
