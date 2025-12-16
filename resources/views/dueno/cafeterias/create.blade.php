@extends('layouts.app')

@section('title', 'Crear Cafetería')

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card card-elegant">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="mb-0">
                                <i class="fas fa-plus-circle text-gold me-2"></i>Nueva Cafetería
                            </h2>
                            <a href="{{ route('dueno.dashboard') }}" class="btn btn-outline-gold">
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

                        <form action="{{ route('dueno.cafeterias.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Información Básica -->
                            <div class="row g-3 mb-4">
                                <div class="col-12">
                                    <h5 class="text-gold mb-3">
                                        <i class="fas fa-info-circle me-2"></i>Información Básica
                                    </h5>
                                </div>

                                <div class="col-12">
                                    <label for="name" class="form-label">Nombre de la Cafetería *</label>
                                    <input type="text" class="form-control form-control-elegant" id="name" name="name" 
                                           value="{{ old('name') }}" required>
                                </div>

                                <div class="col-12">
                                    <label for="description" class="form-label">Descripción *</label>
                                    <textarea class="form-control form-control-elegant" id="description" name="description" 
                                              rows="4" required>{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <!-- Información de Contacto -->
                            <div class="row g-3 mb-4">
                                <div class="col-12">
                                    <h5 class="text-gold mb-3">
                                        <i class="fas fa-phone me-2"></i>Información de Contacto
                                    </h5>
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Teléfono *</label>
                                    <input type="text" class="form-control form-control-elegant" id="phone" name="phone" 
                                           value="{{ old('phone') }}" placeholder="+56 9 1234 5678" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control form-control-elegant" id="email" name="email" 
                                           value="{{ old('email') }}" required>
                                </div>
                            </div>

                            <!-- Ubicación -->
                            <div class="row g-3 mb-4">
                                <div class="col-12">
                                    <h5 class="text-gold mb-3">
                                        <i class="fas fa-map-marker-alt me-2"></i>Ubicación
                                    </h5>
                                </div>

                                <div class="col-12">
                                    <label for="address" class="form-label">Dirección *</label>
                                    <input type="text" class="form-control form-control-elegant" id="address" name="address" 
                                           value="{{ old('address') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="city" class="form-label">Ciudad *</label>
                                    <input type="text" class="form-control form-control-elegant" id="city" name="city" 
                                           value="{{ old('city', 'Santiago') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="state" class="form-label">Región *</label>
                                    <input type="text" class="form-control form-control-elegant" id="state" name="state" 
                                           value="{{ old('state', 'Región Metropolitana') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="latitude" class="form-label">Latitud</label>
                                    <input type="number" step="any" class="form-control form-control-elegant" id="latitude" name="latitude" 
                                           value="{{ old('latitude', '-33.4489') }}">
                                    <small class="text-muted">Ejemplo: -33.4489</small>
                                </div>

                                <div class="col-md-6">
                                    <label for="longitude" class="form-label">Longitud</label>
                                    <input type="number" step="any" class="form-control form-control-elegant" id="longitude" name="longitude" 
                                           value="{{ old('longitude', '-70.6693') }}">
                                    <small class="text-muted">Ejemplo: -70.6693</small>
                                </div>
                            </div>

                            <!-- Horarios -->
                            <div class="row g-3 mb-4">
                                <div class="col-12">
                                    <h5 class="text-gold mb-3">
                                        <i class="fas fa-clock me-2"></i>Horarios de Atención
                                    </h5>
                                </div>

                                @php
                                    $dias = ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'];
                                    $horariosDefault = [
                                        'lunes' => '8:00 - 20:00',
                                        'martes' => '8:00 - 20:00',
                                        'miércoles' => '8:00 - 20:00',
                                        'jueves' => '8:00 - 20:00',
                                        'viernes' => '8:00 - 20:00',
                                        'sábado' => '9:00 - 18:00',
                                        'domingo' => 'Cerrado'
                                    ];
                                @endphp

                                @foreach($dias as $dia)
                                    <div class="col-md-6">
                                        <label for="opening_hours_{{ $dia }}" class="form-label text-capitalize">{{ $dia }}</label>
                                        <input type="text" class="form-control form-control-elegant" 
                                               id="opening_hours_{{ $dia }}" 
                                               name="opening_hours[{{ $dia }}]" 
                                               value="{{ old('opening_hours.' . $dia, $horariosDefault[$dia]) }}" 
                                               placeholder="8:00 - 20:00 o Cerrado">
                                    </div>
                                @endforeach
                            </div>

                            <!-- Imágenes -->
                            <div class="row g-3 mb-4">
                                <div class="col-12">
                                    <h5 class="text-gold mb-3">
                                        <i class="fas fa-image me-2"></i>Imágenes
                                    </h5>
                                </div>

                                <div class="col-md-6">
                                    <label for="logo" class="form-label">Logo</label>
                                    <input type="file" class="form-control form-control-elegant" id="logo" name="logo" accept="image/*">
                                    <small class="text-muted">Formato: JPG, PNG. Tamaño máx: 2MB</small>
                                </div>

                                <div class="col-md-6">
                                    <label for="cover_image" class="form-label">Imagen de Portada</label>
                                    <input type="file" class="form-control form-control-elegant" id="cover_image" name="cover_image" accept="image/*">
                                    <small class="text-muted">Formato: JPG, PNG. Tamaño máx: 2MB</small>
                                </div>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="d-flex gap-3 justify-content-end pt-3 border-top">
                                <a href="{{ route('dueno.dashboard') }}" class="btn btn-outline-gold px-4">
                                    <i class="fas fa-times me-2"></i>Cancelar
                                </a>
                                <button type="submit" class="btn btn-gold px-4">
                                    <i class="fas fa-save me-2"></i>Crear Cafetería
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
