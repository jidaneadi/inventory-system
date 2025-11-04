<?php

namespace App\Http\Livewire\JenisAset;

use App\Models\Jenis;
use Livewire\Component;

class UpdateJenisAset extends Component

{
    public $id_jenis, $nama_jenis;

    protected $rules = [
        'nama_jenis' => 'required|string|max:100',
    ];

    public function mount($id_jenis)
    {
        if (!$id_jenis) {
            session()->flash('error', 'ID jenis tidak ditemukan.');
            return redirect()->route('manajemen-jenis-aset');
        }

        $jenis = Jenis::where('id_jenis', $id_jenis)->first();
        if (!$jenis) {
            session()->flash('error', 'Data jenis tidak ditemukan.');
            return redirect()->route('manajemen-jenis-aset');
        }

        $this->nama_jenis = $jenis->nama_jenis;
    }

    public function render()
    {
        return view('livewire.jenis-aset.update-jenis-aset');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $this->validate();

        $jenis = Jenis::where('id_jenis', $this->id_jenis)->first();
        if (!$jenis) {
            session()->flash('error', 'Data jenis tidak ditemukan.');
            return redirect()->route('manajemen-jenis-aset');
        }
        Jenis::where('id_jenis', $this->id_jenis)->update([
            'nama_jenis' => $this->nama_jenis,
        ]);

        session()->flash('success', 'Data jenis berhasil diperbarui!');
        return redirect()->route('manajemen-jenis-aset');
    }
}

