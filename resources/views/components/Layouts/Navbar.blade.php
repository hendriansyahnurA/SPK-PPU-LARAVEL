<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
        onsubmit="return searchPage(event)">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                aria-label="Search" name="search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>


    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                @if (Auth::check())
                    <span
                        class="mr-2 d-none d-lg-inline text-gray-600 small font-weight-bold">{{ Auth::user()->name }}</span>
                @endif
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a class="dropdown-item" href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>

</nav>

<script>
    function searchPage(event) {
        event.preventDefault(); // Mencegah form dari submit secara default

        const searchQuery = event.target.search.value.toLowerCase(); // Ambil nilai input pencarian

        // Daftar halaman yang tersedia
        const pages = {
            'aspek': '{{ route('admin.aspek') }}',
            'kriteria': '{{ route('admin.kriteria') }}',
            'evaluator': '{{ route('admin.evaluator') }}',
            'alternatif': '{{ route('admin.alternatif') }}',
            'klasifikasi': '{{ route('admin.klasifikasi') }}',
            'hasil': '{{ route('admin.hasil') }}',
            // Tambahkan halaman lain sesuai kebutuhan
        };

        // Cek apakah ada halaman yang cocok dengan query pencarian
        const page = pages[searchQuery];

        if (page) {
            window.location.href = page; // Alihkan ke halaman yang cocok
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Halaman tidak ditemukan',
                text: 'Silakan periksa kembali kata kunci pencarian Anda.',
                confirmButtonText: 'Tutup'
            });
        }
    }
</script>
