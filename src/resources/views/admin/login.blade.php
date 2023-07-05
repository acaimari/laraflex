@extends('laraflex::layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Login</h5>
                </div>
                <div class="card-body">
                {!! session('error') !!}

                
                <script>
    @if ($errors->any() && $errors->has('error'))
        @foreach ($errors->get('error') as $error)
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ $error }}',
            });
        @endforeach
    @endif
</script>


                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                            <div class="col-md-8" style="max-width: 350px;">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                            <div class="col-md-3 input-group" style="max-width: 250px;">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                <button type="button" class="btn btn-outline-secondary" id="password-toggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-8 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">
                                        Recordarme
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-0 row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para revelar/ocultar la contraseña
    function togglePassword() {
        var passwordInput = document.getElementById("password");
        var passwordToggle = document.getElementById("password-toggle");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            passwordToggle.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            passwordInput.type = "password";
            passwordToggle.innerHTML = '<i class="fas fa-eye"></i>';
        }
    }

    // Evento para cambiar el tipo de entrada al hacer clic en el botón de revelar contraseña
    document.getElementById("password-toggle").addEventListener("click", togglePassword);
</script>

@endsection
