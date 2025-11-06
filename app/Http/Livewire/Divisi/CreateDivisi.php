<?php

namespace App\Http\Livewire\Divisi;

use App\Models\Divisi;
use Livewire\Component;

class CreateDivisi extends Component
{
    public $nama_divisi;

    protected $rules = [
        'nama_divisi' => 'required|min:5|max:100',
    ];

    public function setMode()
    {
        $this->resetValidation();
        $this->reset(['nama_divisi']);
    }

    public function render()
    {
        return view('livewire.divisi.create-divisi', [
            'divisi' =>Divisi::all()
        ]);
    }

    public function store()
    {
        $this->validate();

       Divisi::create([
            'nama_divisi' => $this->nama_divisi,
        ]);

        session()->flash('success', 'Divisi berhasil disimpan!');
        $this->resetForm();

        return redirect()->intended('/divisi')->with('success', 'Divisi berhasil disimpan!');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetForm()
    {
        $this->reset(['nama_divisi']);
        $this->resetValidation();
    }
}


