@extends('layouts.app')

@section('title', 'Mis Favoritos')

@section('content')
<!-- Hero Section -->
<section class="bg-dark py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 mb-3 text-gold">
                    <i class="fas fa-heart me-3"></i>Mis Cafeterías Favoritas
                </h1>
                <p class="lead" style="color: #C9A961;">Las cafeterías que más te gustan en un solo lugar</p>
            </div>
        </div>
    </div>
</section>

<!-- Lista de Favoritos -->
<section class="py-5">
    <div class="container">
        @if($favorites->isEmpty())
            <div class="text-center py-5">
                <i class="far fa-heart fa-5x text-muted mb-4"></i>
                <h3 class="text-muted mb-3">Aún no tienes favoritos</h3>
                <p class="text-muted mb-4">Explora las cafeterías y agrega tus favoritas haciendo click en el corazón</p>
                <a href="{{ route('cafeterias.index') }}" class="btn btn-gold btn-lg">
                    <i class="fas fa-search me-2"></i>Explorar Cafeterías
                </a>
            </div>
        @else
            <div class="row g-4">
                @foreach($favorites as $cafeteria)
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
                                
                                <div class="position-absolute top-0 end-0 m-3">
                                    <button class="btn btn-gold btn-sm rounded-circle favorite-btn d-flex align-items-center justify-content-center" 
                                            style="width: 40px; height: 40px; padding: 0;"
                                            data-cafeteria-id="{{ $cafeteria->id }}">
                                        <i class="fas fa-heart text-white"></i>
                                    </button>
                                </div>
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
        @endif
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const favoriteButtons = document.querySelectorAll('.favorite-btn');
    
    favoriteButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const cafeteriaId = btn.dataset.cafeteriaId;
            const card = btn.closest('.col-md-6');
            
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
                    // Eliminar la tarjeta con animación
                    card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.9)';
                    
                    setTimeout(() => {
                        card.remove();
                        
                        // Verificar si no quedan más favoritos
                        const remainingCards = document.querySelectorAll('.col-md-6').length;
                        if (remainingCards === 0) {
                            location.reload();
                        }
                    }, 300);
                    
                    showToast('error', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('error', 'Ocurrió un error al actualizar favoritos');
            });
        });
    });
    
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
