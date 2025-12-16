@extends('layouts.app')

@section('title', 'CafeteriaX - Descubre las mejores cafeterías')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 hero-content">
                <h1 class="hero-title">
                    Descubre las Mejores <span class="text-gold">Cafeterías</span> de tu Ciudad
                </h1>
                <p class="hero-subtitle">
                    Explora menús únicos, encuentra tu café favorito y disfruta de una experiencia premium en cada visita.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('cafeterias.index') }}" class="btn btn-gold btn-lg">
                        <i class="fas fa-search me-2"></i>Explorar Cafeterías
                    </a>
                    <a href="#" class="btn btn-outline-gold btn-lg">
                        <i class="fas fa-info-circle me-2"></i>Más Información
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center d-none d-lg-block">
                <i class="fas fa-mug-hot" style="font-size: 20rem; color: var(--gold-light); opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</section>

<!-- Categorías Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title fade-in-up">Explora por Categoría</h2>
        <div class="row g-4">
            @foreach($categories as $category)
            <div class="col-lg-2 col-md-4 col-6">
                <div class="category-item fade-in-up">
                    <div class="category-icon">{{ $category->icon }}</div>
                    <div class="category-name">{{ $category->name }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Cafeterías Destacadas Section -->
<section class="py-5">
    <div class="container">
        <h2 class="section-title">Cafeterías Destacadas</h2>
        
        @if($cafeterias->count() > 0)
        <div class="row g-4">
            @foreach($cafeterias as $cafeteria)
            <div class="col-lg-4 col-md-6">
                <div class="card cafe-card fade-in-up">
                    <div class="position-relative overflow-hidden">
                        @if($cafeteria->cover_image)
                            <img src="{{ $cafeteria->cover_image }}" class="cafe-card-img" alt="{{ $cafeteria->name }}">
                        @else
                            <div class="cafe-card-img d-flex align-items-center justify-content-center bg-light">
                                <i class="fas fa-store fa-5x text-gold" style="opacity: 0.3;"></i>
                            </div>
                        @endif
                        <div class="position-absolute top-0 end-0 m-3">
                            <button class="btn btn-light btn-sm rounded-circle" style="width: 40px; height: 40px;">
                                <i class="far fa-heart text-gold"></i>
                            </button>
                        </div>
                    </div>
                    <div class="cafe-card-body">
                        <h3 class="cafe-card-title">{{ $cafeteria->name }}</h3>
                        <p class="cafe-card-text">
                            <i class="fas fa-map-marker-alt text-gold me-2"></i>
                            {{ $cafeteria->address }}, {{ $cafeteria->city }}
                        </p>
                        <p class="cafe-card-text">{{ $cafeteria->description }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="cafe-badge">
                                <i class="fas fa-star me-1"></i>Premium
                            </span>
                            <a href="{{ route('cafeterias.show', $cafeteria->id) }}" class="btn btn-sm btn-outline-gold">
                                Ver Menú <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('cafeterias.index') }}" class="btn btn-gold btn-lg">
                Ver Todas las Cafeterías <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-coffee fa-5x text-gold mb-4" style="opacity: 0.3;"></i>
            <h3>No hay cafeterías disponibles</h3>
            <p class="text-muted">Pronto agregaremos nuevas cafeterías increíbles.</p>
        </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-dark text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="mb-3 text-gold">¿Tienes una cafetería?</h2>
                <p class="lead mb-0">
                    Únete a nuestra plataforma y llega a miles de amantes del café. 
                    Gestiona tu menú, inventario y mucho más de forma elegante y sencilla.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                <a href="#" class="btn btn-gold btn-lg">
                    <i class="fas fa-rocket me-2"></i>Comenzar Ahora
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <h2 class="section-title">¿Por qué CafeteriaX?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-search fa-4x text-gold"></i>
                    </div>
                    <h4>Fácil Exploración</h4>
                    <p class="text-muted">
                        Descubre cafeterías cerca de ti con información detallada de menús y ubicaciones.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-heart fa-4x text-gold"></i>
                    </div>
                    <h4>Guarda Favoritos</h4>
                    <p class="text-muted">
                        Marca tus cafeterías y productos favoritos para acceder a ellos rápidamente.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-crown fa-4x text-gold"></i>
                    </div>
                    <h4>Experiencia Premium</h4>
                    <p class="text-muted">
                        Disfruta de una interfaz elegante y cómoda diseñada para amantes del café.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Animación suave al hacer scroll
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        });

        document.querySelectorAll('.fade-in-up').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.6s ease';
            observer.observe(el);
        });
    });
</script>
@endpush
