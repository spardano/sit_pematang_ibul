<?php

namespace App\Livewire\Modal;

use App\Models\PengajuanLayanan;
use Livewire\Component;

class ShowPengajuan extends Component
{
    public $id;
    public $data_pengajuan;
    public function render()
    {
        $this->data_pengajuan = PengajuanLayanan::find($this->id);
        return view('livewire.modal.show-pengajuan');
    }
}
