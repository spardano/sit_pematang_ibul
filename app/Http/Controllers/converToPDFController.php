<?php

namespace App\Http\Controllers;

use App\Models\PengajuanLayanan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Facade;


class converToPDFController extends Controller
{
    public function downloadPdf($record)
    {

        $pengajuan = PengajuanLayanan::where('id', $record)->first();

        // dd($pengajuan->pejabat_ttd->getFirstMediaUrl('signature'));

        $field_data = json_decode($pengajuan->data_field);

        $data['pengajuan'] = $pengajuan;
        $data['field_data'] = $field_data;

        if ($pengajuan->layanan_desa->slug == 'surat-keterangan-tidak-mampu') {
            $pdf = Pdf::loadView('formsuratPDF.sktm', $data);
        }

        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream();
    }
}
