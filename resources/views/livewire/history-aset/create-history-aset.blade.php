<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Mutasi Aset</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Mutasi Aset</li>
                </ol>
            </nav>
            <h2 class="h4">Tambah Mutasi Aset</h2>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button wire:click="addDetail" class="btn btn-sm btn-gray-800">
                <i class="bi bi-plus-circle"></i> Tambah Detail
            </button>
        </div>
    </div>

    <div class="card card-body shadow border-0">
        <div class="row mb-3">
            {{-- <div class="col-lg-4">
                <label>ID Mutasi</label>
                <input type="text" wire:model.debounce.500ms="id_mutasi_aset" class="form-control">
                @error('id_mutasi_aset')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div> --}}
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
                @error('id_aset') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-lg-4">
                <label>Tanggal Mutasi</label>
                <input type="date" wire:model="tanggal_mutasi" class="form-control">
                @error('tanggal_mutasi') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-lg-4">
                <label>Jenis Mutasi</label>
                <select wire:model="jenis_mutasi" class="form-select">
                    <option value="">Pilih Jenis</option>
                    <option value="masuk">Aset Masuk</option>
                    <option value="keluar">Aset Keluar</option>
                </select>
                @error('jenis_mutasi') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-4">
                <label>PIC</label>
                <select wire:model="id_pic" class="form-select">
                    <option value="">Pilih PIC</option>
                    @foreach ($pic as $p)
                        <option value="{{ $p->id_pic }}">{{ $p->nama_pic }}</option>
                    @endforeach
                </select>
                @error('id_pic') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <hr>

        {{-- DETAIL --}}
        @foreach ($details as $index => $detail)
            <div class="border rounded p-3 mb-3">
                <div class="row">
                    <div class="col-lg-5">
                        <label>Detail Aset (Serial)</label>
                        <select wire:model="details.{{ $index }}.id_detail_aset"
                            class="form-select"
                            @if (!$id_aset) disabled @endif>
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
                        <button type="button"
                            wire:click="removeDetail({{ $index }})"
                            class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        @endforeach

        @error('details')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        <div class="text-end mt-4">
            <button type="button" wire:click="store" class="btn btn-success">
                Simpan
            </button>
        </div>
    </div>
</div>
