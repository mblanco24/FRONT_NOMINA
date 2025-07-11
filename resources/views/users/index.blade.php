@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Gestión de Usuarios</h1>

    <div class="card">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <span>Listado de Usuarios</span>
            <button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="fas fa-plus"></i> Añadir Usuario
            </button>
        </div>
        <div class="card-body">
           
        </div>
    </div>

    {{-- Modal para Añadir Usuario --}}
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="addUserModalLabel">Añadir Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="newUsername" class="form-label">Usuario:</label>
                            <input type="text" class="form-control" id="newUsername" required>
                        </div>
                        <div class="mb-3">
                            <label for="newFullName" class="form-label">Nombre Completo:</label>
                            <input type="text" class="form-control" id="newFullName" required>
                        </div>
                        <div class="mb-3">
                            <label for="newEmail" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="newEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="newPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="newRole" class="form-label">Rol:</label>
                            <select class="form-select" id="newRole" required>
                                <option value="Empleado">Empleado</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Gerente RRHH">Gerente RRHH</option>
                                <option value="Admin Nómina">Admin Nómina</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="newDepartment" class="form-label">Departamento:</label>
                            <input type="text" class="form-control" id="newDepartment">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-dark" onclick="alert('Simulación: Usuario añadido. (No se guarda en DB)')">Guardar Usuario</button>
                </div>
            </div>
        </div>
    </div>
@endsection
