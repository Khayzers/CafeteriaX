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
                    <x-cafeteria-card :cafeteria="$cafeteria" />
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
    @vite('resources/js/cafeterias/index.js')
@endpush

@endsection
