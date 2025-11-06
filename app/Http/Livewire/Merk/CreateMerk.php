<?php

namespace App\Http\Livewire\Merk;

use App\Models\Merk;
use Livewire\Component;

class CreateMerk extends Component
{
    public $nama_merk;

    protected $rules = [
        'nama_merk' => 'required|min:5|max:100',
    ];

    public function setMode()
    {
        $this->resetValidation();
        $this->reset(['nama_merk']);
    }

    public function render()
    {
        return view('livewire.merk.create-merk', [
            'merk' =>Merk::all()
        ]);
    }

    public function store()
    {
        $this->validate();

       Merk::create([
            'nama_merk' => $this->nama_merk,
        ]);

        session()->flash('success', 'Merk berhasil disimpan!');
        $this->resetForm();

        return redirect()->intended('/merk')->with('success', 'Merk berhasil disimpan!');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetForm()
    {
        $this->reset(['nama_merk']);
        $this->resetValidation();
    }
}

