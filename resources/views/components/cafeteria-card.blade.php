@props(['cafeteria'])

<div class="col-md-6 col-lg-4">
    <div class="card card-elegant h-100">
        <div class="position-relative">
            @if($cafeteria->cover_image)
                <img src="{{ asset('storage/' . $cafeteria->cover_image) }}" 
                     class="card-img-top" alt="{{ $cafeteria->name }}" loading="lazy"
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
                            data-cafeteria-id="{{ $cafeteria->id }}"
                            aria-label="Agregar a favoritos"
                            aria-pressed="false">
                        <i class="fas fa-heart text-gold favorite-icon"></i>
                    </button>
                </div>
            @endauth
        </div>
        
        <div class="card-body d-flex flex-column">
            <div class="d-flex align-items-start justify-content-between mb-2">
                <h5 class="card-title mb-0">{{ $cafeteria->name }}</h5>
                @if($cafeteria->logo)
                    <img src="{{ asset('storage/' . $cafeteria->logo) }}" loading="lazy"
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
