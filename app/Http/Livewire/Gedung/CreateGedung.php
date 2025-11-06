<?php

namespace App\Http\Livewire\Gedung;

use App\Models\Gedung;
use Livewire\Component;

class CreateGedung extends Component
{
    public $nama_gedung, $id_gedung, $alamat;

    protected $rules = [
        'nama_gedung' => 'required|min:5|max:100',
        'alamat' => 'required|min:5|max:200',
    ];

    public function setMode()
    {
        $this->resetValidation();
        $this->reset(['nama_gedung', 'alamat']);
    }

    public function render()
    {
        return view('livewire.gedung.create-gedung', [
            'gedung' => Gedung::all()
        ]);
    }

    public function store()
    {
        $this->validate();

        Gedung::create([
            'nama_gedung' => $this->nama_gedung,
            'alamat' => $this->alamat
        ]);

        session()->flash('success', 'Gedung berhasil disimpan!');
        $this->resetForm();

        return redirect()->intended('/gedung')->with('success', 'Gedung berhasil disimpan!');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetForm()
    {
        $this->reset(['nama_gedung', 'alamat']);
        $this->resetValidation();
    }
}

