@extends('layouts.app')

@section('title', 'Cafeterías')

@section('content')
<!-- Hero Section -->
<section class="bg-dark py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 mb-3 text-gold">Descubre las Mejores Cafeterías</h1>
                <p class="lead mb-3" style="color: #C9A961;">Encuentra tu lugar favorito para disfrutar de un buen café</p>
                
                <!-- Buscador -->
                <div class="search-box">
                    <form action="{{ route('cafeterias.index') }}" method="GET">
                        <div class="input-group input-group-lg">
                            <input type="text" name="search" class="form-control form-control-elegant" 
                                   placeholder="Buscar cafeterías..." value="{{ request('search') }}">
                            <button class="btn btn-gold" type="submit">
                                <i class="fas fa-search me-2"></i>Buscar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filtros por Categoría -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="d-flex flex-wrap gap-2 justify-content-center">
            <a href="{{ route('cafeterias.index') }}" 
               class="btn {{ !request('category') ? 'btn-gold' : 'btn-outline-gold' }}">
                Todas
            </a>
            @foreach($categories as $category)
                <a href="{{ route('cafeterias.index', ['category' => $category->id]) }}" 
                   class="btn {{ request('category') == $category->id ? 'btn-gold' : 'btn-outline-gold' }}">
                    {{ $category->emoji }} {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Lista de Cafeterías -->
<section class="py-5">
    <div class="container">
        @if($cafeterias->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-coffee fa-4x text-muted mb-3"></i>
                <h3 class="text-muted">No se encontraron cafeterías</h3>
                <p class="text-muted">Intenta con otra búsqueda o categoría</p>
            </div>
        @else
            <div class="row g-4">
                @foreach($cafeterias as $cafeteria)
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-elegant h-100">
                            <div class="position-relative">
                                @if($cafeteria->cover_image)
                                    <img src="{{ asset('storage/' . $cafeteria->cover_image) }}" 
                                         class="card-img-top" alt="{{ $cafeteria->name }}" 
                                         style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="bg-gradient-gold d-flex align-items-center justify-content-center" 
                                         style="height: 200px;">
                                        <i class="fas fa-store fa-4x text-white opacity-50"></i>
                                    </div>
                                @endif
                                
                                @auth
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <button class="btn btn-light btn-sm rounded-circle favorite-btn d-flex align-items-center justify-content-center" 
                                                style="width: 40px; height: 40px; padding: 0;"
                                                data-cafeteria-id="{{ $cafeteria->id }}">
                                            <i class="fas fa-heart text-gold favorite-icon"></i>
                                        </button>
                                    </div>
                                @endauth
                            </div>
                            
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <h5 class="card-title mb-0">{{ $cafeteria->name }}</h5>
                                    @if($cafeteria->logo)
                                        <img src="{{ asset('storage/' . $cafeteria->logo) }}" 
                                             alt="Logo" class="rounded-circle" 
                                             style="width: 40px; height: 40px; object-fit: cover;">
                                    @endif
                                </div>
                                
                                <p class="card-text text-muted small mb-3">
                                    {{ Str::limit($cafeteria->description, 100) }}
                                </p>
                                
                                <div class="mb-3">
                                    @if($cafeteria->address)
                                        <p class="mb-1 small">
                                            <i class="fas fa-map-marker-alt text-gold me-2"></i>
                                            {{ Str::limit($cafeteria->address, 40) }}
                                        </p>
                                    @endif
                                    @if($cafeteria->phone)
                                        <p class="mb-1 small">
                                            <i class="fas fa-phone text-gold me-2"></i>
                                            {{ $cafeteria->phone }}
                                        </p>
                                    @endif
                                    <p class="mb-0 small">
                                        <i class="fas fa-utensils text-gold me-2"></i>
                                        {{ $cafeteria->menu_items_count }} productos
                                    </p>
                                </div>
                                
                                <div class="mt-auto">
                                    <a href="{{ route('cafeterias.show', $cafeteria->id) }}" 
                                       class="btn btn-gold w-100">
                                        Ver Detalles <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Paginación -->
            <div class="d-flex justify-content-center mt-5">
                {{ $cafeterias->links() }}
            </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const favoriteButtons = document.querySelectorAll('.favorite-btn');
    
    // Verificar estado inicial de todos los favoritos
    favoriteButtons.forEach(btn => {
        const cafeteriaId = btn.dataset.cafeteriaId;
        const icon = btn.querySelector('.favorite-icon');
        
        fetch(`/favoritos/check/${cafeteriaId}`)
            .then(response => response.json())
            .then(data => {
                updateIcon(icon, data.favorited);
            });
        
        // Toggle favorito al hacer click
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            fetch(`/favoritos/toggle/${cafeteriaId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateIcon(icon, data.favorited);
                    showToast(data.favorited ? 'success' : 'error', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('error', 'Ocurrió un error al actualizar favoritos');
            });
        });
    });
    
    function updateIcon(icon, isFavorited) {
        const btn = icon.closest('.favorite-btn');
        const card = btn.closest('.card');
        
        if (isFavorited) {
            icon.classList.remove('far', 'text-gold');
            icon.classList.add('fas', 'text-white');
            btn.classList.remove('btn-light');
            btn.classList.add('btn-gold');
            
            // Animación compleja de favorito
            card.style.animation = 'favoriteCardPulse 0.8s ease-out';
            btn.style.animation = 'favoriteHeartBoom 0.8s ease-out';
            
            // Crear partículas de corazones
            createHeartParticles(btn);
            
            setTimeout(() => {
                card.style.animation = '';
                btn.style.animation = '';
            }, 800);
        } else {
            icon.classList.remove('fas', 'text-white');
            icon.classList.add('far', 'text-gold');
            btn.classList.remove('btn-gold');
            btn.classList.add('btn-light');
            
            // Animación al quitar favorito
            btn.style.animation = 'unfavoriteShake 0.4s ease';
            card.style.animation = 'cardFadeOut 0.4s ease';
            
            setTimeout(() => {
                btn.style.animation = '';
                card.style.animation = '';
            }, 400);
        }
    }
    
    function createHeartParticles(btn) {
        const colors = ['#D4AF37', '#E5C158', '#FFD700', '#FFA500'];
        for (let i = 0; i < 8; i++) {
            const particle = document.createElement('i');
            particle.className = 'fas fa-heart';
            particle.style.position = 'absolute';
            particle.style.color = colors[Math.floor(Math.random() * colors.length)];
            particle.style.fontSize = (Math.random() * 10 + 10) + 'px';
            particle.style.pointerEvents = 'none';
            particle.style.zIndex = '9999';
            
            const angle = (Math.PI * 2 * i) / 8;
            const distance = 50;
            const x = Math.cos(angle) * distance;
            const y = Math.sin(angle) * distance;
            
            particle.style.animation = `heartParticle 0.8s ease-out forwards`;
            particle.style.setProperty('--tx', x + 'px');
            particle.style.setProperty('--ty', y + 'px');
            
            btn.parentElement.appendChild(particle);
            
            setTimeout(() => particle.remove(), 800);
        }
    }
    
    function showToast(type, message) {
        const toastEl = type === 'success' 
            ? document.getElementById('successToast')
            : document.getElementById('errorToast');
        const messageEl = toastEl.querySelector('.toast-body');
        messageEl.textContent = message;
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
    }
});
</script>
@endpush

@endsection
