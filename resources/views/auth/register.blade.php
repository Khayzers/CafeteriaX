@extends('layouts.app')

@section('title', 'Registrarse - CafeteriaX')

@section('content')
<section class="py-5 bg-gray-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <div class="icon-circle mx-auto mb-3">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <h2 class="mb-2">Crear Cuenta</h2>
                            <p class="text-muted">Únete a CafeteriaX y descubre las mejores cafeterías</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Nombre -->
                            <div class="mb-3">
                                <label for="name" class="form-label-elegant">Nombre Completo</label>
                                <input 
                                    type="text" 
                                    class="form-control form-control-elegant @error('name') is-invalid @enderror" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name') }}" 
                                    required 
                                    autofocus
                                    placeholder="Ej: Juan Pérez"
                                >
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label-elegant">Correo Electrónico</label>
                                <input 
                                    type="email" 
                                    class="form-control form-control-elegant @error('email') is-invalid @enderror" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required
                                    placeholder="tu@email.com"
                                >
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Teléfono (Opcional) -->
                            <div class="mb-3">
                                <label for="phone" class="form-label-elegant">Teléfono <span class="text-muted">(Opcional)</span></label>
                                <input 
                                    type="tel" 
                                    class="form-control form-control-elegant @error('phone') is-invalid @enderror" 
                                    id="phone" 
                                    name="phone" 
                                    value="{{ old('phone') }}"
                                    placeholder="+34 600 000 000"
                                >
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Contraseña -->
                            <div class="mb-3">
                                <label for="password" class="form-label-elegant">Contraseña</label>
                                <input 
                                    type="password" 
                                    class="form-control form-control-elegant @error('password') is-invalid @enderror" 
                                    id="password" 
                                    name="password" 
                                    required
                                    placeholder="Mínimo 8 caracteres"
                                >
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirmar Contraseña -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label-elegant">Confirmar Contraseña</label>
                                <input 
                                    type="password" 
                                    class="form-control form-control-elegant" 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    required
                                    placeholder="Repite tu contraseña"
                                >
                            </div>

                            <!-- Info sobre rol -->
                            <div class="alert alert-info border-0 mb-4">
                                <i class="fas fa-info-circle me-2"></i>
                                <small>Te registrarás como <strong>Cliente</strong>. Si tienes una cafetería y deseas registrarla, <a href="mailto:contacto@cafeteriax.com" class="text-decoration-underline">contáctanos</a>.</small>
                            </div>

                            <!-- Botón Registro -->
                            <button type="submit" class="btn btn-gold w-100 py-3 mb-3">
                                <i class="fas fa-user-plus me-2"></i>Crear Cuenta
                            </button>

                            <!-- Link a Login -->
                            <div class="text-center">
                                <p class="mb-0 text-muted">
                                    ¿Ya tienes cuenta? 
                                    <a href="{{ route('login') }}" class="text-gold text-decoration-none fw-semibold">Inicia Sesión</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Beneficios de Registro -->
                <div class="row g-3 mt-4">
                    <div class="col-4">
                        <div class="text-center">
                            <i class="fas fa-heart fa-2x text-gold mb-2"></i>
                            <p class="small mb-0">Guarda favoritos</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="text-center">
                            <i class="fas fa-star fa-2x text-gold mb-2"></i>
                            <p class="small mb-0">Recomendaciones</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="text-center">
                            <i class="fas fa-bell fa-2x text-gold mb-2"></i>
                            <p class="small mb-0">Notificaciones</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
