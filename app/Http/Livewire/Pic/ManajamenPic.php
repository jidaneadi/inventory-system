<?php

namespace App\Http\Livewire\Pic;

use App\Models\PIC;
use Livewire\Component;
use Livewire\WithPagination;

class ManajamenPic extends Component
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
    public function destroy($id_pic)
    {
        $cek = PIC::where('id_pic', $id_pic)->first();

        if (!$cek) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Data pic tidak ditemukan!',
            ]);
            return;
        }

        PIC::where('id_pic', $id_pic)->delete();

        session()->flash('success', 'Data pic berhasil dihapus!');
        $this->resetPage();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Data pic berhasil dihapus!'
        ]);
    }

    public function render()
    {
        $query = PIC::query()
           ->select('id_pic', 'nama_pic', 'updated_at');


        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama_pic', 'like', '%' . $this->search . '%');

            });
        }

        $pic = $query->orderBy('id_pic', 'asc')->paginate($this->perPage);

        return view('livewire.pic.manajemen-pic', [
            'pic' => $pic,
        ]);
    }
}
