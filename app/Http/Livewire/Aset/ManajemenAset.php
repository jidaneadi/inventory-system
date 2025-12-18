<?php

namespace App\Http\Livewire\Aset;

use App\Models\Aset;
use App\Models\AsetMasuk;
use App\Models\Jenis;
use Livewire\Component;
use Livewire\WithPagination;

class ManajemenAset extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $filterJenis = '';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'filterJenis' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    // Reset halaman saat search atau filter berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterJenis()
    {
        $this->resetPage();
    }

    // Set jumlah data per halaman
    public function setPerPage($jumlah)
    {
        $this->perPage = $jumlah;
        $this->resetPage();
    }

    // Hapus aset
    public function destroy($id_aset)
    {
        $cek = Aset::where('aset.id_aset', $id_aset)
            ->join('detail_aset', 'detail_aset.id_aset', '=', 'aset.id_aset')
            ->join('detail_aset_masuk', 'detail_aset_masuk.id_detail_aset', '=', 'detail_aset.id_detail_aset')
            ->select('aset.*', 'detail_aset_masuk.id_aset_masuk')
            ->first();

        if (!$cek) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Data aset tidak ditemukan!',
            ]);
            return;
        }

        Aset::where('id_aset', $id_aset)->delete();
        AsetMasuk::where('id_aset_masuk', $cek->id_aset_masuk)->delete();

        session()->flash('success', 'Data aset berhasil dihapus!');
        $this->resetPage();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Data aset berhasil dihapus!'
        ]);
    }

    public function render()

    {
        $query = Aset::query()
            ->join('jenis', 'aset.jenis_aset', '=', 'jenis.id_jenis')
            ->select('aset.*', 'jenis.nama_jenis');

        if ($this->filterJenis) {
            $query->where('aset.jenis_aset', $this->filterJenis);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('aset.nama_aset', 'like', '%' . $this->search . '%')
                    ->orWhere('aset.id_aset', 'like', '%' . $this->search . '%');
            });
        }

        $aset = $query->orderBy('aset.id_aset', 'desc')->paginate($this->perPage);
        $jenis = Jenis::orderBy('nama_jenis', 'asc')->get();

        return view('livewire.aset.manajemen-aset', [
            'aset' => $aset,
            'jenis' => $jenis,
        ]);
    }
}
