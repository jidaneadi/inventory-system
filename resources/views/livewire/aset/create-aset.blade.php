{{-- <title>Volt Laravel Dashboard - User management</title> --}}
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
        <h2 class="h4">Tambah Aset</h2>
    </div>
</div>
<div class="card card-body shadow border-0 table-wrapper table-responsive">
    <div class="row mb-4">
        <div class="col-lg-4 col-sm-6">
            <div class="mb-4">
                <label for="email">ID</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="mb-4">
                <label for="email">Nama</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
        </div>
        {{-- Tabel Jenis --}}
        <div class="col-lg-4">
            <div class="mb-4">
                <label class="my-1 me-2" for="country">Jenis</label>
                <select class="form-select" id="jenis" name="jenis_aset">
                    <option value="">Pilih Jenis</option>
                    @foreach ($jenis as $j)
                        <option value="{{ $j->id }}">{{ $j->nama_jenis }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        {{-- End Jenis --}}

        {{-- Button Tambah Detail --}}
        <button>Detail</button>
        {{-- End button --}}

        {{-- Form Detail Aset --}}
        <div class="row mb-4">
            <div class="col-sm-6">
                <div class="mb-4">
                    <label for="email">ID Detail</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                        else.</small>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-4">
                    <label for="email">Serial Number</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                        else.</small>
                </div>
            </div>
            {{-- Tabel Bahan --}}
            <div class="col-lg-4 col-sm-6">
                <div class="mb-4">
                    <label class="my-1 me-2" for="country">Bahan</label>
                    <select class="form-select" id="bahan" name="bahan_id">
                        <option value="">Pilih Bahan</option>
                        @foreach ($bahan as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_bahan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- End Bahan --}}

            {{-- Tabel Merk --}}
            <div class="col-lg-4 col-sm-6">
                <div class="mb-4">
                    <label class="my-1 me-2" for="country">Merk</label>
                    <select class="form-select" id="merk" name="merk_id">
                        <option value="">Pilih Merk</option>
                        @foreach ($merk as $m)
                            <option value="{{ $m->id }}">{{ $m->nama_merk }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- End Merk --}}
            <div class="col-lg-4">
                <div class="mb-4">
                    <label class="my-1 me-2" for="country">Kondisi</label>
                    <select class="form-select" id="country" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="normal">Normal</option>
                        <option value="rusak">Rusak</option>
                        <option value="diperbaharui">Diperbaharui</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Form -->
<!-- Form -->
</div>
