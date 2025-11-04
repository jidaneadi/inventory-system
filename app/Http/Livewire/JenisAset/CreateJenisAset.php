<?php

namespace App\Http\Livewire\JenisAset;

use App\Models\Jenis;
use Livewire\Component;

class CreateJenisAset extends Component
{
    public $nama_jenis, $id_jenis;

    protected $rules = [
        'nama_jenis' => 'required|min:5|max:100',
    ];

    public function setMode()
    {
        $this->resetValidation();
        $this->reset(['nama_jenis']);
    }

    public function render()
    {
        return view('livewire.jenis-aset.create-jenis-aset', [
            'jenis-aset' => Jenis::all()
        ]);
    }

    public function store()
    {
        $this->validate();

        Jenis::create([
            'nama_jenis' => $this->nama_jenis,
        ]);

        session()->flash('success', 'Jenis aset berhasil disimpan!');
        $this->resetForm();

        return redirect()->intended('/jenis-aset')->with('success', 'Jenis aset berhasil disimpan!');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetForm()
    {
        $this->reset(['nama_jenis']);
        $this->resetValidation();
    }
}

