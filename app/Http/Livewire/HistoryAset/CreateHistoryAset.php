<?php

namespace App\Http\Livewire\HistoryAset;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Aset;
use App\Models\DetailAset;
use App\Models\Divisi;
use App\Models\PIC;
use Illuminate\Support\Str;
use App\Models\Jenis;
use App\Models\MutasiAset;
use App\Models\HistoryAset;
use App\Models\DetailMutasiAset;

class CreateHistoryAset extends Component
{
    public $id_aset, $tanggal_mutasi, $jenis_mutasi, $id_pic, $id_mutasi_aset;

    public $details = [];
    public $filteredDetailAset = [];

    protected $rules = [
        // 'id_mutasi_aset' => 'required',
        'id_aset' => 'required|exists:aset,id_aset',
        'tanggal_mutasi' => 'required|date',
        'jenis_mutasi' => 'required',
        'id_pic' => 'required|exists:pic,id_pic',

        'details' => 'required|array|min:1',
        'details.*.id_detail_aset' => 'required|exists:detail_aset,id_detail_aset',
        'details.*.id_divisi' => 'required|exists:divisi,id_divisi',
    ];

    private function generateIdMutasiAset(): string
    {
        do {
            $id = '' . strtoupper(Str::random(11)); // total 11 karakter
        } while (MutasiAset::where('id_mutasi_aset', $id)->exists());

        return $id;
    }

    public function render()
    {
        return view('livewire.history-aset.create-history-aset', [
            'aset' => Aset::all(),
            'detail_aset' => $this->filteredDetailAset,
            'divisi' => Divisi::all(),
            'pic' => PIC::all(),
            'jenis' => Jenis::all(),
        ]);
    }

    public function addDetail()
    {
        $this->details[] = [
            'id_detail_aset' => null,
            'id_divisi' => null,
        ];
    }

    public function removeDetail($index)
    {
        unset($this->details[$index]);
        $this->details = array_values($this->details);
    }

    public function updatedIdAset($value)
    {
        $this->details = [];
        $this->filteredDetailAset = DetailAset::where('id_aset', $value)->get();
    }

    public function store()
    {
        $this->validate();

        DB::transaction(function () {

            $idMutasi = $this->generateIdMutasiAset();

            $mutasi = MutasiAset::create([
                'id_mutasi_aset' => $idMutasi,
                'id_aset' => $this->id_aset,
                'id_pic' => $this->id_pic,
                'tanggal_mutasi' => $this->tanggal_mutasi,
            ]);

            HistoryAset::create([
                'id_mutasi_aset' => $idMutasi,
                'jenis_mutasi' => $this->jenis_mutasi,
                'tanggal_mutasi' => $this->tanggal_mutasi,
            ]);

            foreach ($this->details as $d) {
                DetailMutasiAset::create([
                    'id_mutasi_aset' => $idMutasi,
                    'id_detail_aset' => $d['id_detail_aset'],
                    'id_divisi' => $d['id_divisi'],
                ]);
            }
        });

        return redirect()
            ->route('manajemen-history-aset')
            ->with('success', 'Data mutasi aset berhasil disimpan');
    }

}
