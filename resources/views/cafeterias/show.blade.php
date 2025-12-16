@extends('layouts.app')

@section('title', $cafeteria->name)

@section('content')
<!-- Hero con Imagen de Portada -->
<section class="position-relative" style="height: 400px;">
    @if($cafeteria->cover_image)
        <img src="{{ asset('storage/' . $cafeteria->cover_image) }}" 
             class="w-100 h-100" style="object-fit: cover;" alt="{{ $cafeteria->name }}">
    @else
        <div class="bg-gradient-gold w-100 h-100 d-flex align-items-center justify-content-center">
            <i class="fas fa-store fa-5x text-white opacity-50"></i>
        </div>
    @endif
    <div class="position-absolute bottom-0 start-0 end-0 p-4" 
         style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
        <div class="container">
            <div class="d-flex align-items-center gap-3">
                @if($cafeteria->logo)
                    <img src="{{ asset('storage/' . $cafeteria->logo) }}" 
                         alt="Logo" class="rounded-circle border border-3 border-white" 
                         style="width: 100px; height: 100px; object-fit: cover;">
                @endif
                <div>
                    <h1 class="text-white mb-2">{{ $cafeteria->name }}</h1>
                    <p class="text-white opacity-75 mb-0">
                        <i class="fas fa-user me-2"></i>Administrado por {{ $cafeteria->user->name }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Información y Menú -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Columna Principal - Menú -->
            <div class="col-lg-8">
                <div class="card card-elegant mb-4">
                    <div class="card-body">
                        <h3 class="mb-3">
                            <i class="fas fa-info-circle text-gold me-2"></i>Sobre Nosotros
                        </h3>
                        <p class="text-muted">{{ $cafeteria->description }}</p>
                    </div>
                </div>
                
                <div class="card card-elegant">
                    <div class="card-body">
                        <h3 class="mb-4">
                            <i class="fas fa-utensils text-gold me-2"></i>Nuestro Menú
                        </h3>
                        
                        @if($cafeteria->menuItems->isEmpty())
                            <div class="text-center py-5">
                                <i class="fas fa-coffee fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Aún no hay productos disponibles</p>
                            </div>
                        @else
                            @php
                                $groupedItems = $cafeteria->menuItems->groupBy('category.name');
                            @endphp
                            
                            @foreach($groupedItems as $categoryName => $items)
                                <div class="mb-4">
                                    <h5 class="text-gold mb-3 pb-2 border-bottom">
                                        {{ $items->first()->category->emoji ?? '' }} {{ $categoryName }}
                                    </h5>
                                    
                                    <div class="row g-3">
                                        @foreach($items as $item)
                                            <div class="col-md-6">
                                                <div class="d-flex gap-3 p-3 rounded hover-shadow">
                                                    @if($item->image)
                                                        <img src="{{ asset('storage/' . $item->image) }}" 
                                                             alt="{{ $item->name }}" 
                                                             class="rounded cursor-pointer" 
                                                             style="width: 80px; height: 80px; object-fit: cover;"
                                                             data-bs-toggle="modal" 
                                                             data-bs-target="#imageModal{{ $item->id }}">
                                                    @else
                                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                             style="width: 80px; height: 80px;">
                                                            <i class="fas fa-image text-muted"></i>
                                                        </div>
                                                    @endif
                                                    
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex justify-content-between align-items-start mb-1">
                                                            <h6 class="mb-0">{{ $item->name }}</h6>
                                                            <span class="badge bg-gold">${{ number_format($item->price, 0, ',', '.') }}</span>
                                                        </div>
                                                        
                                                        @if($item->description)
                                                            <p class="small text-muted mb-1">
                                                                {{ Str::limit($item->description, 60) }}
                                                            </p>
                                                        @endif
                                                        
                                                        @if($item->allergens)
                                                            <p class="small text-danger mb-0">
                                                                <i class="fas fa-exclamation-triangle me-1"></i>
                                                                @if(is_array($item->allergens))
                                                                    {{ implode(', ', $item->allergens) }}
                                                                @else
                                                                    {{ $item->allergens }}
                                                                @endif
                                                            </p>
                                                        @endif
                                                        
                                                        @if(!$item->is_available)
                                                            <span class="badge bg-secondary small">No disponible</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Columna Lateral - Información de Contacto -->
            <div class="col-lg-4">
                <div class="card card-elegant sticky-top" style="top: 20px;">
                    <div class="card-body">
                        <h5 class="mb-4">
                            <i class="fas fa-address-card text-gold me-2"></i>Información de Contacto
                        </h5>
                        
                        @if($cafeteria->address)
                            <div class="mb-3">
                                <h6 class="text-muted small mb-1">Dirección</h6>
                                <p class="mb-0">
                                    <i class="fas fa-map-marker-alt text-gold me-2"></i>
                                    {{ $cafeteria->address }}
                                </p>
                            </div>
                        @endif
                        
                        @if($cafeteria->phone)
                            <div class="mb-3">
                                <h6 class="text-muted small mb-1">Teléfono</h6>
                                <p class="mb-0">
                                    <i class="fas fa-phone text-gold me-2"></i>
                                    <a href="tel:{{ $cafeteria->phone }}" class="text-decoration-none">
                                        {{ $cafeteria->phone }}
                                    </a>
                                </p>
                            </div>
                        @endif
                        
                        @if($cafeteria->email)
                            <div class="mb-3">
                                <h6 class="text-muted small mb-1">Email</h6>
                                <p class="mb-0">
                                    <i class="fas fa-envelope text-gold me-2"></i>
                                    <a href="mailto:{{ $cafeteria->email }}" class="text-decoration-none">
                                        {{ $cafeteria->email }}
                                    </a>
                                </p>
                            </div>
                        @endif
                        
                        @if($cafeteria->opening_hours)
                            <div class="mb-3">
                                <h6 class="text-muted small mb-1">Horario</h6>
                                <div class="small">
                                    <i class="fas fa-clock text-gold me-2"></i>
                                    @php
                                        $hours = is_string($cafeteria->opening_hours) 
                                            ? json_decode($cafeteria->opening_hours, true) 
                                            : $cafeteria->opening_hours;
                                    @endphp
                                    
                                    @if(is_array($hours))
                                        @foreach($hours as $day => $schedule)
                                            <div class="d-flex justify-content-between py-1">
                                                <span class="text-capitalize">{{ $day }}:</span>
                                                <span class="text-muted">{{ $schedule }}</span>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="mb-0">{{ $cafeteria->opening_hours }}</p>
                                    @endif
                                </div>
                            </div>
                        @endif
                        
                        <hr>
                        
                        <div class="d-grid gap-2">
                            @auth
                                <button id="favoriteBtn" class="btn btn-outline-gold" data-cafeteria-id="{{ $cafeteria->id }}">
                                    <i id="favoriteIcon" class="fas fa-heart me-2"></i>
                                    <span id="favoriteText">Cargando...</span>
                                </button>
                            @endauth
                            
                            <a href="{{ route('cafeterias.index') }}" class="btn btn-outline-gold">
                                <i class="fas fa-arrow-left me-2"></i>Volver al Listado
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modales para las imágenes -->
@foreach($cafeteria->menuItems as $item)
    @if($item->image)
        <div class="modal fade" id="imageModal{{ $item->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content" style="background: white; border: 2px solid #D4AF37;">
                    <div class="modal-header" style="background: linear-gradient(135deg, #D4AF37 0%, #E5C158 100%); border-bottom: none;">
                        <h5 class="modal-title text-white fw-bold" id="imageModalLabel{{ $item->id }}">
                            <i class="fas fa-utensils me-2"></i>{{ $item->name }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-4">
                            <!-- Imagen -->
                            <div class="col-md-7">
                                <img src="{{ asset('storage/' . $item->image) }}" 
                                     alt="{{ $item->name }}" 
                                     class="img-fluid rounded shadow-lg"
                                     style="width: 100%; height: auto; max-height: 500px; object-fit: contain;">
                            </div>
                            
                            <!-- Información del producto -->
                            <div class="col-md-5">
                                <div class="h-100 d-flex flex-column">
                                    <!-- Precio -->
                                    <div class="mb-3">
                                        <span class="badge bg-gold fs-4 px-3 py-2">
                                            ${{ number_format($item->price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    
                                    <!-- Categoría -->
                                    <div class="mb-3">
                                        <small class="text-gold">
                                            <i class="fas fa-tag me-2"></i>{{ $item->category->emoji ?? '' }} {{ $item->category->name }}
                                        </small>
                                    </div>
                                    
                                    <!-- Descripción -->
                                    @if($item->description)
                                        <div class="mb-3">
                                            <h6 class="text-gold mb-2">
                                                <i class="fas fa-info-circle me-2"></i>Descripción
                                            </h6>
                                            <p class="text-dark mb-0">{{ $item->description }}</p>
                                        </div>
                                    @endif
                                    
                                    <!-- Tiempo de preparación -->
                                    @if($item->preparation_time)
                                        <div class="mb-3">
                                            <small class="text-dark">
                                                <i class="fas fa-clock text-gold me-2"></i>Tiempo de preparación: {{ $item->preparation_time }} minutos
                                            </small>
                                        </div>
                                    @endif
                                    
                                    <!-- Alérgenos -->
                                    @if($item->allergens)
                                        <div class="mb-3">
                                            <h6 class="text-danger mb-2">
                                                <i class="fas fa-exclamation-triangle me-2"></i>Alérgenos
                                            </h6>
                                            <div class="d-flex flex-wrap gap-2">
                                                @if(is_array($item->allergens))
                                                    @foreach($item->allergens as $allergen)
                                                        <span class="badge bg-danger">{{ $allergen }}</span>
                                                    @endforeach
                                                @else
                                                    <span class="badge bg-danger">{{ $item->allergens }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <!-- Estado de disponibilidad -->
                                    <div class="mt-auto">
                                        @if($item->is_available)
                                            <span class="badge bg-success fs-6 px-3 py-2">
                                                <i class="fas fa-check-circle me-2"></i>Disponible
                                            </span>
                                        @else
                                            <span class="badge bg-secondary fs-6 px-3 py-2">
                                                <i class="fas fa-times-circle me-2"></i>No disponible
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const favoriteBtn = document.getElementById('favoriteBtn');
    const favoriteIcon = document.getElementById('favoriteIcon');
    const favoriteText = document.getElementById('favoriteText');
    
    if (!favoriteBtn) return;
    
    const cafeteriaId = favoriteBtn.dataset.cafeteriaId;
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    
    if (!csrfToken) {
        console.error('CSRF token not found');
        return;
    }
    
    // Verificar estado inicial
    fetch(`/favoritos/check/${cafeteriaId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            updateButton(data.favorited);
        })
        .catch(error => {
            console.error('Error checking favorite status:', error);
            favoriteText.textContent = 'Agregar a Favoritos';
            favoriteIcon.classList.add('far');
        });
    
    // Toggle favorito
    favoriteBtn.addEventListener('click', function() {
        fetch(`/favoritos/toggle/${cafeteriaId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken.content
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                updateButton(data.favorited);
                
                // Mostrar notificación
                if (data.favorited) {
                    showToast('success', data.message);
                } else {
                    showToast('error', data.message);
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('error', 'Ocurrió un error al actualizar favoritos');
        });
    });
    
    function updateButton(isFavorited) {
        if (isFavorited) {
            favoriteIcon.classList.remove('far');
            favoriteIcon.classList.add('fas');
            favoriteText.textContent = 'Eliminar de Favoritos';
            favoriteBtn.classList.remove('btn-outline-gold');
            favoriteBtn.classList.add('btn-gold');
            
            // Animación compleja de favorito
            favoriteBtn.style.animation = 'favoriteHeartBoom 0.8s ease-out';
            createHeartParticles(favoriteBtn);
            
            setTimeout(() => {
                favoriteBtn.style.animation = '';
            }, 800);
        } else {
            favoriteIcon.classList.remove('fas');
            favoriteIcon.classList.add('far');
            favoriteText.textContent = 'Agregar a Favoritos';
            favoriteBtn.classList.remove('btn-gold');
            favoriteBtn.classList.add('btn-outline-gold');
            
            // Animación al quitar favorito
            favoriteBtn.style.animation = 'unfavoriteShake 0.4s ease';
            setTimeout(() => {
                favoriteBtn.style.animation = '';
            }, 400);
        }
    }
    
    function createHeartParticles(btn) {
        const colors = ['#D4AF37', '#E5C158', '#FFD700', '#FFA500'];
        const btnRect = btn.getBoundingClientRect();
        
        for (let i = 0; i < 8; i++) {
            const particle = document.createElement('i');
            particle.className = 'fas fa-heart';
            particle.style.position = 'fixed';
            particle.style.left = btnRect.left + btnRect.width / 2 + 'px';
            particle.style.top = btnRect.top + btnRect.height / 2 + 'px';
            particle.style.color = colors[Math.floor(Math.random() * colors.length)];
            particle.style.fontSize = (Math.random() * 10 + 10) + 'px';
            particle.style.pointerEvents = 'none';
            particle.style.zIndex = '9999';
            
            const angle = (Math.PI * 2 * i) / 8;
            const distance = 60;
            const x = Math.cos(angle) * distance;
            const y = Math.sin(angle) * distance;
            
            particle.style.animation = `heartParticle 0.8s ease-out forwards`;
            particle.style.setProperty('--tx', x + 'px');
            particle.style.setProperty('--ty', y + 'px');
            
            document.body.appendChild(particle);
            
            setTimeout(() => particle.remove(), 800);
        }
    }
    
    function showToast(type, message) {
        const toastEl = type === 'success' 
            ? document.getElementById('successToast')
            : document.getElementById('errorToast');
        
        if (!toastEl) {
            console.error('Toast element not found');
            return;
        }
        
        const messageEl = toastEl.querySelector('.toast-body');
        if (messageEl) {
            messageEl.textContent = message;
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }
    }
});
</script>
@endpush
