<nav class="nav navbar navbar-expand-lg navbar-light iq-navbar"> 
    <div class="container-fluid navbar-inner"> 
        <a href="{{ route('dashboard') }}" class="navbar-brand"> 
            <img src="{{ asset('logo.png') }}" alt="Logo" style="width: 35px; height: auto;" class="me-2">
            
            <h4 class="logo-title">GadgetZ</h4> 
        </a>
 
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true"> 
            <i class="icon"> 
                <svg width="20px" class="icon-20" viewBox="0 0 24 24"> 
                    <path fill="currentColor" 
d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" /> 
                </svg> 
            </i> 
        </div> 
 
        <div class="input-group search-input"> 
            <span class="input-group-text"> 
                <svg class="icon-18" width="18" viewBox="0 0 24 24" fill="none"> 
                    <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor" stroke
width="1.5"></circle> 
                    <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5"></path> 
                </svg> 
            </span> 
            <input type="search" class="form-control" placeholder="Cari barang, kategori, atau laporan..."> 
        </div> 
 
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-
target="#navbarSupportedContent"> 
            <span class="navbar-toggler-icon"> 
                <span class="mt-2 navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span> 
                <span class="navbar-toggler-bar bar3"></span> 
            </span> 
        </button> 
 
        <div class="collapse navbar-collapse" id="navbarSupportedContent"> 
            <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0"> 
                <li class="nav-item dropdown"> 
                    <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown" 
role="button" data-bs-toggle="dropdown"> 
                        <img src="{{ auth()->user()->photo ? asset('storage/profile_photos/' . auth()->user()->photo) : asset('hope-ui/assets/images/avatars/01.png') }}" 
    alt="User-Profile" 
    class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded"
    style="object-fit: cover;">
                        <div class="caption ms-3 d-none d-md-block"> 
                            <h6 class="mb-0 caption-title">{{ auth()->user()->name ?? 'Admin Stok' }}</h6> 
                            <p class="mb-0 caption-sub-title">Administrator</p> 
                        </div> 
                    </a> 
 
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"> 
                        <li> 
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a> 
                        </li> 
                        <li> 
                            <a class="dropdown-item" href="{{ route('profile.password') }}">Ubah Password</a> 
                        </li> 
                        <li> 
                            <hr class="dropdown-divider"> 
                        </li> 
                        <li> 
                            <form action="{{ route('logout') }}" method="POST" class="mb-0"> 
                                @csrf 
                                <button type="submit" class="dropdown-item"> 
                                    Logout 
                                </button> 
                            </form> 
                        </li> 
                    </ul> 
                </li> 
            </ul> 
        </div> 
    </div> 
</nav> 