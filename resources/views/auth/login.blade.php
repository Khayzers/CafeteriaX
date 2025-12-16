@extends('layouts.app')

@section('title', 'Iniciar Sesión - CafeteriaX')

@section('content')
<section class="py-5 bg-gray-light">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
            <div class="col-lg-10">
                <div class="row g-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
                    <!-- Lado izquierdo - Imagen/Info -->
                    <div class="col-lg-6 bg-dark text-white p-5 d-flex flex-column justify-content-center" style="background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);">
                        <div class="mb-4">
                            <h1 class="display-4 fw-bold mb-3">
                                Bienvenido a <span class="text-gold">CafeteriaX</span>
                            </h1>
                            <p class="lead mb-4">
                                Descubre, explora y disfruta de las mejores cafeterías en un solo lugar.
                            </p>
                        </div>
                        
                        <div class="mb-4">
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-check-circle text-gold fa-2x me-3"></i>
                                <div>
                                    <h5 class="mb-1 text-white">Explora Cafeterías</h5>
                                    <p class="mb-0 text-white opacity-75">Encuentra los mejores lugares cerca de ti</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-heart text-gold fa-2x me-3"></i>
                                <div>
                                    <h5 class="mb-1 text-white">Guarda Favoritos</h5>
                                    <p class="mb-0 text-white opacity-75">Marca tus cafeterías y productos preferidos</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <i class="fas fa-crown text-gold fa-2x me-3"></i>
                                <div>
                                    <h5 class="mb-1 text-white">Experiencia Premium</h5>
                                    <p class="mb-0 text-white opacity-75">Interfaz elegante y fácil de usar</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-auto pt-4 border-top border-secondary">
                            <p class="mb-0 small opacity-75">
                                <i class="fas fa-lock me-2"></i>
                                Tus datos están seguros y protegidos
                            </p>
                        </div>
                    </div>

                    <!-- Lado derecho - Formulario -->
                    <div class="col-lg-6 bg-white p-5">
                        <div class="text-center mb-4">
                            <div class="icon-circle mx-auto mb-3">
                                <i class="fas fa-sign-in-alt"></i>
                            </div>
                            <h2 class="mb-2">Iniciar Sesión</h2>
                            <p class="text-muted">Ingresa tus credenciales para continuar</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label-elegant">Correo Electrónico</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-envelope text-gold"></i>
                                    </span>
                                    <input 
                                        type="email" 
                                        class="form-control form-control-elegant border-start-0 @error('email') is-invalid @enderror" 
                                        id="email" 
                                        name="email" 
                                        value="{{ old('email') }}" 
                                        required 
                                        autofocus
                                        placeholder="tu@email.com"
                                    >
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Contraseña -->
                            <div class="mb-3">
                                <label for="password" class="form-label-elegant">Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-lock text-gold"></i>
                                    </span>
                                    <input 
                                        type="password" 
                                        class="form-control form-control-elegant border-start-0 @error('password') is-invalid @enderror" 
                                        id="password" 
                                        name="password" 
                                        required
                                        placeholder="Tu contraseña"
                                    >
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input 
                                        type="checkbox" 
                                        class="form-check-input" 
                                        id="remember" 
                                        name="remember"
                                    >
                                    <label class="form-check-label" for="remember">
                                        Recordarme
                                    </label>
                                </div>
                                <a href="#" class="text-gold text-decoration-none small">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            </div>

                            <!-- Botón Login -->
                            <button type="submit" class="btn btn-gold w-100 py-3 mb-3">
                                <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                            </button>

                            <!-- Divider -->
                            <div class="text-center my-3">
                                <span class="text-muted">o</span>
                            </div>

                            <!-- Link a Register -->
                            <div class="text-center">
                                <p class="mb-0 text-muted">
                                    ¿No tienes cuenta? 
                                    <a href="{{ route('register') }}" class="text-gold text-decoration-none fw-semibold">Regístrate gratis</a>
                                </p>
                            </div>
                        </form>

                        <!-- Info adicional -->
                        <div class="mt-4 pt-4 border-top">
                            <p class="text-center text-muted small mb-0">
                                <i class="fas fa-shield-alt text-gold me-2"></i>
                                Conexión segura con encriptación SSL
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
