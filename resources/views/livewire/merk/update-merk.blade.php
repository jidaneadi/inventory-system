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
                    <li class="breadcrumb-item"><a href="#">Merk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update Merk</li>
                </ol>
            </nav>
            <h2 class="h4">Update Merk</h2>
        </div>
    </div>

    <div class="card card-body shadow border-0">
        <div class="row mb-4">
            <div class="col-lg-6">
                <label>Nama</label>
                <input type="text" wire:model.debounce.500ms="nama_merk" class="form-control">
                @error('nama_merk')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="text-end mt-4">
                <button wire:click="update" class="btn btn-success me-2">Simpan</button>
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
</div>
