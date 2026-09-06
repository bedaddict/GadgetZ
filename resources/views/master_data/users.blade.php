@extends('layouts.app') 
@section('page-header') 
<div class="iq-navbar-header" style="height: 215px;"> 
    <div class="container-fluid iq-container"> 
        <div class="row"> 
            <div class="col-md-12"> 
  <div class="flex-wrap d-flex justify-content-between align-items-center"> 
                    <div> 
                        <h1>Manajemen Pengguna</h1> 
                        <p>Kelola akun pengguna yang dapat mengakses sistem pencatatan stok barang.</p> 
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
    <div class="row"> 
        <div class="col-sm-12"> 
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
 
            <div class="card"> 
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3"> 
                    <div class="header-title"> 
                        <h4 class="card-title mb-1">Master Data Pengguna</h4> 
                        <p class="mb-0 text-secondary"> 
                            Kelola akun pengguna untuk login dan mengakses aplikasi. 
                        </p> 
                    </div> 
                   <button type="button" class="btn btn-sm btn-create-user text-white" style="background-color: #46136b; border-color: #46136b;"> 
    Tambah Pengguna 
</button>
                </div> 
 
                <div class="card-body"> 
                    <div class="table-responsive"> 
                        <table id="datatable" class="table table-striped table-hover word-wrap" data
toggle="data-table"> 
                            <thead> 
                                <tr> 
                                    <th width="5%">No</th> 
                                    <th>Nama Pengguna</th> 
                                    <th>Email</th> 
                                    <th>Tanggal Dibuat</th> 
                                    <th width="15%" class="text-center">Aksi</th> 
                                </tr> 
                            </thead> 
                            <tbody> 
                                @forelse ($users as $user) 
                                <tr> 
                                    <td>{{ $loop->iteration }}</td> 
                                    <td> 
                                        <strong>{{ $user->name }}</strong> 
                                          @if (auth()->id() === $user->id) 
                                        <br> 
                                        <span class="badge bg-success mt-1">Akun Aktif</span> 
                                        @endif 
                                    </td> 
                                    <td>{{ $user->email }}</td> 
                                    <td> 
                                        {{ $user->created_at ? $user->created_at->format('d-m-Y H:i') : '-' 
}} 
                                    </td> 
                                    <td class="text-center"> 
                                        <div class="d-flex justify-content-center gap-1 flex-nowrap"> 
 
                                            <button type="button" 
                                                class="btn btn-info btn-sm btn-detail-user" 
                                                data-id="{{ $user->id }}" 
                                                data-name="{{ e($user->name) }}" 
                                                data-email="{{ e($user->email) }}" 
                                                data-created-at="{{ $user->created_at ? $user->created_at
>format('d-m-Y H:i') : '-' }}" 
                                                data-updated-at="{{ $user->updated_at ? $user->updated_at
>format('d-m-Y H:i') : '-' }}"> 
                                                Detail 
                                            </button> 
 
                                            <button type="button" 
                                                class="btn btn-warning btn-sm btn-edit-user" 
                                                data-id="{{ $user->id }}" 
                                                data-name="{{ e($user->name) }}" 
                                                data-email="{{ e($user->email) }}"> 
                                                Edit 
                                            </button> 
                                            <form action="{{ route('master-data.manajemen-pengguna.destroy', 
$user->id) }}" 
                                                method="POST" 
                                                onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')"> 
                                                @csrf 
                                                @method('DELETE') 
 
                                                <button type="submit" class="btn btn-danger btn-sm"> 
                                                    Hapus 
                                                </button> 
                                            </form> 
                                        </div> 
                                    </td> 
                                </tr> 
                                @empty 
                                <tr> 
                                    <td colspan="5" class="text-center text-muted"> 
                                        Belum ada data pengguna. 
                                    </td> 
                                </tr> 
                                @endforelse 
                            </tbody> 
                        </table> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
</div> 
 
{{-- Modal Create / Update --}} 
<div class="modal fade" id="modalUser" tabindex="-1" aria-labelledby="modalUserLabel" aria-hidden="true"> 
    <div class="modal-dialog modal-lg modal-dialog-centered"> 
        <div class="modal-content"> 
            <form id="formUser" method="POST"> 
                @csrf 
                <input type="hidden" name="_method" id="formMethod" value="" disabled> 
 
                <div class="modal-header"> 
                    <h5 class="modal-title" id="modalUserLabel"> 
                        Form Pengguna 
                    </h5> 
                    <button type="button" 
                        class="btn-close" 
                        data-bs-dismiss="modal" 
  aria-label="Close"></button> 
                </div> 
 
                <div class="modal-body"> 
                    <div id="detailUserInfo" class="alert alert-info d-none mb-4"> 
                        <div class="row g-3"> 
                            <div class="col-md-6"> 
                                <small class="text-muted d-block">Tanggal Dibuat</small> 
                                <strong id="detailCreatedAt">-</strong> 
                            </div> 
                            <div class="col-md-6"> 
                                <small class="text-muted d-block">Terakhir Diupdate</small> 
                                <strong id="detailUpdatedAt">-</strong> 
                            </div> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-12 mb-3"> 
                            <label class="form-label"> 
                                Nama Pengguna <span class="text-danger">*</span> 
                            </label> 
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nama 
Pengguna" required> 
                        </div> 
                        <div class="col-md-12 mb-3"> 
                            <label class="form-label"> 
                                Email <span class="text-danger">*</span> 
                            </label> 
                            <input type="email" name="email" id="email" class="form-control" 
placeholder="email" required> 
                        </div> 
                        <div class="col-md-6 mb-3"> 
                            <label class="form-label"> 
                                Password <span class="text-danger password-required">*</span> 
                            </label> 
                            <input type="password" name="password" id="password" class="form-control" 
placeholder="Minimal 6 karakter"> 
                            <small class="text-muted password-help d-none"> 
                                Kosongkan jika tidak ingin mengubah password. 
                            </small> 
                        </div> 
 
                        <div class="col-md-6 mb-3"> 
                            <label class="form-label"> 
                                Konfirmasi Password <span class="text-danger password-required">*</span> 
                            </label> 
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                class="form-control" placeholder="Ulangi password"> 
                        </div> 
 
                    </div> 
                </div> 
 
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> 
                        Batal 
                    </button> 
                    <button type="submit" class="btn text-white" id="btnSubmitUser" style="background-color: #46136b; border-color: #46136b;">
    Simpan Pengguna
</button>
                </div> 
            </form> 
        </div> 
    </div> 
</div> 
 
@push('scripts') 
<script> 
    $(document).ready(function() { 
        const storeUrl = "{{ route('master-data.manajemen-pengguna.store') }}"; 
        const updateUrlTemplate = "{{ route('master-data.manajemen-pengguna.update', ':id') }}"; 
        const $modal = $('#modalUser'); 
        const $form = $('#formUser'); 
        const $method = $('#formMethod'); 
        const $title = $('#modalUserLabel'); 
        const $btnSubmit = $('#btnSubmitUser'); 
        const $name = $('#name'); 
        const $email = $('#email');

          const $password = $('#password'); 
        const $passwordConfirmation = $('#password_confirmation'); 
        const $passwordWrapper = $('.password-wrapper'); 
        const $detailInfo = $('#detailUserInfo'); 
        const $detailUserId = $('#detailUserId'); 
        const $detailCreatedAt = $('#detailCreatedAt'); 
        const $detailUpdatedAt = $('#detailUpdatedAt'); 
 
        function resetModalUser() { 
            $form[0].reset(); 
            $form.attr('action', storeUrl); 
            $method.prop('disabled', true).val(''); 
            $name.prop('readonly', false).val(''); 
            $email.prop('readonly', false).val(''); 
            $password.prop('readonly', false).val(''); 
            $passwordConfirmation.prop('readonly', false).val(''); 
            $passwordWrapper.removeClass('d-none'); 
            $password.prop('required', true); 
            $passwordConfirmation.prop('required', true); 
            $detailInfo.addClass('d-none'); 
            $detailUserId.text('-'); 
            $detailCreatedAt.text('-'); 
            $detailUpdatedAt.text('-'); 
            $title.text('Form Pengguna'); 
            $btnSubmit.removeClass('d-none').text('Simpan Pengguna'); 
        } 
 
        $('.btn-create-user').on('click', function() { 
            resetModalUser(); 
            $title.text('Tambah Pengguna'); 
            $btnSubmit.text('Simpan Pengguna'); 
            $modal.modal('show'); 
        }); 
 
        $(document).on('click', '.btn-edit-user', function() { 
            resetModalUser(); 
            const id = $(this).data('id'); 
            const updateUrl = updateUrlTemplate.replace(':id', id); 
            $form.attr('action', updateUrl); 
            $method.prop('disabled', false).val('PUT'); 
            $name.val($(this).data('name')); 
            $email.val($(this).data('email')); 
 
            // Pada edit, password boleh kosong 
            $password.prop('required', false); 
            $passwordConfirmation.prop('required', false); 
            $password.attr('placeholder', 'Kosongkan jika tidak ingin mengubah password'); 
            $passwordConfirmation.attr('placeholder', 'Kosongkan jika tidak ingin mengubah password'); 
            $title.text('Edit Pengguna'); 
            $btnSubmit.text('Simpan Perubahan'); 
 
            $modal.modal('show'); 
        }); 
 
        $(document).on('click', '.btn-detail-user', function() { 
            resetModalUser(); 
            const id = $(this).data('id'); 
            const name = $(this).data('name'); 
            const email = $(this).data('email'); 
            const createdAt = $(this).data('created-at'); 
            const updatedAt = $(this).data('updated-at'); 
            $name.val(name); 
            $email.val(email); 
            $name.prop('readonly', true); 
            $email.prop('readonly', true); 
 
            // Password tidak perlu ditampilkan pada detail 
            $passwordWrapper.addClass('d-none'); 
            $password.prop('required', false); 
            $passwordConfirmation.prop('required', false); 
            $detailUserId.text(id); 
            $detailCreatedAt.text(createdAt); 
            $detailUpdatedAt.text(updatedAt); 
            $detailInfo.removeClass('d-none'); 
            $title.text('Detail Pengguna'); 
 
            // Mode detail hanya lihat data 
            $btnSubmit.addClass('d-none');
             $modal.modal('show'); 
        }); 
 
        $modal.on('hidden.bs.modal', function() { 
            resetModalUser(); 
        }); 
    }); 
</script> 
@endpush 
@endsection