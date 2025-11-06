<?php

namespace App\Http\Livewire\Pic;

use App\Models\PIC;
use Livewire\Component;

class CreatePic extends Component
{
    public $nama_pic;

    protected $rules = [
        'nama_pic' => 'required|min:5|max:100',
    ];

    public function setMode()
    {
        $this->resetValidation();
        $this->reset(['nama_pic']);
    }

    public function render()
    {
        return view('livewire.pic.create-pic', [
            'pic' =>PIC::all()
        ]);
    }

    public function store()
    {
        $this->validate();

       PIC::create([
            'nama_pic' => $this->nama_pic,
        ]);

        session()->flash('success', 'pic berhasil disimpan!');
        $this->resetForm();

        return redirect()->intended('/pic')->with('success', 'pic berhasil disimpan!');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetForm()
    {
        $this->reset(['nama_pic']);
        $this->resetValidation();
    }
}

