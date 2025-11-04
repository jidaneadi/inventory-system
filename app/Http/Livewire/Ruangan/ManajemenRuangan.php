<?php

namespace App\Http\Livewire\Ruangan;

use App\Models\Gedung;
use App\Models\Ruang;
use Livewire\Component;
use Livewire\WithPagination;

class ManajemenRuangan extends Component

{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $filterGedung = '';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'filterGedung' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    // Reset halaman saat search atau filter berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingfilterGedung()
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
    public function destroy($id_ruang)
    {
        $cek = Ruang::where('id_ruang', $id_ruang)->first();

        if (!$cek) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Data ruangan tidak ditemukan!',
            ]);
            return;
        }

        Ruang::where('id_ruang', $id_ruang)->delete();

        session()->flash('success', 'Data ruangan berhasil dihapus!');
        $this->resetPage();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Data ruangan berhasil dihapus!'
        ]);
    }

    public function render()
    {
        $query = Ruang::query()
            ->join('gedung', 'gedung.id_gedung', '=', 'ruang.id_gedung')
            ->select('ruang.*', 'gedung.nama_gedung', 'gedung.alamat');

        if ($this->filterGedung) {
            $query->where('ruang.id_gedung', $this->filterGedung);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('ruang.nama_ruang', 'like', '%' . $this->search . '%')
                    ->orWhere('gedung.nama_gedung', 'like', '%' . $this->search . '%')
                    ->orWhere('gedung.alamat', 'like', '%' . $this->search . '%');
            });
        }

        $ruang = $query->orderBy('ruang.id_ruang', 'asc')->paginate($this->perPage);
        $gedung = Gedung::orderBy('nama_gedung', 'asc')->get();

        return view('livewire.ruangan.manajemen-ruangan', [
            'ruang' => $ruang,
            'gedung' => $gedung,
        ]);
    }
}

