@extends('layouts.app')

@section('title', 'Editar Item - ' . $cafeteria->name)


@push('styles')
<style>
#cropperModal {
    transition: none !important;
}
#cropperModal .modal-dialog {
    max-width: 500px;
    margin: auto;
}
#cropperModal .modal-content {
    background: #fff;
    box-shadow: 0 0 24px #0002;
    border-radius: 12px;
}
#croppieContainer {
    width: 400px;
    height: 350px;
    margin: auto;
    background: #fff;
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 0 8px #0001;
}
.cr-boundary {
    background: #fff !important;
    box-shadow: none !important;
}
.cr-viewport {
    box-shadow: 0 0 0 2px #D4AF37 !important;
    border-radius: 8px !important;
}
</style>
@endpush

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card card-elegant">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="mb-0">
                                <i class="fas fa-edit text-gold me-2"></i>Editar Item del Menú
                            </h2>
                            <a href="{{ route('dueno.menu.index', $cafeteria->id) }}" class="btn btn-outline-gold">
                                <i class="fas fa-arrow-left me-2"></i>Volver
                            </a>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('dueno.menu.update', [$cafeteria->id, $menuItem->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-3 mb-4">
                                <div class="col-12">
                                    <h5 class="text-gold mb-3">
                                        <i class="fas fa-info-circle me-2"></i>Información del Producto
                                    </h5>
                                </div>

                                <div class="col-md-8">
                                    <label for="name" class="form-label">Nombre *</label>
                                    <input type="text" class="form-control form-control-elegant" id="name" name="name" 
                                           value="{{ old('name', $menuItem->name) }}" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="category_id" class="form-label">Categoría *</label>
                                    <select class="form-select form-control-elegant" id="category_id" name="category_id" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $menuItem->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->emoji }} {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label for="description" class="form-label">Descripción</label>
                                    <textarea class="form-control form-control-elegant" id="description" name="description" 
                                              rows="3">{{ old('description', $menuItem->description) }}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="price" class="form-label">Precio (CLP) *</label>
                                    <input type="number" class="form-control form-control-elegant" id="price" name="price" 
                                           value="{{ old('price', $menuItem->price) }}" min="0" step="100" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="preparation_time" class="form-label">Tiempo de Preparación (minutos)</label>
                                    <input type="number" class="form-control form-control-elegant" id="preparation_time" name="preparation_time" 
                                           value="{{ old('preparation_time', $menuItem->preparation_time) }}" min="0">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Alérgenos</label>
                                    <div class="row g-2">
                                        @php
                                            $alergenos = ['gluten', 'lactosa', 'nueces', 'soja', 'huevo', 'pescado', 'mariscos', 'sésamo'];
                                            $selectedAlergenos = old('allergens', $menuItem->allergens ?? []);
                                        @endphp
                                        @foreach($alergenos as $alergeno)
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" 
                                                           name="allergens[]" value="{{ $alergeno }}" 
                                                           id="allergen_{{ $alergeno }}"
                                                           {{ in_array($alergeno, $selectedAlergenos) ? 'checked' : '' }}>
                                                    <label class="form-check-label text-capitalize" for="allergen_{{ $alergeno }}">
                                                        {{ $alergeno }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_available" name="is_available" 
                                               {{ old('is_available', $menuItem->is_available) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_available">
                                            Disponible para la venta
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-12">
                                    <h5 class="text-gold mb-3">
                                        <i class="fas fa-image me-2"></i>Imagen del Producto
                                    </h5>
                                </div>

                                <div class="col-12">
                                    @if($menuItem->image)
                                        <div class="mb-3">
                                            <label class="form-label">Imagen Actual</label>
                                            <div>
                                                <img src="{{ asset('storage/' . $menuItem->image) }}" 
                                                     alt="Imagen actual" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                                            </div>
                                        </div>
                                    @endif
                                    <label for="imageInput" class="form-label">{{ $menuItem->image ? 'Cambiar Imagen' : 'Nueva Imagen' }}</label>
                                    <input type="file" class="form-control form-control-elegant" id="imageInput" accept="image/*">
                                    <input type="hidden" name="image" id="croppedImage" disabled>
                                    <small class="text-muted">Formato: JPG, PNG. Tamaño máx: 4MB. La imagen será recortada en formato cuadrado.</small>
                                </div>
                                
                                <!-- Modal para recortar imagen -->
                                <div class="modal fade" id="cropperModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-dark">
                                                <h5 class="modal-title text-gold">
                                                    <i class="fas fa-crop-alt me-2"></i>Recortar Imagen
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body" style="padding: 30px; background: #f8f9fa;">
                                                <div id="croppieContainer"></div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                    <i class="fas fa-times me-2"></i>Cancelar
                                                </button>
                                                <button type="button" class="btn btn-gold" id="cropButton">
                                                    <i class="fas fa-check me-2"></i>Aplicar Recorte
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Preview de nueva imagen recortada -->
                                <div class="col-12" id="previewContainer" style="display: none;">
                                    <label class="form-label">Nueva Vista Previa</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <img id="croppedPreview" class="rounded shadow" style="width: 150px; height: 150px; object-fit: cover;">
                                        <button type="button" class="btn btn-outline-gold btn-sm" onclick="document.getElementById('imageInput').click()">
                                            <i class="fas fa-sync-alt me-2"></i>Cambiar Imagen
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-3 justify-content-end pt-3 border-top">
                                <a href="{{ route('dueno.menu.index', $cafeteria->id) }}" class="btn btn-outline-gold px-4">
                                    <i class="fas fa-times me-2"></i>Cancelar
                                </a>
                                <button type="submit" class="btn btn-gold px-4">
                                    <i class="fas fa-save me-2"></i>Guardar Cambios
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
let croppieInstance;
let imageToLoad;
const imageInput = document.getElementById('imageInput');
const cropperModalElement = document.getElementById('cropperModal');
const croppieContainer = document.getElementById('croppieContainer');
const cropButton = document.getElementById('cropButton');
const croppedPreview = document.getElementById('croppedPreview');
const previewContainer = document.getElementById('previewContainer');
const croppedImageInput = document.getElementById('croppedImage');

imageInput.addEventListener('change', function(e) {
    const files = e.target.files;
    if (files && files.length > 0) {
        const file = files[0];
        
        if (file.size > 4 * 1024 * 1024) {
            alert('La imagen no debe superar los 4MB');
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(event) {
            imageToLoad = event.target.result;
            
            // Abrir el modal
            const btn = document.createElement('button');
            btn.setAttribute('data-bs-toggle', 'modal');
            btn.setAttribute('data-bs-target', '#cropperModal');
            btn.style.display = 'none';
            document.body.appendChild(btn);
            btn.click();
            document.body.removeChild(btn);
        };
        reader.readAsDataURL(file);
    }
});

// Inicializar Croppie cuando el modal esté completamente visible
cropperModalElement.addEventListener('shown.bs.modal', function() {
    if (imageToLoad && !croppieInstance) {
        croppieInstance = new Croppie(croppieContainer, {
            viewport: { width: 300, height: 300, type: 'square' },
            boundary: { width: 400, height: 350 },
            showZoomer: true,
            enableOrientation: false,
            enableExif: true
        });
        
        croppieInstance.bind({
            url: imageToLoad
        });
    }
});

cropButton.addEventListener('click', function() {
    if (croppieInstance) {
        croppieInstance.result({
            type: 'base64',
            size: { width: 500, height: 500 },
            format: 'jpeg',
            quality: 0.9
        }).then(function(base64) {
            croppedPreview.src = base64;
            previewContainer.style.display = 'block';
            croppedImageInput.value = base64;
            croppedImageInput.disabled = false;
            
            // Cerrar modal
            const closeBtn = cropperModalElement.querySelector('[data-bs-dismiss="modal"]');
            if (closeBtn) closeBtn.click();
        });
    }
});

// Limpiar croppie cuando se cierra el modal
cropperModalElement.addEventListener('hidden.bs.modal', function() {
    if (croppieInstance) {
        croppieInstance.destroy();
        croppieInstance = null;
        imageToLoad = null;
    }
});
</script>
@endpush

@endsection
