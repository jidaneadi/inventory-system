<?php

namespace App\Http\Livewire\Aset;

use App\Models\Aset;
use Livewire\Component;

class ManajemenAset extends Component
{
    public function render()
    {
        $aset = Aset::with('detail_aset')->get();
        // dd($aset);
        return view('livewire.aset.manajemen-aset', compact('aset'));
    }
}
