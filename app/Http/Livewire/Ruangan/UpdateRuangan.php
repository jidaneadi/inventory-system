<?php

namespace App\Http\Livewire\Ruangan;

use App\Models\Gedung;
use App\Models\Ruang;
use Livewire\Component;

class UpdateRuangan extends Component
{
    public $id_ruang, $id_gedung, $nama_ruang;

    protected $rules = [
        'id_gedung' => 'required|integer|max:11',
        'nama_ruang' => 'required|string|max:50',
    ];

    public function mount($id_ruang)
    {
        if (!$id_ruang) {
            session()->flash('error', 'ID ruangan tidak ditemukan.');
            return redirect()->route('manajemen-ruangan');
        }

        $ruang = Ruang::where('id_ruang', $id_ruang)->first();
        if (!$ruang) {
            session()->flash('error', 'Data ruangan tidak ditemukan.');
            return redirect()->route('manajemen-ruangan');
        }

        $this->id_gedung = $ruang->id_gedung;
        $this->nama_ruang = $ruang->nama_ruang;
    }

    public function render()
    {
        return view('livewire.ruangan.update-ruangan', [
            'gedung' => Gedung::all()
        ]);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $this->validate();

        $ruang = Ruang::where('id_ruang', $this->id_ruang)->first();
        if (!$ruang) {
            session()->flash('error', 'Data ruangan tidak ditemukan.');
            return redirect()->route('manajemen-ruangan');
        }
        Ruang::where('id_ruang', $this->id_ruang)->update([
            'nama_ruang' => $this->nama_ruang,
            'id_gedung' =>$this->id_gedung
        ]);

        session()->flash('success', 'Data ruangan berhasil diperbarui!');
        return redirect()->route('manajemen-ruangan');
    }
}
