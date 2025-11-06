<?php

namespace App\Http\Livewire\Bahan;

use App\Models\Bahan;
use Livewire\Component;

class UpdateBahan extends Component
{
    public $id_bahan, $nama_bahan;

    protected $rules = [
        'nama_bahan' => 'required|string|max:100',
    ];

    public function mount($id_bahan)
    {
        if (!$id_bahan) {
            session()->flash('error', 'ID bahan tidak ditemukan.');
            return redirect()->route('manajemen-bahan');
        }

        $bahan = Bahan::where('id_bahan', $id_bahan)->first();
        if (!$bahan) {
            session()->flash('error', 'Data bahan tidak ditemukan.');
            return redirect()->route('manajemen-bahan');
        }
        $this->nama_bahan = $bahan->nama_bahan;
    }

    public function render()
    {
        return view('livewire.bahan.update-bahan');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $this->validate();

        $bahan = Bahan::where('id_bahan', $this->id_bahan)->first();
        if (!$bahan) {
            session()->flash('error', 'Data bahan tidak ditemukan.');
            return redirect()->route('manajemen-bahan');
        }
        Bahan::where('id_bahan', $this->id_bahan)->update([
            'nama_bahan' => $this->nama_bahan,
        ]);

        session()->flash('success', 'Data bahan berhasil diperbarui!');
        return redirect()->route('manajemen-bahan');
    }
}

