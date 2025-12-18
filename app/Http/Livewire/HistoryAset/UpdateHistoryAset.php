<?php

namespace App\Http\Livewire\HistoryAset;

use Livewire\Component;
use App\Models\MutasiAset;
use App\Models\DetailMutasiAset;
use App\Models\Aset;
use App\Models\PIC;
use App\Models\Divisi;
use App\Models\DetailAset;
use App\Models\HistoryAset;
use Illuminate\Support\Facades\DB;

class UpdateHistoryAset extends Component
{
    public $id_mutasi_aset;
    public $id_aset;
    public $tanggal_mutasi;
    public $jenis_mutasi;
    public $id_pic;

    public $details = [];

    // data dropdown
    public $aset = [];
    public $pic = [];
    public $divisi = [];
    public $detail_aset = [];

    public function mount($id)
    {
        $mutasi = MutasiAset::with('details')
            ->where('id_mutasi_aset', $id)
            ->first();

        if (!$mutasi) {
            session()->flash('error', 'Data mutasi tidak ditemukan');
            return redirect()->route('manajemen-history-aset');
        }

        $this->id_mutasi_aset = $mutasi->id_mutasi_aset;
        $this->id_aset = $mutasi->id_aset;
        $this->tanggal_mutasi = $mutasi->tanggal_mutasi;
        $this->jenis_mutasi = $mutasi->history->jenis_mutasi;
        $this->id_pic = $mutasi->id_pic;

        $this->details = $mutasi->details->map(function ($d) {
            return [
                'id_detail_mutasi_aset' => $d->id_detail_mutasi_aset,
                'id_detail_aset' => $d->id_detail_aset,
                'id_divisi' => $d->id_divisi,
            ];
        })->toArray();

        $this->aset = Aset::orderBy('nama_aset')->get();
        $this->pic = PIC::orderBy('nama_pic')->get();
        $this->divisi = Divisi::orderBy('nama_divisi')->get();

        $this->loadDetailAset();
    }

    public function loadDetailAset()
    {
        if ($this->id_aset) {
            $this->detail_aset = DetailAset::where('id_aset', $this->id_aset)->get();
        }
    }

    public function updatedIdAset()
    {
        $this->loadDetailAset();
        $this->details = [];
    }

    public function addDetail()
    {
        $this->details[] = [
            'id_detail_mutasi_aset' => null,
            'id_detail_aset' => '',
            'id_divisi' => '',
        ];
    }

    public function removeDetail($index)
    {
        unset($this->details[$index]);
        $this->details = array_values($this->details);
    }

    protected $rules = [
        'id_aset' => 'required|exists:aset,id_aset',
        'tanggal_mutasi' => 'required|date',
        'jenis_mutasi' => 'required|in:masuk,keluar',
        'id_pic' => 'required|exists:pic,id_pic',
        'details' => 'required|array|min:1',
        'details.*.id_detail_aset' => 'required|exists:detail_aset,id_detail_aset',
        'details.*.id_divisi' => 'required|exists:divisi,id_divisi',
    ];

    public function update()
    {
        $this->validate();

        DB::transaction(function () {

            MutasiAset::where('id_mutasi_aset', $this->id_mutasi_aset)->update([
                'id_aset' => $this->id_aset,
                'tanggal_mutasi' => $this->tanggal_mutasi,
                'id_pic' => $this->id_pic,
            ]);

            HistoryAset::updateOrCreate(
                [
                    'id_mutasi_aset' => $this->id_mutasi_aset
                ],
                [
                    'jenis_mutasi' => $this->jenis_mutasi,
                    'tanggal_mutasi' => $this->tanggal_mutasi,
                ]
            );

            $existingIds = DetailMutasiAset::where('id_mutasi_aset', $this->id_mutasi_aset)
                ->pluck('id_detail_mutasi_aset')
                ->toArray();

            $usedIds = [];

            foreach ($this->details as $detail) {

                if (!empty($detail['id_detail_mutasi_aset'])) {

                    DetailMutasiAset::where('id_detail_mutasi_aset', $detail['id_detail_mutasi_aset'])
                        ->update([
                            'id_detail_aset' => $detail['id_detail_aset'],
                            'id_divisi' => $detail['id_divisi'],
                        ]);

                    $usedIds[] = $detail['id_detail_mutasi_aset'];
                }
                else {
                    $new = DetailMutasiAset::create([
                        'id_mutasi_aset' => $this->id_mutasi_aset,
                        'id_detail_aset' => $detail['id_detail_aset'],
                        'id_divisi' => $detail['id_divisi'],
                    ]);

                    $usedIds[] = $new->id_detail_mutasi_aset;
                }
            }

            $deleteIds = array_diff($existingIds, $usedIds);

            if (!empty($deleteIds)) {
                DetailMutasiAset::whereIn('id_detail_mutasi_aset', $deleteIds)->delete();
            }
        });

        session()->flash('success', 'Data mutasi aset berhasil diperbarui');
        return redirect()->route('manajemen-history-aset');
    }

    public function render()
    {
        return view('livewire.history-aset.update-history-aset');
    }
}
