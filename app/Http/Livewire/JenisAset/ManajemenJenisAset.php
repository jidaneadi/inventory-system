<?php

namespace App\Http\Livewire\JenisAset;

use App\Models\Jenis;
use Livewire\Component;
use Livewire\WithPagination;

class ManajemenJenisAset extends Component


{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    // public $filterjenis = '';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        // 'filterjenis' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    // Reset halaman saat search atau filter berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingfilterjenis()
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
    public function destroy($id_jenis)
    {
        $cek = Jenis::where('id_jenis', $id_jenis)->first();

        if (!$cek) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Data jenis aset tidak ditemukan!',
            ]);
            return;
        }

        Jenis::where('id_jenis', $id_jenis)->delete();

        session()->flash('success', 'Data jenis aset berhasil dihapus!');
        $this->resetPage();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Data jenis aset berhasil dihapus!'
        ]);
    }

    public function render()
    {
        $query = Jenis::query()
            // ->join('jenis', 'jenis.id_jenis', '=', 'jenis.id_jenis')
            ->select('id_jenis', 'nama_jenis', 'updated_at');

        // if ($this->filterjenis) {
        //     $query->where('jenis.id_jenis', $this->filterjenis);
        // }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama_jenis', 'like', '%' . $this->search . '%');
                    // ->orWhere('nama_jenis', 'like', '%' . $this->search . '%')
                    // ->orWhere('alamat', 'like', '%' . $this->search . '%');
            });
        }

        $jenis = $query->orderBy('id_jenis', 'asc')->paginate($this->perPage);
        // $jenis = jenis::orderBy('nama_jenis', 'asc')->get();

        return view('livewire.jenis-aset.manajemen-jenis-aset', [
            'jenis' => $jenis,
        ]);
    }
}

