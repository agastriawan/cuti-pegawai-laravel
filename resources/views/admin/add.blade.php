@extends('template/main')

@section('title', 'Add - Admin')

@push('styles')
@endpush

@section('content')
    <div class="container-fluid">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Tambah</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                    <li class="breadcrumb-item active">Tambah Admin</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h5 class="card-title mb-0">Admin</h5>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ url('/admin/_tambah_admin') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="first_name" class="form-label">Nama Depan</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                        name="first_name" id="first_name" value="{{ old('first_name') }}" required>
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="last_name" class="form-label">Nama Belakang</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                        name="last_name" id="last_name" value="{{ old('last_name') }}" required>
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="birth_date" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                                        name="birth_date" id="birth_date" value="{{ old('birth_date') }}" required>
                                    @error('birth_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="gender" class="form-label">Jenis Kelamin</label>
                                    <select class="form-control @error('gender') is-invalid @enderror" name="gender"
                                        id="gender" required>
                                        <option value="">Pilih</option>
                                        <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki
                                        </option>
                                        <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input class="form-control" type="password" id="password" name="password"
                                            placeholder="Masukkan Password">
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
                            </div>

                            <div class="text-end">
                                <a href="{{ url('admin') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        flatpickr("#tanggal_lahir", {
            dateFormat: "d-m-Y",
        });

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
