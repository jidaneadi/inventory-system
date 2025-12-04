@if ($mode === 'sidebar')
    <button
        type="button"
        wire:click="logout"
        class="btn btn-danger d-flex align-items-center justify-content-center gap-2 w-100"
    >
        <i class="fas fa-sign-out-alt"></i>
        Logout
    </button>

@elseif($mode === 'dropdown')
    <a
        href="#"
        wire:click.prevent="logout"
        class="dropdown-item d-flex align-items-center gap-2"
    >
        <svg class="dropdown-icon text-danger" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
            </path>
        </svg>
        <span>Logout</span>
    </a>
@endif
