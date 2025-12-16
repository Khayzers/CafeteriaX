@extends('layouts.app')

@section('title', 'Dashboard - Dueño')

@section('content')
<!-- Header del Dashboard -->
<section class="py-5" style="background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="text-white mb-2">
                    <i class="fas fa-chart-line text-gold me-3"></i>Dashboard de Dueño
                </h1>
                <p class="text-white opacity-75 mb-0 lead">
                    Bienvenido, <strong class="text-gold">{{ Auth::user()->name }}</strong>. Gestiona tus cafeterías desde aquí.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('dueno.cafeterias.create') }}" class="btn btn-gold">
                    <i class="fas fa-plus-circle me-2"></i>Nueva Cafetería
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Mis Cafeterías -->
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">
                <i class="fas fa-coffee text-gold me-2"></i>Mis Cafeterías
            </h2>
        </div>

        @if($cafeterias->count() > 0)
            <div class="row g-4">
                @foreach($cafeterias as $cafeteria)
                    <x-dueno-cafeteria-card :cafeteria="$cafeteria" />
                @endforeach
            </div>
        @else
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="fas fa-store fa-5x text-gold mb-4" style="opacity: 0.3;"></i>
                    <h3>No tienes cafeterías registradas</h3>
                    <p class="text-muted mb-4">Comienza agregando tu primera cafetería para gestionar menús e inventario.</p>
                    <a href="#" class="btn btn-gold btn-lg">
                        <i class="fas fa-plus-circle me-2"></i>Agregar Mi Primera Cafetería
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Acciones Rápidas -->
<section class="py-5 bg-light">
    <div class="container">
        <h3 class="mb-4">
            <i class="fas fa-bolt text-gold me-2"></i>Acciones Rápidas
        </h3>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-plus-circle fa-3x text-gold mb-3"></i>
                        <h5>Agregar Item al Menú</h5>
                        <p class="text-muted small">Añade nuevos productos a tus menús</p>
                        <a href="#" class="btn btn-outline-gold btn-sm">Agregar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-warehouse fa-3x text-gold mb-3"></i>
                        <h5>Actualizar Inventario</h5>
                        <p class="text-muted small">Gestiona el stock de tus productos</p>
                        <a href="#" class="btn btn-outline-gold btn-sm">Gestionar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-chart-bar fa-3x text-gold mb-3"></i>
                        <h5>Ver Estadísticas</h5>
                        <p class="text-muted small">Analiza el rendimiento de tus cafeterías</p>
                        <a href="#" class="btn btn-outline-gold btn-sm">Ver Reportes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
