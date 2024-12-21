<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ '/admin/dashboard' }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SPK-PPU <sup>'</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ '/admin/dashboard' }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Utama :
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data PPU :</h6>
                <a class="collapse-item" href="{{ '/admin/alternatif' }}">Data Alternatif</a>
                <a class="collapse-item" href="{{ '/admin/evaluator' }}">Data Evaluator</a>
            </div>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Data Penilaian</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Penilaian :</h6>
                <a class="collapse-item" href="{{ '/admin/aspek' }}">Data Aspek</a>
                <a class="collapse-item" href="{{ '/admin/kriteria' }}">Data Kriteria</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Perhitungan Profile Matching :
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ '/admin/klasifikasi' }}">
            <i class="fas fa-fw fa-solid fa-calculator"></i>
            <span>Klasifikasi</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ '/admin/hasil' }}">
            <i class="fas fa-fw fa-solid fa-box-tissue"></i>
            <span>Hasil Akhir</span></a>
    </li>
    <hr class="sidebar-divider">
</ul>
