<div>
    <div class="d-flex justify-content-between align-items-center py-4">
        <div>
            <h2 class="h4">Update Mutasi Aset</h2>
        </div>
        <button wire:click="addDetail" class="btn btn-sm btn-gray-800">
            Tambah Detail
        </button>
    </div>

    <div class="card card-body shadow border-0">

        <div class="row mb-3">
            <div class="col-lg-4">
                <label>ID Mutasi</label>
                <input type="text" class="form-control" wire:model="id_mutasi_aset" readonly>
            </div>

            <div class="col-lg-4">
                <label>ID Aset</label>
                <select wire:model="id_aset" class="form-select">
                    <option value="">Pilih Aset</option>
                    @foreach ($aset as $a)
                        <option value="{{ $a->id_aset }}">
                            {{ $a->id_aset }} - {{ $a->nama_aset }}
                        </option>
                    @endforeach
                </select>
                @error('id_aset')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-lg-4">
                <label>Tanggal Mutasi</label>
                <input type="date" wire:model="tanggal_mutasi" class="form-control">
                @error('tanggal_mutasi')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-4">
                <label>Jenis Mutasi</label>
                <select wire:model="jenis_mutasi" class="form-select">
                    <option value="">Pilih Jenis</option>
                    <option value="masuk">Aset Masuk</option>
                    <option value="keluar">Aset Keluar</option>
                </select>
                @error('jenis_mutasi') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-lg-4">
                <label>PIC</label>
                <select wire:model="id_pic" class="form-select">
                    <option value="">Pilih PIC</option>
                    @foreach ($pic as $p)
                        <option value="{{ $p->id_pic }}">{{ $p->nama_pic }}</option>
                    @endforeach
                </select>
                @error('id_pic')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <hr>

        @foreach ($details as $index => $detail)
            <div class="border rounded p-3 mb-3">
                <div class="row">
                    <div class="col-lg-5">
                        <label>Serial Aset</label>
                        <select wire:model="details.{{ $index }}.id_detail_aset" class="form-select">
                            <option value="">Pilih Serial</option>
                            @foreach ($detail_aset as $d)
                                <option value="{{ $d->id_detail_aset }}">
                                    {{ $d->serial_number }}
                                </option>
                            @endforeach
                        </select>
                        @error("details.$index.id_detail_aset")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-lg-5">
                        <label>Divisi</label>
                        <select wire:model="details.{{ $index }}.id_divisi" class="form-select">
                            <option value="">Pilih Divisi</option>
                            @foreach ($divisi as $dv)
                                <option value="{{ $dv->id_divisi }}">{{ $dv->nama_divisi }}</option>
                            @endforeach
                        </select>
                        @error("details.$index.id_divisi")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-lg-2 d-flex align-items-end">
                        <button wire:click="removeDetail({{ $index }})"
                            class="btn btn-danger btn-sm">Hapus</button>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="text-end">
            <button wire:click="update" class="btn btn-success">
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>
