<?php

namespace App\Http\Livewire\Divisi;

use App\Models\Divisi;
use Livewire\Component;

class UpdateDivisi extends Component
{
    public $id_divisi, $nama_divisi;

    protected $rules = [
        'nama_divisi' => 'required|string|max:100',
    ];

    public function mount($id_divisi)
    {
        if (!$id_divisi) {
            session()->flash('error', 'ID divisi tidak ditemukan.');
            return redirect()->route('manajemen-divisi');
        }

        $divisi = Divisi::where('id_divisi', $id_divisi)->first();
        if (!$divisi) {
            session()->flash('error', 'Data divisi tidak ditemukan.');
            return redirect()->route('manajemen-divisi');
        }
        $this->nama_divisi = $divisi->nama_divisi;
    }

    public function render()
    {
        return view('livewire.divisi.update-divisi');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $this->validate();

        $divisi = Divisi::where('id_divisi', $this->id_divisi)->first();
        if (!$divisi) {
            session()->flash('error', 'Data divisi tidak ditemukan.');
            return redirect()->route('manajemen-divisi');
        }
        Divisi::where('id_divisi', $this->id_divisi)->update([
            'nama_divisi' => $this->nama_divisi,
        ]);

        session()->flash('success', 'Data divisi berhasil diperbarui!');
        return redirect()->route('manajemen-divisi');
    }
}
