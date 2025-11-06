<?php

namespace App\Http\Livewire\Pic;

use App\Models\PIC;
use Livewire\Component;

class UpdatePic extends Component
{
    public $id_pic, $nama_pic;

    protected $rules = [
        'nama_pic' => 'required|string|max:100',
    ];

    public function mount($id_pic)
    {
        if (!$id_pic) {
            session()->flash('error', 'ID pic tidak ditemukan.');
            return redirect()->route('manajemen-pic');
        }

        $pic = PIC::where('id_pic', $id_pic)->first();
        if (!$pic) {
            session()->flash('error', 'Data pic tidak ditemukan.');
            return redirect()->route('manajemen-pic');
        }
        $this->nama_pic = $pic->nama_pic;
    }

    public function render()
    {
        return view('livewire.pic.update-pic');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $this->validate();

        $pic = PIC::where('id_pic', $this->id_pic)->first();
        if (!$pic) {
            session()->flash('error', 'Data pic tidak ditemukan.');
            return redirect()->route('manajemen-pic');
        }
        PIC::where('id_pic', $this->id_pic)->update([
            'nama_pic' => $this->nama_pic,
        ]);

        session()->flash('success', 'Data pic berhasil diperbarui!');
        return redirect()->route('manajemen-pic');
    }
}


