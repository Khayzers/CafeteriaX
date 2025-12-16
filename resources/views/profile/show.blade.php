@extends('layouts.app')

@section('title', 'Mi Perfil - CafeteriaX')

@section('content')
<!-- Header del Perfil -->
<section class="py-5" style="background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="text-white mb-2">
                    <i class="fas fa-user-circle text-gold me-3"></i>Mi Perfil
                </h1>
                <p class="text-white opacity-75 mb-0 lead">
                    Gestiona tu información personal y configuración de cuenta
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <span class="badge badge-gold px-4 py-2" style="font-size: 1rem;">
                    <i class="fas fa-{{ Auth::user()->isDueno() ? 'crown' : 'star' }} me-2"></i>
                    {{ Auth::user()->isDueno() ? 'Dueño' : 'Cliente' }}
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Contenido del Perfil -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Sidebar con Avatar e Info -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            @if(Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <div class="icon-circle mx-auto" style="width: 120px; height: 120px; font-size: 3rem;">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                        </div>
                        <h4 class="mb-1">{{ Auth::user()->name }}</h4>
                        <p class="text-muted mb-3">{{ Auth::user()->email }}</p>
                        <span class="badge {{ Auth::user()->isDueno() ? 'badge-gold' : 'bg-secondary' }} mb-3">
                            {{ Auth::user()->isDueno() ? 'Dueño de Cafetería' : 'Cliente' }}
                        </span>
                        <hr>
                        <div class="d-grid">
                            @if(Auth::user()->isDueno())
                                <a href="{{ route('dueno.dashboard') }}" class="btn btn-gold mb-2">
                                    <i class="fas fa-chart-line me-2"></i>Mi Dashboard
                                </a>
                            @endif
                            <button type="button" class="btn btn-outline-gold" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                <i class="fas fa-key me-2"></i>Cambiar Contraseña
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Estadísticas -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="text-uppercase text-muted mb-3">Estadísticas</h6>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span><i class="fas fa-heart text-gold me-2"></i>Favoritos</span>
                                <strong>0</strong>
                            </div>
                        </div>
                        @if(Auth::user()->isDueno())
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span><i class="fas fa-store text-gold me-2"></i>Cafeterías</span>
                                    <strong>{{ Auth::user()->cafeterias->count() }}</strong>
                                </div>
                            </div>
                        @endif
                        <div>
                            <div class="d-flex justify-content-between mb-1">
                                <span><i class="fas fa-calendar text-gold me-2"></i>Miembro desde</span>
                                <strong>{{ Auth::user()->created_at->format('M Y') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario de Edición de Perfil -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="mb-4">
                            <i class="fas fa-edit text-gold me-2"></i>Información Personal
                        </h4>

                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <!-- Nombre -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label-elegant">Nombre Completo</label>
                                    <input 
                                        type="text" 
                                        class="form-control form-control-elegant @error('name') is-invalid @enderror" 
                                        id="name" 
                                        name="name" 
                                        value="{{ old('name', Auth::user()->name) }}" 
                                        required
                                    >
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label-elegant">Correo Electrónico</label>
                                    <input 
                                        type="email" 
                                        class="form-control form-control-elegant @error('email') is-invalid @enderror" 
                                        id="email" 
                                        name="email" 
                                        value="{{ old('email', Auth::user()->email) }}" 
                                        required
                                    >
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Teléfono -->
                                <div class="col-md-6">
                                    <label for="phone" class="form-label-elegant">Teléfono</label>
                                    <input 
                                        type="tel" 
                                        class="form-control form-control-elegant @error('phone') is-invalid @enderror" 
                                        id="phone" 
                                        name="phone" 
                                        value="{{ old('phone', Auth::user()->phone) }}"
                                    >
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Rol (Solo lectura) -->
                                <div class="col-md-6">
                                    <label for="role" class="form-label-elegant">Tipo de Cuenta</label>
                                    <input 
                                        type="text" 
                                        class="form-control form-control-elegant" 
                                        value="{{ Auth::user()->isDueno() ? 'Dueño de Cafetería' : 'Cliente' }}" 
                                        readonly
                                    >
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Botones -->
                            <div class="d-flex justify-content-end gap-3">
                                <a href="{{ Auth::user()->isDueno() ? route('dueno.dashboard') : route('home') }}" class="btn btn-outline-gold px-4">
                                    <i class="fas fa-arrow-left me-2"></i>Volver
                                </a>
                                <button type="submit" class="btn btn-gold px-4">
                                    <i class="fas fa-check-circle me-2"></i>Guardar Cambios
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                @if(Auth::user()->isDueno())
                <!-- Información Adicional para Dueños -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body p-4">
                        <h5 class="mb-3">
                            <i class="fas fa-info-circle text-gold me-2"></i>Información de Dueño
                        </h5>
                        <div class="alert alert-info border-0">
                            <i class="fas fa-lightbulb me-2"></i>
                            <small>
                                Como dueño de cafetería, puedes gestionar múltiples establecimientos, 
                                administrar menús, controlar inventario y ver estadísticas desde tu dashboard.
                            </small>
                        </div>
                        <a href="{{ route('dueno.dashboard') }}" class="btn btn-outline-gold">
                            <i class="fas fa-arrow-right me-2"></i>Ir al Dashboard
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Modal Cambiar Contraseña -->
<div class="modal fade" id="changePasswordModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <i class="fas fa-key text-gold me-2"></i>Cambiar Contraseña
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('profile.password') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Contraseña Actual -->
                    <div class="mb-3">
                        <label for="current_password" class="form-label-elegant">Contraseña Actual</label>
                        <input 
                            type="password" 
                            class="form-control form-control-elegant @error('current_password') is-invalid @enderror" 
                            id="current_password" 
                            name="current_password" 
                            required
                        >
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nueva Contraseña -->
                    <div class="mb-3">
                        <label for="password" class="form-label-elegant">Nueva Contraseña</label>
                        <input 
                            type="password" 
                            class="form-control form-control-elegant @error('password') is-invalid @enderror" 
                            id="password" 
                            name="password" 
                            required
                        >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirmar Nueva Contraseña -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label-elegant">Confirmar Nueva Contraseña</label>
                        <input 
                            type="password" 
                            class="form-control form-control-elegant" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            required
                        >
                    </div>

                    <div class="alert alert-warning border-0 small">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        La contraseña debe tener al menos 8 caracteres.
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-gold">
                        <i class="fas fa-check me-2"></i>Actualizar Contraseña
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
