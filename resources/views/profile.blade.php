@extends('template/main')

@section('title', 'Profile')

@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Profile</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="#">admin</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
        </div>

        <!-- Profile Card -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="silva-main-sections d-flex align-items-center">
                            <div class="silva-profile-main position-relative">
                                <img src="{{ Auth::user()->foto ? asset('foto_user/' . Auth::user()->foto) : asset('assets/images/user.png') }}"
                                    id="imagePreview" class="rounded-circle img-fluid avatar-xxl img-thumbnail"
                                    alt="image profile" style="cursor: pointer;">
                                <input type="file" name="foto" id="foto" style="display: none;">
                                <span class="sil-profile_main-pic-change img-thumbnail position-absolute bottom-0 start-0">
                                    <i class="mdi mdi-camera text-white"></i>
                                </span>
                            </div>
                            <div class="overflow-hidden ms-md-4 ms-0">
                                <h4 class="m-0 text-dark fs-20 mt-2 mt-md-0">{{ Auth::user()->first_name }}</h4>
                                <span class="fs-15"><i
                                        class="mdi mdi-email me-2 align-middle"></i>{{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body pt-0">
                        <ul class="nav nav-underline border-bottom pt-2" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link p-2 active" id="setting_tab" data-bs-toggle="tab" href="#profile_setting"
                                    role="tab">Ubah Profile</a>
                            </li>
                        </ul>

                        <div class="tab-content text-muted bg-white">
                            <div class="tab-pane pt-4 active" id="profile_setting" role="tabpanel">
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
                                <form method="POST" action="{{ url('/profile/_edit_profile') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="first_name" class="form-label">Nama Depan</label>
                                            <input type="text"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                name="first_name" id="first_name"
                                                value="{{ old('first_name', Auth::user()->first_name) }}" required>
                                            @error('first_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="last_name" class="form-label">Nama Belakang</label>
                                            <input type="text"
                                                class="form-control @error('last_name') is-invalid @enderror"
                                                name="last_name" id="last_name"
                                                value="{{ old('last_name', Auth::user()->last_name) }}" required>
                                            @error('last_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-12">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" id="email"
                                                value="{{ old('email', Auth::user()->email) }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="birth_date" class="form-label">Tanggal Lahir</label>
                                            <input type="date"
                                                class="form-control @error('birth_date') is-invalid @enderror"
                                                name="birth_date" id="birth_date"
                                                value="{{ old('birth_date', Auth::user()->birth_date) }}" required>
                                            @error('birth_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="gender" class="form-label">Jenis Kelamin</label>
                                            <select class="form-control @error('gender') is-invalid @enderror"
                                                name="gender" id="gender" required>
                                                <option value="">Pilih</option>
                                                <option value="L"
                                                    {{ old('gender', Auth::user()->gender) == 'L' ? 'selected' : '' }}>
                                                    Laki-laki</option>
                                                <option value="P"
                                                    {{ old('gender', Auth::user()->gender) == 'P' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="password" class="form-label">Password Baru (Opsional)</label>
                                            <div class="input-group">
                                                <input class="form-control" type="password" id="password"
                                                    name="password" placeholder="Masukkan Password Baru">
                                                <span class="input-group-text" id="togglePasswordIcon1">
                                                    <i id="icon-pass1" class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                            @error('password')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="password_confirmation" class="form-label">Konfirmasi
                                                Password</label>
                                            <div class="input-group">
                                                <input class="form-control" type="password" id="password_confirmation"
                                                    name="password_confirmation" placeholder="Konfirmasi Password">
                                                <span class="input-group-text" id="togglePasswordIcon2">
                                                    <i id="icon-pass2" class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $("#togglePasswordIcon1").on("click", function() {
            let passwordInput = $("#password");
            let icon = $("#icon-pass1");

            if (passwordInput.attr("type") === "password") {
                passwordInput.attr("type", "text");
                icon.removeClass("fas fa-eye").addClass(
                    "fas fa-eye-slash");
            } else {
                passwordInput.attr("type", "password");
                icon.removeClass("fas fa-eye-slash").addClass(
                    "fas fa-eye");
            }
        });

        $("#togglePasswordIcon2").on("click", function() {
            let passwordInput = $("#password_confirmation");
            let icon = $("#icon-pass2");

            if (passwordInput.attr("type") === "password") {
                passwordInput.attr("type", "text");
                icon.removeClass("fas fa-eye").addClass(
                    "fas fa-eye-slash");
            } else {
                passwordInput.attr("type", "password");
                icon.removeClass("fas fa-eye-slash").addClass(
                    "fas fa-eye");
            }
        });
    </script>
@endpush
