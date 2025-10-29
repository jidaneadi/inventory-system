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
use Illuminate\Support\Facades\DB;

class UpdateAset extends Component
{
    public $id_aset, $nama_aset, $jenis_aset, $tanggal_masuk, $jumlah, $id_pic, $id_divisi, $id_ruang;
    public $details = [];

    public function mount($id_aset)
    {
        if (!$id_aset) {
            session()->flash('error', 'ID aset tidak ditemukan.');
            return redirect()->route('manajemen-aset');
        }

        // Query untuk ambil data aset + relasi lengkap
        $aset = Aset::where('aset.id_aset', $id_aset)
            ->join('detail_aset', 'detail_aset.id_aset', '=', 'aset.id_aset')
            ->join('detail_aset_masuk', 'detail_aset_masuk.id_detail_aset', '=', 'detail_aset.id_detail_aset')
            ->join('aset_masuk', 'aset_masuk.id_aset_masuk', '=', 'detail_aset_masuk.id_aset_masuk')
            ->select(
                'aset.*',
                'aset_masuk.tanggal_masuk',
                'aset_masuk.jumlah',
                'aset_masuk.id_pic',
                'aset_masuk.id_divisi',
                'aset_masuk.id_ruang'
            )
            ->first();

        if (!$aset) {
            session()->flash('error', 'Data aset tidak ditemukan.');
            return redirect()->route('aset'); // arahkan ke halaman aset
        }
        // dd($aset);
        // Isi properti utama
        $this->id_aset = $aset->id_aset;
        $this->nama_aset = $aset->nama_aset;
        $this->jenis_aset = $aset->jenis_aset;
        $this->tanggal_masuk = $aset->tanggal_masuk;
        $this->jumlah = $aset->jumlah;
        $this->id_pic = $aset->id_pic;
        $this->id_divisi = $aset->id_divisi;
        $this->id_ruang = $aset->id_ruang;

        // Ambil detail aset terkait
        $this->details = DetailAset::where('id_aset', $id_aset)
            ->get(['id_detail_aset', 'serial_number', 'id_bahan', 'id_merk', 'kondisi'])
            ->map(function ($detail) {
                return [
                    'id_detail_aset' => $detail->id_detail_aset,
                    'serial_number' => $detail->serial_number,
                    'id_bahan' => $detail->id_bahan,
                    'id_merk' => $detail->id_merk,
                    'kondisi' => $detail->kondisi,
                ];
            })->toArray();
    }

    protected $rules = [
        'id_aset' => 'required|string|max:50',
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

    public function render()
    {
        return view('livewire.aset.update-aset', [
            'jenis' => Jenis::all(),
            'merk' => Merk::all(),
            'bahan' => Bahan::all(),
            'divisi' => Divisi::all(),
            'pic' => PIC::all(),
            'ruang' => Ruang::all()
        ]);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
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

    public function update()
    {
        $this->validate();

        DB::transaction(function () {
            // Update tabel aset
            Aset::where('id_aset', $this->id_aset)->update([
                'nama_aset' => $this->nama_aset,
                'jenis_aset' => $this->jenis_aset,
            ]);

            // Cari id_aset_masuk terkait
            $detailMasuk = DetailAsetMasuk::join('detail_aset', 'detail_aset.id_detail_aset', '=', 'detail_aset_masuk.id_detail_aset')
                ->where('detail_aset.id_aset', $this->id_aset)
                ->first();

            if ($detailMasuk) {
                AsetMasuk::where('id_aset_masuk', $detailMasuk->id_aset_masuk)->update([
                    'tanggal_masuk' => $this->tanggal_masuk,
                    'jumlah' => $this->jumlah,
                    'id_pic' => $this->id_pic,
                    'id_divisi' => $this->id_divisi,
                    'id_ruang' => $this->id_ruang,
                ]);
            }

            // Update detail_aset
            foreach ($this->details as $detail) {
                DetailAset::updateOrCreate(
                    ['id_detail_aset' => $detail['id_detail_aset']],
                    [
                        'id_aset' => $this->id_aset,
                        'serial_number' => $detail['serial_number'],
                        'id_bahan' => $detail['id_bahan'],
                        'id_merk' => $detail['id_merk'],
                        'kondisi' => $detail['kondisi'],
                    ]
                );
            }
        });

        session()->flash('success', 'Data aset berhasil diperbarui!');
        return redirect()->route('manajemen-aset');
    }
}
