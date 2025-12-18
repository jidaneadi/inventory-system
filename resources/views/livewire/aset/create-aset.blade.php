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
                    <li class="breadcrumb-item"><a href="#">Aset</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Aset</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-center mb-4">
                <div class="btn-group" role="group" aria-label="Toggle Mode">
                    <button
                        type="button"
                        wire:click="setMode('terdaftar')"
                        class="btn {{ $mode === 'terdaftar' ? 'btn-success' : 'btn-outline-secondary' }}"
                    >
                        <i class="bi bi-check-circle me-1"></i> Aset Terdaftar
                    </button>

                    <button
                        type="button"
                        wire:click="setMode('tidak-terdaftar')"
                        class="btn {{ $mode === 'tidak-terdaftar' ? 'btn-danger' : 'btn-outline-secondary' }}"
                    >
                        <i class="bi bi-x-circle me-1"></i> Aset Tidak Terdaftar
                    </button>
                </div>
            </div>
            <h2 class="h4">Tambah Aset</h2>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button wire:click="addDetail" class="btn btn-sm btn-gray-800">
                <i class="bi bi-plus-circle"></i> Tambah Detail
            </button>
        </div>
    </div>

    <div class="card card-body shadow border-0">
        <div class="row mb-4">
            @if ($mode === 'terdaftar')
            <!-- FORM untuk aset tidak terdaftar -->
            <div class="col-lg-4">
                <label>ID Aset</label>
                <select wire:model="id_aset" class="form-select">
                    <option value="">Pilih ID Aset</option>
                    @foreach ($aset as $a)
                        <option value="{{ $a->id_aset }}">{{ $a->id_aset }} - {{ $a->nama_aset }}</option>
                    @endforeach
                </select>
                @error('id_aset')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            @else
            <!-- FORM untuk aset terdaftar -->
            <div class="col-lg-4">
                <label>ID</label>
                <input type="text" wire:model.debounce.500ms="id_aset" class="form-control">
                @error('id_aset')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-lg-4">
                <label>Nama</label>
                <input type="text" wire:model.debounce.500ms="nama_aset" class="form-control">
                @error('nama_aset')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-lg-4">
                <label>Jenis</label>
                <select wire:model="jenis_aset" class="form-select">
                    <option value="">Pilih Jenis</option>
                    @foreach ($jenis as $j)
                        <option value="{{ (string) $j->id_jenis }}">{{ $j->nama_jenis }}</option>
                    @endforeach
                </select>
                @error('jenis_aset')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            @endif

            <div class="col-lg-4">
                <label>Tanggal Masuk</label>
                <input type="date" wire:model.debounce.500ms="tanggal_masuk" class="form-control">
                @error('tanggal_masuk')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-lg-4">
                <label>Jumlah</label>
                <input type="number" wire:model.debounce.500ms="jumlah" class="form-control">
                @error('jumlah')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-lg-4">
                <label>PIC</label>
                <select wire:model="id_pic" class="form-select">
                    <option value="">Pilih PIC</option>
                    @foreach ($pic as $p)
                        <option value="{{ (string) $p->id_pic }}">{{ $p->nama_pic }}</option>
                    @endforeach
                </select>
                @error('id_pic')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-lg-4">
                <label>Divisi</label>
                <select wire:model="id_divisi" class="form-select">
                    <option value="">Pilih Divisi</option>
                    @foreach ($divisi as $d)
                        <option value="{{ (string) $d->id_divisi }}">{{ $d->nama_divisi }}</option>
                    @endforeach
                </select>
                @error('id_divisi')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-lg-4">
                <label>Ruang</label>
                <select wire:model="id_ruang" class="form-select">
                    <option value="">Pilih Ruang</option>
                    @foreach ($ruang as $r)
                        <option value="{{ (string) $r->id_ruang }}">{{ $r->nama_ruang }}</option>
                    @endforeach
                </select>
                @error('id_ruang')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- DETAIL FORM --}}
        @foreach ($details as $index => $detail)
            <div class="border rounded p-3 mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label>ID Detail</label>
                        <input type="text" wire:model="details.{{ $index }}.id_detail_aset"
                            class="form-control">
                        @error("details.$index.id_detail_aset")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label>Serial Number</label>
                        <input type="text" wire:model.debounce.500ms="details.{{ $index }}.serial_number"
                            class="form-control">
                        @error("details.$index.serial_number")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3">
                        <label>Bahan</label>
                        <select wire:model="details.{{ $index }}.id_bahan" class="form-select">
                            <option value="">Pilih Bahan</option>
                            @foreach ($bahan as $b)
                                <option value="{{ (string) $b->id_bahan }}">{{ $b->nama_bahan }}</option>
                            @endforeach
                        </select>
                        @error("details.$index.id_bahan")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3">
                        <label>Merk</label>
                        <select wire:model="details.{{ $index }}.id_merk" class="form-select">
                            <option value="">Pilih Merk</option>
                            @foreach ($merk as $m)
                                <option value="{{ (string) $m->id_merk }}">{{ $m->nama_merk }}</option>
                            @endforeach
                        </select>
                        @error("details.$index.id_merk")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3">
                        <label>Kondisi</label>
                        <select wire:model="details.{{ $index }}.kondisi" class="form-select">
                            <option value="">Pilih Kondisi</option>
                            <option value="normal">Normal</option>
                            <option value="rusak">Rusak</option>
                            <option value="perlu perbaikan">Perlu Perbaikan</option>
                        </select>
                        @error("details.$index.kondisi")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="text-end mt-3">
                        <button wire:click="removeDetail({{ $index }})" type="button"
                            class="btn btn-danger btn-sm">Hapus</button>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- TOMBOL AKSI --}}
        <div class="text-end mt-4">
            <button wire:click="store" class="btn btn-success me-2">Simpan</button>
            <button wire:click="resetForm" class="btn btn-secondary">Batal</button>
        </div>
    </div>

    {{-- Notifikasi --}}
    @if (session()->has('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
</div>
