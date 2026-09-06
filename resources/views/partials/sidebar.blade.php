<style>
    /* 1. Ganti Warna Kotak Menu Aktif */
    .sidebar-default .nav-item .nav-link.active {
        background-color: #46136b !important;
        color: white !important;
    }

    /* 2. Ganti Warna Lingkaran Tombol Panah */
    .sidebar-default .sidebar-toggle {
        background-color: #46136b !important;
    }

    /* 3. Ganti Warna Saat Menu Di-hover (Kursor di atasnya) */
    .sidebar-default .nav-item .nav-link:hover {
        /* rgba(70, 19, 107, 0.1) ini adalah versi transparan dari ungu #46136b */
        background-color: rgba(70, 19, 107, 0.1) !important; 
        color: #46136b !important; 
    }

    /* 4. Ganti Warna Icon Saat Di-hover Biar Ikut Ungu */
    .sidebar-default .nav-item .nav-link:hover i.icon svg,
    .sidebar-default .nav-item .nav-link:hover i.right-icon svg {
        color: #46136b !important;
    }

    /* 5. Ganti Warna Dropdown (Master Data) Saat Diklik/Terbuka */
    .sidebar-default .nav-item .nav-link[aria-expanded="true"] {
        background-color: #46136b !important;
        color: white !important;
    }
    
    /* Biar icon di dalam dropdown yang terbuka ikut jadi putih */
    .sidebar-default .nav-item .nav-link[aria-expanded="true"] i.icon svg,
    .sidebar-default .nav-item .nav-link[aria-expanded="true"] i.right-icon svg {
        color: white !important;
    }
    
    /* 6. Ganti Warna Teks Sub-menu (Kategori, Daftar Barang) yang Aktif */
    .sidebar-default .sub-nav .nav-item .nav-link.active {
        color: #46136b !important;
        background-color: rgba(70, 19, 107, 0.1) !important;
    }
    
</style>

<aside class="sidebar sidebar-default sidebar-white sidebar-base navs-rounded-all"> 
    <div class="sidebar-header d-flex align-items-center justify-content-start"> 
        <a href="{{ route('dashboard') }}" class="navbar-brand d-flex align-items-center"> 
            
            <img src="{{ asset('logo.png') }}" alt="Logo" style="width: 50px; height: auto;" class="me-2">
            
            <h4 class="logo-title mb-0 fs-3">GadgetZ</h4> 
        </a> 
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true"> 
            <i class="icon"> 
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"> 
                    <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> 
                    <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> 
                </svg> 
            </i> 
        </div> 
    </div> 
    <div class="sidebar-body pt-0 data-scrollbar"> 
        <div class="sidebar-list"> 
            <ul class="navbar-nav iq-main-menu" id="sidebar-menu"> 
                <li class="nav-item static-item"> 
                    <a class="nav-link static-item disabled" href="#" tabindex="-1"> 
                        <span class="default-icon">Menu Utama</span> 
                        <span class="mini-icon">-</span> 
                    </a> 
                </li> 
                <li class="nav-item"> 
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                        aria-current="page" 
                        href="{{ route('dashboard') }}"> 
                        <i class="icon"> 
                            <svg width="20" viewBox="0 0 24 24" fill="none" class="icon-20"> 
                                <path opacity="0.4" d="M16.0756 2H19.4616C20.8639 2 22.0001 3.14585 22.0001 4.55996V7.97452C22.0001 9.38864 20.8639 10.5345 19.4616 10.5345H16.0756C14.6734 10.5345 13.5371 9.38864 13.5371 7.97452V4.55996C13.5371 3.14585 14.6734 2 16.0756 2Z" fill="currentColor"></path> 
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z" fill="currentColor"></path> 
                            </svg> 
                        </i> 
                        <span class="item-name">Dashboard</span> 
                    </a> 
                </li> 
                <li class="nav-item"> 
                    <a class="nav-link {{ request()->routeIs('inventory.*') ? 'active' : '' }}" 
                        href="{{ route('inventory.index') }}"> 
                        <i class="icon"> 
                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"> 
                                <path opacity="0.4" d="M3 7.5L12 2.5L21 7.5V16.5L12 21.5L3 16.5V7.5Z" fill="currentColor"></path> 
                                <path d="M12 12L21 7.5L12 2.5L3 7.5L12 12Z" fill="currentColor"></path> 
                                <path d="M12 12V21.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path> 
                            </svg> 
                        </i> 
                        <span class="item-name">Persediaan Barang</span> 
                    </a> 
                </li> 

                @php 
                $masterActive = request()->routeIs('master-data.kategori-barang.*') 
                || request()->routeIs('master-data.daftar-barang.*') 
                || request()->routeIs('master-data.manajemen-pengguna.*'); 
                @endphp 

                <li class="nav-item"> 
                    <a class="nav-link {{ $masterActive ? 'active' : '' }}" 
                        data-bs-toggle="collapse" 
                        href="#master-data" 
                        role="button" 
                        aria-expanded="{{ $masterActive ? 'true' : 'false' }}" 
                        aria-controls="master-data"> 
                        <i class="icon"> 
                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"> 
                                <path opacity="0.4" d="M16.191 2H7.81C4.77 2 3 3.78 3 6.83V17.16C3 20.26 4.77 22 7.81 22H16.191C19.28 22 21 20.26 21 17.16V6.83C21 3.78 19.28 2 16.191 2Z" fill="currentColor"></path> 
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.08 6.65C7.65 6.65 7.3 7 7.3 7.44C7.3 7.87 7.65 8.22 8.08 8.22H15.92C16.35 8.22 16.7 7.87 16.7 7.44C16.7 7 16.35 6.65 15.92 6.65H8.08ZM8.08 11.18C7.65 11.18 7.3 11.53 7.3 11.96C7.3 12.39 7.65 12.74 8.08 12.74H15.92C16.35 12.74 16.7 12.39 16.7 11.96C16.7 11.53 16.35 11.18 15.92 11.18H8.08ZM8.08 15.74C7.65 15.74 7.3 16.09 7.3 16.53C7.3 16.96 7.65 17.31 8.08 17.31H15.92C16.35 17.31 16.7 16.96 16.7 16.53C16.7 16.09 16.35 15.74 15.92 15.74H8.08Z" fill="currentColor"></path> 
                            </svg> 
                        </i> 
                        <span class="item-name">Master Data</span> 
                        <i class="right-icon"> 
                            <svg class="icon-18" xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"> 
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /> 
                            </svg> 
                        </i> 
                    </a> 
                    <ul class="sub-nav collapse {{ $masterActive ? 'show' : '' }}" 
                        id="master-data" 
                        data-bs-parent="#sidebar-menu"> 

                        <li class="nav-item"> 
                            <a class="nav-link {{ request()->routeIs('master-data.kategori-barang.*') ? 'active' : '' }}" 
                                href="{{ route('master-data.kategori-barang.index') }}"> 
                                <i class="icon"> 
                                    <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor"> 
                                        <circle cx="12" cy="12" r="8" /> 
                                    </svg> 
                                </i> 
                                <i class="sidenav-mini-icon">K</i> 
                                <span class="item-name">Kategori Barang</span> 
                            </a> 
                        </li> 
                        <li class="nav-item"> 
                            <a class="nav-link {{ request()->routeIs('master-data.daftar-barang.*') ? 'active' : '' }}" 
                                href="{{ route('master-data.daftar-barang.index') }}"> 
                                <i class="icon"> 
                                    <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor"> 
                                        <circle cx="12" cy="12" r="8" /> 
                                    </svg> 
                                </i> 
                                <i class="sidenav-mini-icon">B</i> 
                                <span class="item-name">Daftar Barang</span> 
                            </a> 
                        </li> 
                        <li class="nav-item"> 
                            <a class="nav-link {{ request()->routeIs('master-data.manajemen-pengguna.*') ? 'active' : '' }}" 
                                href="{{ route('master-data.manajemen-pengguna.index') }}"> 
                                <i class="icon"> 
                                    <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor"> 
                                        <circle cx="12" cy="12" r="8" /> 
                                    </svg> 
                                </i> 
                                <i class="sidenav-mini-icon">U</i> 
                                <span class="item-name">Manajemen Pengguna</span> 
                            </a> 
                        </li> 
                    </ul> 
                </li> 
                <li class="nav-item"> 
                    <a class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}" 
                        href="{{ route('reports.index') }}"> 
                        <i class="icon"> 
                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"> 
                                <path opacity="0.4" d="M16.191 2H7.81C4.77 2 3 3.78 3 6.83V17.16C3 20.26 4.77 22 7.81 22H16.191C19.28 22 21 20.26 21 17.16V6.83C21 3.78 19.28 2 16.191 2Z" fill="currentColor"></path> 
                                <path d="M8 8H16M8 12H16M8 16H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path> 
                            </svg> 
                        </i> 
                        <span class="item-name">Laporan</span> 
                    </a> 
                </li> 
            </ul> 
        </div> 
    </div> 
    <div class="sidebar-footer"></div> 
</aside>