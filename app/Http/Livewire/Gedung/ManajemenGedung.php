<?php

namespace App\Http\Livewire\Gedung;

use App\Models\Gedung;
use Livewire\Component;
use Livewire\WithPagination;

class ManajemenGedung extends Component

{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $filterGedung = '';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        // 'filterGedung' => ['except' => ''],
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
    public function destroy($id_gedung)
    {
        $cek = Gedung::where('id_gedung', $id_gedung)->first();

        if (!$cek) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Data gedung tidak ditemukan!',
            ]);
            return;
        }

        Gedung::where('id_gedung', $id_gedung)->delete();

        session()->flash('success', 'Data gedung berhasil dihapus!');
        $this->resetPage();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Data gedung berhasil dihapus!'
        ]);
    }

    public function render()
    {
        $query = Gedung::query()
            // ->join('gedung', 'gedung.id_gedung', '=', 'gedung.id_gedung')
            ->select('id_gedung', 'nama_gedung', 'alamat');

        // if ($this->filterGedung) {
        //     $query->where('gedung.id_gedung', $this->filterGedung);
        // }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama_gedung', 'like', '%' . $this->search . '%')
                    // ->orWhere('nama_gedung', 'like', '%' . $this->search . '%')
                    ->orWhere('alamat', 'like', '%' . $this->search . '%');
            });
        }

        $gedung = $query->orderBy('id_gedung', 'asc')->paginate($this->perPage);
        // $gedung = Gedung::orderBy('nama_gedung', 'asc')->get();

        return view('livewire.gedung.manajemen-gedung', [
            'gedung' => $gedung,
        ]);
    }
}
