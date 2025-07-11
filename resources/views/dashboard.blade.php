@extends('layouts.app') {{-- Esto extiende la plantilla app.blade.php --}}

@section('content')
    <div >
        <div class="h-100 p-5 bg-light border rounded-3">
            <h1 class="display-5 fw-bold">Bienvenido al Sistema de Nómina</h1>
            <p class="col-md-8 fs-4 mx-auto">Tu centro de control para la gestión de personal, pagos y reportes.</p>

            <a href="{{ route('employees.experiences') }}" class="btn btn-outline-secondary" type="button">Ver Empleados y sus Experiencias</a>
        </div>
    </div>

    <div class="row mt-5"> {{-- Añadido mt-5 para espacio superior --}}
        <div class="col-md-4">
            <div class="h-100 p-5 bg-light border rounded-3">
                <h2>Gestión de Personal</h2>
                <p>Administra la información de tus empleados, vacaciones, permisos y constancias.</p>
                {{-- Enlazar a la página principal de Gestión de Personal (ej. Listado de Empleados) --}}
                <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">Más Información</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="h-100 p-5 bg-light border rounded-3">
                <h2>Gestión de Pagos</h2>
                <p>Controla pagos por honorarios y metas. Genera reportes de nómina.</p>
                {{-- Enlazar a la página principal de Gestión de Pagos (ej. Listado de Honorarios) --}}
                <a href="{{ route('honorarios.index') }}" class="btn btn-outline-secondary">Más Información</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="h-100 p-5 bg-light border rounded-3">
                <h2>Administración del Sistema</h2>
                <p>Gestiona usuarios, roles y permisos de acceso al sistema.</p>
                {{-- Enlazar a la página principal de Administración del Sistema (ej. Listado de Usuarios) --}}
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Más Información</a>
            </div>
        </div>
    </div>
@endsection

{{-- Puedes agregar estilos personalizados aquí si no están en tu CSS global --}}
@push('styles')
<style>
    .jumbotron-custom {
        background-color: #e0f2f7; /* Un color de fondo suave */
        border-radius: 8px;
        margin-bottom: 2rem;
        padding: 3rem 0; /* Ajusta el padding para que no se vea tan pegado */
    }
    .jumbotron-custom h1 {
        color: #212529; /* Color de texto oscuro */
    }
    .jumbotron-custom p {
        color: #495057; /* Color de texto gris */
    }

    /* Estilo para el texto del botón principal en blanco */
    .btn-text-white {
        color: #ffffff !important; /* Usamos !important para asegurar que sobreescribe otros estilos */
    }
</style>
@endpush
