<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CafeteriaX - Descubre las mejores cafeterías')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Croppie CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
    
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-coffee text-gold"></i> Cafeteria<span>X</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cafeterias.index') }}">Cafeterías</a>
                    </li>
                    
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="#favoritos">Favoritos</a>
                        </li>
                        
                        @if(Auth::user()->isDueno())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dueno.dashboard') }}">Mi Dashboard</a>
                            </li>
                        @endif
                        
                        <li class="nav-item dropdown ms-3">
                            <a class="nav-link" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle text-gold me-2"></i>
                                <span class="text-gold">¡Bienvenido, {{ Auth::user()->name }}!</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="fas fa-user me-2"></i>Mi Perfil</a></li>
                                @if(Auth::user()->isDueno())
                                    <li><a class="dropdown-item" href="{{ route('dueno.dashboard') }}"><i class="fas fa-chart-line me-2"></i>Dashboard</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item ms-3">
                            <a href="{{ route('login') }}" class="btn btn-gold">
                                <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                            </a>
                        </li>
                        <li class="nav-item ms-2">
                            <a href="{{ route('register') }}" class="btn btn-outline-gold">
                                <i class="fas fa-user-plus me-2"></i>Registrarse
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
        @if(session('success'))
            <div class="toast toast-gold toast-large show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="fas fa-check-circle text-gold me-2"></i>
                    <strong class="me-auto">¡Éxito!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        
        @if(session('error'))
            <div class="toast toast-dark toast-large show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="fas fa-exclamation-circle text-danger me-2"></i>
                    <strong class="me-auto">Error</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('error') }}
                </div>
            </div>
        @endif
    </div>

    <!-- Contenido Principal -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>
                        <i class="fas fa-coffee"></i> CafeteriaX
                    </h5>
                    <p class="text-white-50">
                        Tu plataforma para descubrir las mejores cafeterías con estilo y elegancia.
                    </p>
                    <div class="social-links mt-3">
                        <a href="#" class="footer-link me-3"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="footer-link me-3"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="footer-link me-3"><i class="fab fa-twitter fa-lg"></i></a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Enlaces Rápidos</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="footer-link">Sobre Nosotros</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Cafeterías</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Únete como Dueño</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Contacto</h5>
                    <ul class="list-unstyled text-white-50">
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i> info@cafeteriax.com</li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i> +34 900 123 456</li>
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Madrid, España</li>
                    </ul>
                </div>
            </div>
            <hr class="border-secondary">
            <div class="row">
                <div class="col-12 text-center text-white-50">
                    <p class="mb-0">&copy; {{ date('Y') }} CafeteriaX. Todos los derechos reservados.</p>
                    <p class="mb-0 small mt-1">
                        Desarrollado con <i class="fas fa-heart text-gold"></i> por <span class="text-gold fw-bold">NeuroX</span>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
    
    <script>
        // Auto-hide toasts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const toasts = document.querySelectorAll('.toast');
            toasts.forEach(toast => {
                setTimeout(() => {
                    const bsToast = bootstrap.Toast.getInstance(toast) || new bootstrap.Toast(toast);
                    bsToast.hide();
                }, 5000);
            });
        });
    </script>
</body>
</html>
