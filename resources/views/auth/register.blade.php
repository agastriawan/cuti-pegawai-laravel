@extends('auth/template_auth/main')

@section('title', 'Login - Pantau Tumbuh')

@push('styles')
@endpush

@section('content')
    <div class="account-page">
        <div class="container-fluid p-0">
            <div class="row align-items-center g-0">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="d-flex align-items-center justify-content-center min-vh-100">
                            <div class="card shadow-sm p-4" style="max-width: 720px; width: 100%;">
                                <div class="card-body">
                                    <h3 class="text-center mb-4 fw-semibold text-dark">Daftar Akun</h3>

                                    <form id="registerForm" method="POST" action="{{ route('register') }}" class="mb-3">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="first_name" class="form-label">Nama Depan</label>
                                                <input class="form-control" type="text" id="first_name" name="first_name"
                                                    value="{{ old('first_name') }}" placeholder="Masukkan Nama Depan">
                                                @error('first_name')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="last_name" class="form-label">Nama Belakang</label>
                                                <input class="form-control" type="text" id="last_name" name="last_name"
                                                    value="{{ old('last_name') }}" placeholder="Masukkan Nama Belakang">
                                                @error('last_name')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="birth_date" class="form-label">Tanggal Lahir</label>
                                                <input class="form-control" type="date" id="birth_date" name="birth_date"
                                                    value="{{ old('birth_date') }}">
                                                @error('birth_date')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Jenis Kelamin</label>
                                                <select name="gender" class="form-control" id="gender">
                                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                                    <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>
                                                        Laki-laki</option>
                                                    <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>
                                                        Perempuan</option>
                                                </select>
                                                @error('gender')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input class="form-control" type="email" id="email" name="email"
                                                    value="{{ old('email') }}" placeholder="Masukkan Email">
                                                @error('email')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group">
                                                    <input class="form-control" type="password" id="password"
                                                        name="password" placeholder="Masukkan Password">
                                                    <span class="input-group-text cursor-pointer" id="togglePasswordIcon1">
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
                                                    <span class="input-group-text cursor-pointer" id="togglePasswordIcon2">
                                                        <i id="icon-pass2" class="fas fa-eye"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <div class="d-grid">
                                                    <button class="btn btn-primary" type="submit" id="submit">
                                                        <div id="loader" class="loader" style="display:none;"></div>
                                                        <span id="btn-daftar">Daftar</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <p class="text-center text-muted mb-0">
                                        Sudah Punya Akun? <a href="{{ url('/auth/login') }}"
                                            class="text-primary fw-medium">Login</a>
                                    </p>
                                </div>
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
        $(document).ready(function() {
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
        });
    </script>
@endpush
