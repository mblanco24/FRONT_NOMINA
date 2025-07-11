@extends('layouts.app')

@section('content')
    <style>
        .is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875em;
        }
    </style>
    <h1 class="mb-4">Listado de Empleados</h1>

    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <span>Empleados registrados</span>
            <button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#empleadoDetalleModal"
                id="btnNuevoEmpleado">
                <i class="fas fa-plus"></i> Nuevo Empleado
            </button>
        </div>
        <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre Completo</th>
                                <th>Cargo</th>
                                <th>Departamento</th>
                                <th>Acciones</th>
                            </tr>

                        </thead>
                        <tbody id="cuerpoTablaEmpleados">
                        </tbody>
                    </table>
                </div>

                <div class="alert alert-info" role="alert">
                    No hay empleados registrados aún.
                </div>

        </div>
    </div>

    <div class="modal fade" id="empleadoDetalleModal" tabindex="-1" aria-labelledby="empleadoDetalleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="empleadoDetalleModalLabel">Registrar Nuevo Empleado</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formNuevoEmpleado" action="#" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="cedula" class="form-label">Cédula</label>
                        <input type="text" class="form-control" id="cedula" name="cedula"
                               pattern="[0-9]{1,15}" maxlength="15"
                               onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                        <small class="text-muted">Solo números, máximo 15 dígitos</small>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                               pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+"
                               onkeypress="return (event.charCode >= 65 && event.charCode <= 90) ||
                                              (event.charCode >= 97 && event.charCode <= 122) ||
                                              event.charCode == 32" required>
                        <small class="text-muted">No se permiten números</small>
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido"
                               pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+"
                               onkeypress="return (event.charCode >= 65 && event.charCode <= 90) ||
                                              (event.charCode >= 97 && event.charCode <= 122) ||
                                              event.charCode == 32" required>
                        <small class="text-muted">No se permiten números</small>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                               pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
                        <small class="text-muted">Ejemplo: usuario@dominio.com</small>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                        <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>
                    </div>
                    <div class="mb-3">
                        <label for="departamento" class="form-label">Departamento</label>
                        <select class="form-select" id="departamento" name="departamento" required>
                            <option value="">Seleccione...</option>
                            <option value="Tecnología">Tecnología</option>
                            <option value="Recursos Humanos">Recursos Humanos</option>
                            <option value="Contabilidad">Contabilidad</option>
                            <option value="Ventas">Ventas</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cargo" class="form-label">Cargo</label>
                        <input type="text" class="form-control" id="cargo" name="cargo" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipo_contrato" class="form-label">Tipo de Contrato</label>
                        <select class="form-select" id="tipo_contrato" name="tipo_contrato" required>
                            <option value="">Seleccione...</option>
                            <option value="Indefinido">Indefinido</option>
                            <option value="Temporal">Temporal</option>
                            <option value="Por Proyecto">Por Proyecto</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="salario_base" class="form-label">Salario Base</label>
                        <input type="number" class="form-control" id="salario_base" name="salario_base" required>
                    </div>
                    <div class="mb-3">
                        <label for="numero_cuenta" class="form-label">Número de Cuenta</label>
                        <input type="text" class="form-control" id="numero_cuenta" name="numero_cuenta"
                               pattern="[0-9]{1,20}" maxlength="20"
                               onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                        <small class="text-muted">Solo números, máximo 20 dígitos</small>
                    </div>
                    <div class="mb-3">
                        <label for="banco" class="form-label">Banco</label>
                        <select class="form-select" id="banco" name="banco" required>
                            <option value="">Seleccione...</option>
                            <option value="BBVA">BBVA</option>
                            <option value="Mercantil">Mercantil</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="guardarempleado" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal para detalles del empleado -->
<div class="modal fade" id="employeeDetailsModal" tabindex="-1" aria-labelledby="employeeDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="employeeDetailsModalLabel">Detalles del Empleado</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nombre:</strong> <span id="modalEmployeeName"></span></p>
                        <p><strong>Cédula:</strong> <span id="modalEmployeeCedula"></span></p>
                        <p><strong>Cargo:</strong> <span id="modalEmployeePosition"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Apellido:</strong> <span id="modalEmployeeape"></span></p>
                        <p><strong>Departamento:</strong> <span id="modalEmployeeDepartment"></span></p>
                    </div>
                </div>

                <!-- Puedes agregar más secciones según necesites -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para edición del empleado -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editEmployeeModalLabel">Editar Empleado</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditEmployee">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="edit_cedula" name="cedula">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="edit_apellido" name="apellido" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="edit_email" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_puesto" class="form-label">Cargo</label>
                                <input type="text" class="form-control" id="edit_puesto" name="puesto" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_departamento" class="form-label">Departamento</label>
                                <select class="form-select" id="edit_departamento" name="departamento" required>
                                    <option value="Tecnología">Tecnología</option>
                                    <option value="Recursos Humanos">Recursos Humanos</option>
                                    <option value="Contabilidad">Contabilidad</option>
                                    <option value="Ventas">Ventas</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit_salario_base" class="form-label">Salario Base</label>
                                <input type="number" class="form-control" id="edit_salario_base" name="salario_base" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <script src="{{ asset('js/empleados.js') }}"></script>
@endsection
