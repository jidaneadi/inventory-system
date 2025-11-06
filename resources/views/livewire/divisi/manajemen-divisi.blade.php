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
                    <li class="breadcrumb-item"><a href="#">Divisi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar Divisi</li>
                </ol>
            </nav>
            <h2 class="h4">Daftar Divisi</h2>
        </div>
    </div>

    <div class="table-settings mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-9 col-lg-8 d-md-flex">
                {{-- SEARCH --}}
                <div class="input-group me-2 me-lg-3 fmxw-300">
                    <span class="input-group-text">
                        <svg class="icon icon-xs" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <input wire:model.debounce.300ms="search" type="text" class="form-control"
                        placeholder="Cari divisi...">
                </div>

                {{-- FILTER GEDUNG --}}
                {{-- <select wire:model="filterGedung" class="form-select fmxw-200 d-none d-md-inline">
                    <option value="">Semua Gedung</option>
                    @foreach ($gedung as $g)
                        <option value="{{ $g->id_divisi }}">{{ $g->nama_gedung }}</option>
                    @endforeach
                </select> --}}
            </div>

            <div class="col-3 col-lg-4 d-flex justify-content-end align-items-center">
                <a href="/divisi/create" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center me-2">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                        </path>
                    </svg>
                    <span class="d-md-inline d-none">Tambah Divisi</span>
                </a>

                {{-- SHOW PER PAGE --}}
                <div class="btn-group">
                    <div class="dropdown me-1">
                        <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-1"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4a1 1 0 011-1zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z">
                                </path>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end pb-0">
                            <span class="small ps-3 fw-bold text-dark">Show</span>
                            @foreach ([ 5, 10, 20, 30, 40, 50 ] as $jumlah)
                                <a wire:click.prevent="setPerPage({{ $jumlah }})"
                                    class="dropdown-item d-flex align-items-center fw-bold {{ $perPage == $jumlah ? 'active text-primary' : '' }}"
                                    href="#">
                                    {{ $jumlah }}
                                    @if ($perPage == $jumlah)
                                        <svg class="icon icon-xxs ms-auto" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card card-body shadow border-0 table-wrapper table-responsive">
        {{-- TABLE --}}
        <table class="table user-table table-hover align-items-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($divisi as $d)
                    <tr wire:key="divisi-{{$d->id_divisi }}">
                        <td>{{$d->id_divisi }}</td>
                        <td>{{$d->nama_divisi }}</td>
                        <td>{{$d->updated_at }}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                        </path>
                                    </svg>
                                </button>
                                <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{ url('divisi/update/' .$d->id_divisi) }}">
                                        <span class="fas fa-edit me-2"></span> Update divisi
                                    </a>
                                    <button type="button" wire:click="destroy('{{$d->id_divisi }}')"
                                        class="dropdown-item text-danger d-flex align-items-center">
                                        <span class="fas fa-trash-alt me-2"></span> Delete divisi
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada data divisi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="card-footer d-flex justify-content-between align-items-center">
            <div>
                Menampilkan {{ $divisi->firstItem() }} - {{ $divisi->lastItem() }} dari {{ $divisi->total() }} data
            </div>
            <div>
                {{ $divisi->links() }}
            </div>
        </div>
    </div>

    <script>
        // Konfirmasi delete
        function confirmDelete(event) {
            event.preventDefault();
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data ruangan yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jalankan event Livewire aslinya
                    const button = event.target.closest('button[wire\\:click]');
                    if (button) {
                        const livewireClick = button.getAttribute('wire:click');
                        const match = livewireClick.match(/\((\d+)\)/);
                        if (match) {
                            const id = match[1];
                            Livewire.find(
                                Object.keys(window.Livewire.components.componentsById)[0]
                            ).call('destroy', id);
                        }
                    }
                }
            });
        }

        // Script alert
        document.addEventListener('livewire:load', function() {
            Livewire.on('alert', data => {
                Swal.fire({
                    icon: data.type,
                    title: data.message,
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        });
    </script>
</div>
