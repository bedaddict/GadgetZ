<!doctype html> 
<html lang="en" dir="ltr"> 
<head> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>@yield('title', 'Pencatatan Stok Barang')</title> 
    <!-- Favicon --> 
    <link rel="shortcut icon" href="{{ asset('hope-ui/assets/images/favicon.png') }}" /> 
    <!-- Library / Plugin Css Build --> 
    <link rel="stylesheet" href="{{ asset('hope-ui/assets/css/core/libs.min.css') }}" /> 
    <!-- Aos Animation Css --> 
    <link rel="stylesheet" href="{{ asset('hope-ui/assets/vendor/aos/dist/aos.css') }}" /> 
    <!-- Hope Ui Design System Css --> 
    <link rel="stylesheet" href="{{ asset('hope-ui/assets/css/hope-ui.min.css?v=2.0.0') }}" /> 
    <!-- Custom Css --> 
    <link rel="stylesheet" href="{{ asset('hope-ui/assets/css/custom.min.css?v=2.0.0') }}" /> 
    <!-- Dark Css --> 
    <link rel="stylesheet" href="{{ asset('hope-ui/assets/css/dark.min.css') }}" /> 
    <!-- Customizer Css --> 
    <link rel="stylesheet" href="{{ asset('hope-ui/assets/css/customizer.min.css') }}" /> 
    <!-- RTL Css --> 
    <link rel="stylesheet" href="{{ asset('hope-ui/assets/css/rtl.min.css') }}" /> 
    @stack('styles') 
</head> 
 
<body class=" "> 
    <!-- loader Start --> 
 <div id="loading"> 
        <div class="loader simple-loader"> 
            <div class="loader-body"></div> 
        </div> 
    </div> 
    <!-- loader END --> 
    @include('partials.sidebar') 
    <main class="main-content"> 
        <div class="position-relative iq-banner"> 
            @include('partials.navbar') 
            @yield('page-header') 
        </div> 
        @yield('content') 
        @include('partials.footer') 
    </main> 
    @include('partials.scripts') 
    
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->

    @stack('scripts') 
    @stack('modals')
</body> 
</html>