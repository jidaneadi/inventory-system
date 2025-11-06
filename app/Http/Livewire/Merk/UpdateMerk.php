<?php

namespace App\Http\Livewire\Merk;

use App\Models\Merk;
use Livewire\Component;

class UpdateMerk extends Component
{
    public $id_merk, $nama_merk;

    protected $rules = [
        'nama_merk' => 'required|string|max:100',
    ];

    public function mount($id_merk)
    {
        if (!$id_merk) {
            session()->flash('error', 'ID merk tidak ditemukan.');
            return redirect()->route('manajemen-merk');
        }

        $merk = Merk::where('id_merk', $id_merk)->first();
        if (!$merk) {
            session()->flash('error', 'Data merk tidak ditemukan.');
            return redirect()->route('manajemen-merk');
        }
        $this->nama_merk = $merk->nama_merk;
    }

    public function render()
    {
        return view('livewire.merk.update-merk');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $this->validate();

        $merk = Merk::where('id_merk', $this->id_merk)->first();
        if (!$merk) {
            session()->flash('error', 'Data merk tidak ditemukan.');
            return redirect()->route('manajemen-merk');
        }
        Merk::where('id_merk', $this->id_merk)->update([
            'nama_merk' => $this->nama_merk,
        ]);

        session()->flash('success', 'Data merk berhasil diperbarui!');
        return redirect()->route('manajemen-merk');
    }
}


