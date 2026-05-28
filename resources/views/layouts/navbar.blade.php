<header class="navbar-custom d-flex justify-content-between align-items-center">
    <div>
        <h5 class="mb-0 fw-bold">@yield('page-title', 'Overview')</h5>
    </div>
    <div class="d-flex align-items-center gap-3">
        <div class="text-end d-none d-md-block">
            <p class="mb-0 fw-semibold text-dark" style="font-size: 0.9rem;">{{ auth()->user()->name }}</p>
            <p class="mb-0 text-muted" style="font-size: 0.75rem;">{{ auth()->user()->email }}</p>
        </div>
        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0D8ABC&color=fff"
            alt="Profile" class="rounded-circle" width="40" height="40">
        <form method="POST" action="{{ route('logout') }}" class="d-inline m-0 p-0">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm fw-bold">
                <i class="fa-solid fa-right-from-bracket me-1"></i> Keluar
            </button>
        </form>
    </div>
</header>
