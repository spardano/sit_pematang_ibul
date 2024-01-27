<?php

namespace App\Filament\Widgets;

use App\Models\Bumdes;
use App\Models\Informasi;
use App\Models\LayananDesa;
use App\Models\Penduduk;
use App\Models\PengajuanLayanan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $penduduk = Penduduk::count();
        $pendudukL = Penduduk::where('jenis_kelamin', 'L')->count();
        $pendudukP = Penduduk::where('jenis_kelamin', 'P')->count();
        $pengajuanDiProses = PengajuanLayanan::where('status_pengajuan', 1)->count();
        $pengajuanDisetujui = PengajuanLayanan::where('status_pengajuan', 2)->count();
        $pengajuanDitolak = PengajuanLayanan::where('status_pengajuan', 3)->count();
        $layanan = LayananDesa::count();
        $bumdes = Bumdes::count();
        $infoAktif = Informasi::where('status_publish', 1)->count();
        $infoNonAktif = Informasi::where('status_publish', 0)->count();
        return [
            Card::make('Jumlah Penduduk', $penduduk),
            Card::make('Jumlah Laki', $pendudukL),
            Card::make('Jumlah Perempuan', $pendudukP),
            Card::make('Pengajuan Diproses', $pengajuanDiProses),
            Card::make('Pengajuan Disetujui', $pengajuanDisetujui),
            Card::make('Pengajuan Ditolak', $pengajuanDitolak),
            Card::make('Jumlah Layanan', $layanan),
            Card::make('Badan Usaha Milik Desa', $bumdes),
            Card::make('Informasi Aktif', $infoAktif),
            Card::make('Informasi Non Aktif', $infoNonAktif),
        ];
    }
}
