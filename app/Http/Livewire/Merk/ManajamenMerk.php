<?php

namespace App\Http\Livewire\Merk;

use App\Models\Merk;
use Livewire\Component;
use Livewire\WithPagination;

class ManajamenMerk extends Component
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
    public function destroy($id_merk)
    {
        $cek = Merk::where('id_merk', $id_merk)->first();

        if (!$cek) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Data merk tidak ditemukan!',
            ]);
            return;
        }

        Merk::where('id_merk', $id_merk)->delete();

        session()->flash('success', 'Data merk berhasil dihapus!');
        $this->resetPage();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Data merk berhasil dihapus!'
        ]);
    }

    public function render()
    {
        $query = Merk::query()
           ->select('id_merk', 'nama_merk', 'updated_at');


        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama_merk', 'like', '%' . $this->search . '%');

            });
        }

        $merk = $query->orderBy('id_merk', 'asc')->paginate($this->perPage);

        return view('livewire.merk.manajemen-merk', [
            'merk' => $merk,
        ]);
    }
}
