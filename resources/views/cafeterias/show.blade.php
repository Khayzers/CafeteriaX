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
                                            <x-menu-item-card :item="$item" />
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
                                <button id="favoriteBtn" class="btn btn-outline-gold" data-cafeteria-id="{{ $cafeteria->id }}"
                                        aria-label="Agregar a favoritos" aria-pressed="false">
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
        <x-menu-item-modal :item="$item" />
    @endif
@endforeach

@endsection

@push('scripts')
    @vite('resources/js/cafeterias/show.js')
@endpush
