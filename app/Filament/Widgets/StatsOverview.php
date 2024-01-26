<?php

namespace App\Filament\Widgets;

use App\Models\Penduduk;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $penduduk = Penduduk::count();
        return [
            Card::make('Jumlah Penduduk', $penduduk),
            Card::make('Bounce rate', '21%'),
            Card::make('Average time on page', '3:12'),
            Card::make('Average time on page', '3:12'),
            Card::make('Average time on page', '3:12'),
        ];
    }
}
