<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login | Pencatatan Stok Barang</title>
    <link rel="shortcut icon" href="{{ asset('hope-ui/assets/images/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('hope-ui/assets/css/core/libs.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('hope-ui/assets/css/hope-ui.min.css?v=2.0.0') }}" />
    <link rel="stylesheet" href="{{ asset('hope-ui/assets/css/custom.min.css?v=2.0.0') }}" />
    <link rel="stylesheet" href="{{ asset('hope-ui/assets/css/dark.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('hope-ui/assets/css/customizer.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('hope-ui/assets/css/rtl.min.css') }}" />
</head>
<body class=" " data-bs-spy=" scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>
    <div class="wrapper">
        <section class="login-content">
            <div class="row m-0 align-items-center bg-white vh-100">
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                                <div class="card-body">
                                    
                                    <a class="navbar-brand d-flex align-items-center justify-content-center mb-3 w-100">
                                        <img src="{{ asset('logo.png') }}" alt="Logo" style="width: 45px; height: auto;" class="me-2">
                                        
                                        <h4 class="logo-title mb-0">Toko Aksesories Gadget</h4>
                                    </a>
                                    
                                    <h2 class="mb-2 text-center">Login Admin</h2>
                                    <p class="text-center">Masuk untuk mengelola pencatatan stok barang Toko Aksesories Gadget.</p>

                                    @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                    @endif

                                    @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                    @endif

                                    @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Terjadi kesalahan:</strong>
                                        <ul class="mb-0 mt-2">
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                    @endif

                                    <form action="{{ route('login.process') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" aria-describedby="email" placeholder="Masukkan email admin" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="password" class="form-label">Password</label> 
                                                    <input type="password" name="password" class="form-control" aria-describedby="password" placeholder="Masukkan password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn px-5 text-white" style="background-color: #46136b; border-color: #2f0d48;">Login</button>
                                        </div>
                                        <p class="mt-4 text-center text-muted mb-0">
                                            Sistem Pencatatan Keluar Masuk Barang
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="sign-bg">
                        <svg width="280" height="230" viewBox="0 0 431 398" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.05">
                                <rect x="-157.085" y="193.773" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 -157.085 193.773)" fill="#3B8AFF" />
                                <rect x="7.46875" y="358.327" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 7.46875 358.327)" fill="#3B8AFF" />
                                <rect x="61.9355" y="138.545" width="310.286" height="77.5714" rx="38.7857" transform="rotate(45 61.9355 138.545)" fill="#3B8AFF" />
                                <rect x="62.3154" y="-190.173" width="543" height="77.5714" rx="38.7857" transform="rotate(45 62.3154 -190.173)" fill="#3B8AFF" />
                            </g>
                        </svg>
                    </div>
                </div>
                
                <div class="col-md-6 d-md-block d-none p-0 mt-n1 vh-100 overflow-hidden" style="background-color: #46136b;">
                    
                    <img src="{{ asset('hope-ui/assets/images/auth/01.png')}}" class="img-fluid gradientmain animated-scaleX" alt="Banner Toko">
                    
                </div>
            </div>
        </section>
    </div>
    
    <script src="{{ asset('hope-ui/assets/js/core/libs.min.js')}}"></script>
    <script src="{{ asset('hope-ui/assets/js/core/external.min.js')}}"></script>
    <script src="{{ asset('hope-ui/assets/js/charts/widgetcharts.js')}}"></script>
    <script src="{{ asset('hope-ui/assets/js/charts/vectore-chart.js')}}"></script>
    <script src="{{ asset('hope-ui/assets/js/charts/dashboard.js')}}"></script>
    <script src="{{ asset('hope-ui/assets/js/plugins/fslightbox.js')}}"></script>
    <script src="{{ asset('hope-ui/assets/js/plugins/setting.js')}}"></script>
    <script src="{{ asset('hope-ui/assets/js/plugins/slider-tabs.js')}}"></script>
    <script src="{{ asset('hope-ui/assets/js/plugins/form-wizard.js')}}"></script>
    <script src="{{ asset('hope-ui/assets/js/hope-ui.js')}}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>