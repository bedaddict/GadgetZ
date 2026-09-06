@extends('layouts.app')

@section('page-header')
<div class="iq-navbar-header" style="height: 215px;">
    <div class="container-fluid iq-container">
        <div class="row">
            <div class="col-md-12">
                <div class="flex-wrap d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="text-white">Profil Pengguna</h1>
                        <p class="text-white">Kelola informasi akun pengguna aplikasi pencatatan stok.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="iq-header-img">
        <img src="{{ asset('hope-ui/assets/images/dashboard/yangini.png') }}"
            alt="header"
            class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Terjadi kesalahan:</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-4">
            <div class="card" data-aos="fade-up" data-aos-delay="400">
                <div class="card-body text-center">

                    <img src="{{ $user->photo_url ?? asset('hope-ui/assets/images/avatars/01.png') }}"
                        alt="{{ $user->name }}"
                        class="rounded-pill img-fluid mb-3" 
                        style="object-fit: cover; width: 130px; height: 130px; border: 3px solid #46136b;">

                    <h4 class="mb-1">{{ $user->name }}</h4>
                    <p class="text-muted mb-2">Administrator</p>
                    <span class="badge rounded-pill bg-success">Aktif</span>

                    <hr>

                    <div class="text-start">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Email</span>
                            <span class="fw-semibold text-end">
                                {{ $user->email }}
                            </span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Role</span>
                            <span class="fw-semibold">Admin</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Status Akun</span>
                            <span class="fw-semibold">Aktif</span>
                        </div>

                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Terdaftar</span>
                            <span class="fw-semibold">
                                {{ $user->created_at ? $user->created_at->format('d/m/Y') : '-' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card" data-aos="fade-up" data-aos-delay="500">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="header-title">
                        <h4 class="card-title mb-1">Informasi Profil</h4>
                        <p class="mb-0 text-muted">
                            Perbarui informasi akun pengguna yang sedang login.
                        </p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Ganti Foto Profil (Opsional)</label>
                                <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                                <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
                                @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Role</label>
                                <input type="text" class="form-control" value="Admin" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status Akun</label>
                                <input type="text" class="form-control" value="Aktif" readonly>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <button type="reset" class="btn btn-soft-secondary">Reset</button>
                            <button type="submit" class="btn text-white" style="background-color: #46136b; border-color: #46136b;">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    var input = document.querySelector('input[name="photo"]');
    if (!input || !window.HTMLCanvasElement) return;

    var MAX_DIMENSION = 512;
    var QUALITY = 0.75;

    input.addEventListener('change', function () {
        var file = input.files[0];
        if (!file || !file.type.startsWith('image/')) return;

        var reader = new FileReader();
        reader.onload = function (e) {
            var img = new Image();
            img.onload = function () {
                var ratio = Math.min(1, MAX_DIMENSION / Math.max(img.width, img.height));
                var canvas = document.createElement('canvas');
                canvas.width = Math.round(img.width * ratio);
                canvas.height = Math.round(img.height * ratio);

                var ctx = canvas.getContext('2d');
                ctx.fillStyle = '#fff';
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                canvas.toBlob(function (blob) {
                    if (!blob) return;
                    var compressed = new File([blob], 'photo.jpg', { type: 'image/jpeg' });
                    var transfer = new DataTransfer();
                    transfer.items.add(compressed);
                    input.files = transfer.files;
                }, 'image/jpeg', QUALITY);
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    });
})();
</script>
@endsection