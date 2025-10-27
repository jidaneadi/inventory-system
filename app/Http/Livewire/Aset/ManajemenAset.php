<?php

namespace App\Http\Livewire\Aset;

use App\Models\Aset;
use App\Models\Jenis;
use Livewire\Component;

class ManajemenAset extends Component
{
    public function render()
    {
        $aset = Aset::with('detail_aset')
            ->join('jenis', 'aset.jenis_aset', '=', 'jenis.id_jenis')
            ->select('aset.*', 'jenis.nama_jenis as nama_jenis')->get();
        // dd($aset);
        $jenis = Jenis::get();
        return view('livewire.aset.manajemen-aset', compact('aset', 'jenis'));
    }
}
