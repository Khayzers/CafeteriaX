@props(['cafeteria'])

<div class="col-lg-6">
    <div class="card border-0 shadow-sm h-100">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h4 class="mb-1">{{ $cafeteria->name }}</h4>
                    <p class="text-muted mb-0">
                        <i class="fas fa-map-marker-alt me-1"></i>
                        {{ $cafeteria->city }}
                    </p>
                </div>
                <span class="badge {{ $cafeteria->is_active ? 'bg-success' : 'bg-secondary' }}">
                    {{ $cafeteria->is_active ? 'Activa' : 'Inactiva' }}
                </span>
            </div>

            <p class="text-muted mb-3">{{ Str::limit($cafeteria->description, 100) }}</p>

            <div class="row g-3 mb-3">
                <div class="col-4">
                    <div class="text-center p-2 bg-light rounded">
                        <div class="text-gold fw-bold">{{ $cafeteria->menu_items_count }}</div>
                        <small class="text-muted">Menú</small>
                    </div>
                </div>
                <div class="col-4">
                    <div class="text-center p-2 bg-light rounded">
                        <div class="text-gold fw-bold">{{ $cafeteria->inventory_items_count }}</div>
                        <small class="text-muted">Inventario</small>
                    </div>
                </div>
                <div class="col-4">
                    <div class="text-center p-2 bg-light rounded">
                        <div class="text-gold fw-bold">0</div>
                        <small class="text-muted">Favoritos</small>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('dueno.cafeterias.edit', $cafeteria->id) }}" class="btn btn-gold btn-sm flex-fill" aria-label="Editar {{ $cafeteria->name }}">
                    <i class="fas fa-edit me-1"></i>Editar
                </a>
                <a href="{{ route('dueno.menu.index', $cafeteria->id) }}" class="btn btn-outline-gold btn-sm flex-fill" aria-label="Ver menú de {{ $cafeteria->name }}">
                    <i class="fas fa-utensils me-1"></i>Menú
                </a>
                <a href="#" class="btn btn-outline-gold btn-sm flex-fill" aria-label="Gestionar inventario de {{ $cafeteria->name }}">
                    <i class="fas fa-boxes me-1"></i>Inventario
                </a>
                <form action="{{ route('dueno.cafeterias.destroy', $cafeteria->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar esta cafetería?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm" aria-label="Eliminar {{ $cafeteria->name }}">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
