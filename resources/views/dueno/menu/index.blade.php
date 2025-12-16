@extends('layouts.app')

@section('title', 'Gestionar Menú - ' . $cafeteria->name)

@section('content')
<section class="py-4 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">
                    <i class="fas fa-utensils text-gold me-2"></i>Menú de {{ $cafeteria->name }}
                </h2>
                <p class="text-muted mb-0">{{ $menuItems->count() }} productos en el menú</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('dueno.dashboard') }}" class="btn btn-outline-gold">
                    <i class="fas fa-arrow-left me-2"></i>Volver
                </a>
                <a href="{{ route('dueno.menu.create', $cafeteria->id) }}" class="btn btn-gold">
                    <i class="fas fa-plus-circle me-2"></i>Nuevo Item
                </a>
            </div>
        </div>

        @if($menuItems->isEmpty())
            <div class="card card-elegant">
                <div class="card-body text-center py-5">
                    <i class="fas fa-utensils fa-5x text-gold mb-4" style="opacity: 0.3;"></i>
                    <h3>No hay items en el menú</h3>
                    <p class="text-muted mb-4">Comienza agregando productos a tu menú</p>
                    <a href="{{ route('dueno.menu.create', $cafeteria->id) }}" class="btn btn-gold">
                        <i class="fas fa-plus-circle me-2"></i>Agregar Primer Item
                    </a>
                </div>
            </div>
        @else
            @php
                $groupedItems = $menuItems->groupBy('category.name');
            @endphp

            @foreach($groupedItems as $categoryName => $items)
                <div class="card card-elegant mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0 text-gold">
                            {{ $items->first()->category->emoji ?? '' }} {{ $categoryName }}
                            <span class="badge bg-light text-dark ms-2">{{ $items->count() }}</span>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">Imagen</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th style="width: 120px;">Precio</th>
                                        <th style="width: 100px;">Estado</th>
                                        <th style="width: 150px;" class="text-end">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <td>
                                                @if($item->image)
                                                    <img src="{{ asset('storage/' . $item->image) }}" 
                                                         alt="{{ $item->name }}" 
                                                         class="rounded" 
                                                         style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                         style="width: 60px; height: 60px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $item->name }}</strong>
                                                @if($item->allergens)
                                                    <br>
                                                    <small class="text-danger">
                                                        <i class="fas fa-exclamation-triangle"></i>
                                                        @if(is_array($item->allergens))
                                                            {{ implode(', ', $item->allergens) }}
                                                        @else
                                                            {{ $item->allergens }}
                                                        @endif
                                                    </small>
                                                @endif
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ Str::limit($item->description, 50) }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-gold">${{ number_format($item->price, 0, ',', '.') }}</span>
                                            </td>
                                            <td>
                                                @if($item->is_available)
                                                    <span class="badge bg-success">Disponible</span>
                                                @else
                                                    <span class="badge bg-secondary">No disponible</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('dueno.menu.edit', [$cafeteria->id, $item->id]) }}" 
                                                       class="btn btn-outline-gold">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('dueno.menu.destroy', [$cafeteria->id, $item->id]) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('¿Estás seguro de eliminar este item?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</section>
@endsection
