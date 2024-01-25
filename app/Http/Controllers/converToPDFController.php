<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Facade;
use PDF;

class converToPDFController extends Controller
{
    public function suratSKTM()
    {
        return view('formsuratPDF.sktm');
    }

    public function suratUsaha()
    {
        return view('formsuratPDF.surat-izin-usaha');
    }

    public function suratKematian()
    {
        return view('formsuratPDF.surat-kematian');
    }

    public function suratIzinKeramaian()
    {
        return view('formsuratPDF.surat-izin-keramaian');
    }

    public function skck()
    {
        return view('formsuratPDF.skck');
    }

    public function suratMenikah()
    {
        return view('formsuratPDF.surat-keterangan-menikah');
    }
}
