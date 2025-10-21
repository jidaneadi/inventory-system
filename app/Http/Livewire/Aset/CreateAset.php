<?php

namespace App\Http\Livewire\Aset;

use App\Models\Aset;
use App\Models\Bahan;
use App\Models\Jenis;
use App\Models\Merk;
use Illuminate\Http\Request;
use Livewire\Component;

class CreateAset extends Component
{
    public function render()
    {
        $jenis = Jenis::get();
        $merk = Merk::get();
        $bahan = Bahan::get();
        return view('livewire.aset.create-aset', compact('jenis', 'merk', 'bahan'));
    }
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id_aset'        => 'required|string|max:50|unique:aset,id_aset',
            'nama_aset'      => 'required|string|max:100',
            'jenis_aset'     => 'required|exists:jenis,id',
            'id_detail'      => 'nullable|string|max:50',
            'serial_number'  => 'nullable|string|max:100',
            'bahan_id'       => 'nullable|exists:bahan,id',
            'merk_id'        => 'nullable|exists:merk,id',
            'kondisi'        => 'required|string|in:normal,rusak,diperbaharui',
        ]);

        // Simpan data ke model (pastikan kamu punya model Aset)
       Aset::create($validated);

        // Redirect ke halaman daftar aset dengan pesan sukses
        return redirect()->route('aset.index')->with('success', 'Aset berhasil ditambahkan!');
    }
}
