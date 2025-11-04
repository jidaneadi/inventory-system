<?php

namespace App\Http\Livewire\Gedung;

use App\Models\Gedung;
use Livewire\Component;

class UpdateGedung extends Component

{
    public $id_gedung, $alamat, $nama_gedung;

    protected $rules = [
        'alamat' => 'required|string|max:50',
        'nama_gedung' => 'required|string|max:100',
    ];

    public function mount($id_gedung)
    {
        if (!$id_gedung) {
            session()->flash('error', 'ID gedung tidak ditemukan.');
            return redirect()->route('manajemen-gedung');
        }

        $gedung = Gedung::where('id_gedung', $id_gedung)->first();
        if (!$gedung) {
            session()->flash('error', 'Data gedung tidak ditemukan.');
            return redirect()->route('manajemen-gedung');
        }

        $this->alamat = $gedung->alamat;
        $this->nama_gedung = $gedung->nama_gedung;
    }

    public function render()
    {
        return view('livewire.gedung.update-gedung');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $this->validate();

        $gedung = Gedung::where('id_gedung', $this->id_gedung)->first();
        if (!$gedung) {
            session()->flash('error', 'Data gedung tidak ditemukan.');
            return redirect()->route('manajemen-gedung');
        }
        Gedung::where('id_gedung', $this->id_gedung)->update([
            'nama_gedung' => $this->nama_gedung,
            'alamat' =>$this->alamat
        ]);

        session()->flash('success', 'Data gedung berhasil diperbarui!');
        return redirect()->route('manajemen-gedung');
    }
}
