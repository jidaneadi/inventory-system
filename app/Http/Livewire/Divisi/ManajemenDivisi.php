<?php

namespace App\Http\Livewire\Divisi;

use App\Models\Divisi;
use Livewire\Component;
use Livewire\WithPagination;

class ManajemenDivisi extends Component


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

    public function updatingfilterDivisi()
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
    public function destroy($id_divisi)
    {
        $cek = Divisi::where('id_divisi', $id_divisi)->first();

        if (!$cek) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Data divisi tidak ditemukan!',
            ]);
            return;
        }

        Divisi::where('id_divisi', $id_divisi)->delete();

        session()->flash('success', 'Data divisi berhasil dihapus!');
        $this->resetPage();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Data divisi berhasil dihapus!'
        ]);
    }

    public function render()
    {
        $query = Divisi::query()
           ->select('id_divisi', 'nama_divisi', 'updated_at');


        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama_divisi', 'like', '%' . $this->search . '%');

            });
        }

        $divisi = $query->orderBy('id_divisi', 'asc')->paginate($this->perPage);

        return view('livewire.divisi.manajemen-divisi', [
            'divisi' => $divisi,
        ]);
    }
}

