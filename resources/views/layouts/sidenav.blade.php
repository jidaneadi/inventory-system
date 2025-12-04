<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        <div class="sidebar-close-btn d-lg-none text-end mb-3">
            <button id="sidebarClose" class="btn btn-sm btn-light">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                    class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="sidebar-icon">
                        <i class="fas fa-home"></i>
                    </span>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed d-flex justify-content-between align-items-center {{ request()->routeIs('manajemen-aset', 'create-aset', 'update-aset') ? '' : '' }}"
                    data-bs-toggle="collapse" href="#submenu-aset">
                    <span>
                        <span class="sidebar-icon"><i class="fas fa-boxes"></i></span>
                        <span>Aset</span>
                    </span>
                    <span class="link-arrow"><i class="fas fa-chevron-right"></i></span>
                </a>
                <div class="multi-level collapse {{ request()->routeIs('manajemen-aset', 'create-aset', 'update-aset') ? 'show' : '' }}"
                    id="submenu-aset">
                    <ul class="flex-column nav">
                        <li class="nav-item">
                            <a href="{{ route('manajemen-aset') }}"
                                class="nav-link {{ request()->routeIs('manajemen-aset') ? 'active' : '' }}">
                                Manajemen Aset
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-muted">
                                History Aset
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="{{ route('manajemen-ruangan') }}"
                    class="nav-link {{ request()->routeIs('manajemen-ruangan') ? 'active' : '' }}">
                    <span class="sidebar-icon"><i class="fas fa-door-open"></i></span>
                    <span>Ruangan</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('manajemen-gedung') }}"
                    class="nav-link {{ request()->routeIs('manajemen-gedung') ? 'active' : '' }}">
                    <span class="sidebar-icon"><i class="fas fa-building"></i></span>
                    <span>Gedung</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('manajemen-jenis-aset') }}"
                    class="nav-link {{ request()->routeIs('manajemen-jenis-aset') ? 'active' : '' }}">
                    <span class="sidebar-icon"><i class="fas fa-tags"></i></span>
                    <span>Jenis Aset</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('manajemen-divisi') }}"
                    class="nav-link {{ request()->routeIs('manajemen-divisi') ? 'active' : '' }}">
                    <span class="sidebar-icon"><i class="fas fa-sitemap"></i></span>
                    <span>Divisi</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('manajemen-bahan') }}"
                    class="nav-link {{ request()->routeIs('manajemen-bahan') ? 'active' : '' }}">
                    <span class="sidebar-icon"><i class="fas fa-cubes"></i></span>
                    <span>Bahan</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('manajemen-merk') }}"
                    class="nav-link {{ request()->routeIs('manajemen-merk') ? 'active' : '' }}">
                    <span class="sidebar-icon"><i class="fas fa-bookmark"></i></span>
                    <span>Merk</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('manajemen-pic') }}"
                    class="nav-link {{ request()->routeIs('manajemen-pic') ? 'active' : '' }}">
                    <span class="sidebar-icon"><i class="fas fa-user-tie"></i></span>
                    <span>PIC</span>
                </a>
            </li>
        </ul>
        <hr class="sidebar-divider my-3">
        <div class="d-grid">
            <livewire:logout mode="sidebar" />
        </div>
    </div>
</nav>
<script>
    document.getElementById('sidebarClose')?.addEventListener('click', function () {
        var sidebar = document.getElementById('sidebarMenu');
        var bsCollapse = bootstrap.Collapse.getInstance(sidebar);
        if (bsCollapse) {
            bsCollapse.hide();
        }
    });
</script>
