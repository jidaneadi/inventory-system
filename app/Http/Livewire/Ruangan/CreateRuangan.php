<?php

namespace App\Http\Livewire\Ruangan;

use App\Models\Gedung;
use App\Models\Ruang;
use Livewire\Component;

class CreateRuangan extends Component
{
    public $nama_ruang, $id_gedung;

    protected $rules = [
        'nama_ruang' => 'required|min:5|max:50',
    ];

    protected $cats = [
        'id_gedung' => 'integer'
    ];

    public function setMode()
    {
        $this->resetValidation();
        $this->reset(['nama_ruang', 'id_gedung']);
    }

    public function render()
    {
        return view('livewire.ruangan.create-ruangan', [
            'gedung' => Gedung::all()
        ]);
    }

    public function store()
    {
        $this->validate();

        Ruang::create([
            'nama_ruang' => $this->nama_ruang,
            'id_gedung' => $this->id_gedung
        ]);

        session()->flash('success', 'Ruangan berhasil disimpan!');
        $this->resetForm();

        return redirect()->intended('/ruangan')->with('success', 'Ruangan berhasil disimpan!');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetForm()
    {
        $this->reset(['nama_ruang', 'id_gedung']);
        $this->resetValidation();
    }
}
