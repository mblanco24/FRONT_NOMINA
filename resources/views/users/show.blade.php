@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Volver a Gestión de Usuarios
            </a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Detalle del Usuario: {{ $user['full_name'] }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="{{ $user['photo_url'] }}" class="img-fluid rounded-circle mb-3" alt="Foto de Perfil" style="width: 150px; height: 150px; object-fit: cover;">
                    <h5>{{ $user['full_name'] }}</h5>
                    <p class="text-muted">{{ $user['position'] }}</p>
                    <span class="badge bg-{{ $user['is_active'] ? 'success' : 'danger' }}">{{ $user['is_active'] ? 'Activo' : 'Inactivo' }}</span>
                </div>
                <div class="col-md-8">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Usuario:</strong> {{ $user['username'] }}</li>
                        <li class="list-group-item"><strong>Email:</strong> {{ $user['email'] }}</li>
                        <li class="list-group-item"><strong>Departamento:</strong> {{ $user['department'] }}</li>
                        <li class="list-group-item"><strong>Rol:</strong> {{ $user['role'] }}</li>
                        <li class="list-group-item"><strong>Último Acceso:</strong> {{ $user['last_login_formatted'] }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    
@endsection
