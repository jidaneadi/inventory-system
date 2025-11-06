<?php

namespace App\Http\Livewire\Bahan;

use App\Models\Bahan;
use Livewire\Component;
use Livewire\WithPagination;

class ManajemenBahan extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    // Reset halaman saat search atau filter berubah
    public function updatingSearch()
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
    public function destroy($id_bahan)
    {
        $cek = Bahan::where('id_bahan', $id_bahan)->first();

        if (!$cek) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Data bahan tidak ditemukan!',
            ]);
            return;
        }

        Bahan::where('id_bahan', $id_bahan)->delete();

        session()->flash('success', 'Data bahan berhasil dihapus!');
        $this->resetPage();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Data bahan berhasil dihapus!'
        ]);
    }

    public function render()
    {
        $query = Bahan::query()
           ->select('id_bahan', 'nama_bahan', 'updated_at');


        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama_bahan', 'like', '%' . $this->search . '%');

            });
        }

        $bahan = $query->orderBy('id_bahan', 'asc')->paginate($this->perPage);

        return view('livewire.bahan.manajemen-bahan', [
            'bahan' => $bahan,
        ]);
    }
}

