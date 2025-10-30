<?php

namespace App\Http\Livewire\Aset;

use App\Models\Aset;
use App\Models\AsetMasuk;
use App\Models\Jenis;
use Illuminate\Console\View\Components\Alert;
use Livewire\Component;

class ManajemenAset extends Component
{
    protected $listeners = ['hapusAset' => 'destroy'];

    public function destroy($id_aset)
    {
        $cek = Aset::where('aset.id_aset', $id_aset)
            ->join('detail_aset', 'detail_aset.id_aset', '=', 'aset.id_aset')
            ->join('detail_aset_masuk', 'detail_aset_masuk.id_detail_aset', '=', 'detail_aset.id_detail_aset')
            ->select('aset.*', 'detail_aset_masuk.id_aset_masuk')
            ->first();

        if(!$cek){
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Data aset tidak ditemukan!'
            ]);
            return;
        }

        Aset::where('id_aset', $id_aset)->delete();
        AsetMasuk::where('id_aset_masuk', $cek->id_aset_masuk)->delete();


        $this->emitSelf('$refresh');

        session()->flash('success', 'Data aset berhasil dihapus!');
    }

    public function render()
    {
        $aset = Aset::with('detail_aset')
            ->join('jenis', 'aset.jenis_aset', '=', 'jenis.id_jenis')
            ->select('aset.*', 'jenis.nama_jenis as nama_jenis')->get();

        $jenis = Jenis::get();
        return view('livewire.aset.manajemen-aset', compact('aset', 'jenis'));
    }
}
