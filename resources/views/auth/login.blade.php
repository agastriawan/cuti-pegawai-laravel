@extends('auth/template_auth/main')

@section('title', 'Login - Cuti Karyawan')

@push('styles')
@endpush

@section('content')
    <div class="account-page">
        <div class="container-fluid p-0">
            <div class="row align-items-center g-0">
                <div class="row">
                    <div class="d-flex align-items-center justify-content-center min-vh-100 bg-light">
                        <div class="card shadow-sm p-4" style="max-width: 420px; width: 100%;">
                            <div class="card-body">
                                <h3 class="text-center mb-4 fw-semibold text-dark">Selamat Datang</h3>

                                @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                                  <form id="loginForm" method="POST" action="{{ url('_login') }}" class="mb-3">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input class="form-control" type="email" name="email" id="email" required
                                            placeholder="Masukkan Email">
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input class="form-control" type="password" id="password" name="password"
                                                placeholder="Masukkan Password">
                                            <span class="input-group-text cursor-pointer" id="togglePasswordIcon1">
                                                <i id="icon-pass1" class="fas fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="d-grid mb-3">
                                        <button class="btn btn-primary" id="submit" type="submit">
                                            <div id="loader" class="loader" style="display:none;"></div>
                                            <span id="btn-login">Log In</span>
                                        </button>
                                    </div>
                                </form>

                                <p class="text-center text-muted mb-0">
                                    Belum Punya Akun?
                                    <a href="{{ url('/register') }}" class="text-primary fw-medium">Register</a>
                                </p>
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
    document.getElementById("togglePasswordIcon1").addEventListener("click", function () {
        const passwordInput = document.getElementById("password");
        const icon = document.getElementById("icon-pass1");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    });
</script>
@endpush
