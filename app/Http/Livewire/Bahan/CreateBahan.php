<?php

namespace App\Http\Livewire\Bahan;

use App\Models\Bahan;
use Livewire\Component;

class CreateBahan extends Component
{
    public $nama_bahan;

    protected $rules = [
        'nama_bahan' => 'required|min:5|max:100',
    ];

    public function setMode()
    {
        $this->resetValidation();
        $this->reset(['nama_bahan']);
    }

    public function render()
    {
        return view('livewire.bahan.create-bahan', [
            'bahan' =>Bahan::all()
        ]);
    }

    public function store()
    {
        $this->validate();

       Bahan::create([
            'nama_bahan' => $this->nama_bahan,
        ]);

        session()->flash('success', 'Bahan berhasil disimpan!');
        $this->resetForm();

        return redirect()->intended('/bahan')->with('success', 'Bahan berhasil disimpan!');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetForm()
    {
        $this->reset(['nama_bahan']);
        $this->resetValidation();
    }
}
