<?php

namespace App\Http\Livewire\Aset;

use App\Models\Aset;
use App\Models\AsetMasuk;
use App\Models\Bahan;
use App\Models\DetailAset;
use App\Models\DetailAsetMasuk;
use App\Models\Divisi;
use App\Models\Jenis;
use App\Models\Merk;
use App\Models\PIC;
use App\Models\Ruang;
use Livewire\Component;

class CreateAset extends Component
{
    public $id_aset, $nama_aset, $jenis_aset, $tanggal_masuk, $jumlah, $id_pic, $id_divisi, $id_ruang;
    public $details = [];
    public $mode = 'terdaftar';

    protected $casts = [
        'jenis_aset' => 'integer',
        'details.*.id_bahan' => 'integer',
        'details.*.id_merk' => 'integer',
    ];

    public function setMode($mode)
    {
        $this->mode = $mode;
        $this->resetValidation();
        $this->reset(['id_aset', 'nama_aset', 'jenis_aset', 'details']);
    }

    private function randomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i <= 10; $i++) {
            $randomString .= $characters[random_int(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    protected function rules()
    {
        if ($this->mode === 'terdaftar') {
            return [
                'id_aset' => 'required|exists:aset,id_aset',
                'tanggal_masuk' => 'required|date',
                'jumlah' => 'required|integer|min:1|max:99999999999',
                'id_pic' => 'required|exists:pic,id_pic',
                'id_divisi' => 'required|exists:divisi,id_divisi',
                'id_ruang' => 'required|exists:ruang,id_ruang',
                'details.*.id_detail_aset' => 'required|string|max:50',
                'details.*.serial_number' => 'required|string|max:100',
                'details.*.id_bahan' => 'required|exists:bahan,id_bahan',
                'details.*.id_merk' => 'required|exists:merk,id_merk',
                'details.*.kondisi' => 'required|string|in:normal,rusak,perlu perbaikan',
            ];
        } else {
            return [
                'id_aset' => 'required|string|max:50|unique:aset,id_aset',
                'nama_aset' => 'required|string|max:100',
                'tanggal_masuk' => 'required|date',
                'jumlah' => 'required|integer|min:1|max:99999999999',
                'jenis_aset' => 'required|exists:jenis,id_jenis',
                'id_pic' => 'required|exists:pic,id_pic',
                'id_divisi' => 'required|exists:divisi,id_divisi',
                'id_ruang' => 'required|exists:ruang,id_ruang',
                'details.*.id_detail_aset' => 'required|string|max:50',
                'details.*.serial_number' => 'required|string|max:100',
                'details.*.id_bahan' => 'required|exists:bahan,id_bahan',
                'details.*.id_merk' => 'required|exists:merk,id_merk',
                'details.*.kondisi' => 'required|string|in:normal,rusak,perlu perbaikan',
            ];
        }
    }

    public function render()
    {
        return view('livewire.aset.create-aset', [
            'jenis' => Jenis::all(),
            'merk' => Merk::all(),
            'bahan' => Bahan::all(),
            'divisi' => Divisi::all(),
            'pic' => PIC::all(),
            'ruang' => Ruang::all(),
            'aset' => Aset::all(),
        ]);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, $this->rules());
    }

    public function addDetail()
    {
        $this->details[] = [
            'id_detail_aset' => '',
            'serial_number' => '',
            'id_bahan' => '',
            'id_merk' => '',
            'kondisi' => '',
        ];
    }

    public function removeDetail($index)
    {
        unset($this->details[$index]);
        $this->details = array_values($this->details);
    }

    public function store()
    {
        // Validasi berdasarkan mode aktif
        $this->validate($this->rules());

        // Jika mode TIDAK TERDAFTAR → buat data aset baru
        if ($this->mode === 'tidak-terdaftar') {
            Aset::create([
                'id_aset' => $this->id_aset,
                'nama_aset' => $this->nama_aset,
                'jenis_aset' => $this->jenis_aset,
            ]);
        }

        // Buat data aset_masuk
        $id_aset_masuk = $this->randomString();
        $aset_masuk = AsetMasuk::create([
            'id_aset_masuk' => $id_aset_masuk,
            'tanggal_masuk' => $this->tanggal_masuk,
            'jumlah' => $this->jumlah,
            'id_pic' => $this->id_pic,
            'id_divisi' => $this->id_divisi,
            'id_ruang' => $this->id_ruang,
        ]);

        // Simpan setiap detail aset
        foreach ($this->details as $detail) {
            $detail_aset = DetailAset::create([
                'id_detail_aset' => $detail['id_detail_aset'],
                'id_aset' => $this->id_aset,
                'serial_number' => $detail['serial_number'],
                'id_bahan' => $detail['id_bahan'],
                'id_merk' => $detail['id_merk'],
                'kondisi' => $detail['kondisi'],
            ]);

            DetailAsetMasuk::create([
                'id_detail_aset_masuk' => $this->randomString(),
                'id_aset_masuk' => $aset_masuk->id_aset_masuk,
                'id_detail_aset' => $detail_aset->id_detail_aset,
            ]);
        }

        session()->flash('success', 'Aset dan detail berhasil disimpan!');
        $this->resetForm();

        return redirect()->intended('/aset')->with('success', 'Aset berhasil disimpan!');
    }

    public function resetForm()
    {
        $this->reset(['id_aset', 'nama_aset', 'jenis_aset', 'tanggal_masuk', 'jumlah', 'id_pic', 'id_divisi', 'id_ruang', 'details']);
        $this->resetValidation();
    }
}
