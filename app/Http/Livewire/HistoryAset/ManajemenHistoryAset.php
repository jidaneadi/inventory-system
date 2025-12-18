<?php

namespace App\Http\Livewire\HistoryAset;

use App\Models\MutasiAset;
use Livewire\Component;
use Livewire\WithPagination;

class ManajemenHistoryAset extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $perPage = 10;
    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function setPerPage($jumlah)
    {
        $this->perPage = $jumlah;
        $this->resetPage();
    }

    public function destroy($id)
    {
        MutasiAset::where('id_mutasi_aset', $id)->delete();

        session()->flash('success', 'Mutasi aset berhasil dihapus!');
        $this->resetPage();
    }

    public function render()
    {
        $query = MutasiAset::join('aset', 'aset.id_aset', '=', 'mutasi_aset.id_aset')
            ->join('pic', 'pic.id_pic', '=', 'mutasi_aset.id_pic')
            ->select(
                'mutasi_aset.*',
                'aset.nama_aset',
                'pic.nama_pic'
            )
            ->orderBy('mutasi_aset.tanggal_mutasi', 'desc');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('mutasi_aset.id_mutasi_aset', 'like', "%{$this->search}%")
                  ->orWhere('aset.nama_aset', 'like', "%{$this->search}%")
                  ->orWhere('pic.nama_pic', 'like', "%{$this->search}%");
            });
        }

        $data = $query->paginate($this->perPage);

        return view('livewire.history-aset.manajemen-history-aset', compact('data'));
    }

}
