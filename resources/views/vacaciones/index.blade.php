@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Gestión de Vacaciones</h1>

    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <span>Estado de Vacaciones por Empleado</span>
            <button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#assignVacationModal">
                <i class="fas fa-plus"></i> Asignar Días
            </button>
        </div>
        <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Empleado</th>
                                <th>Antigüedad</th>
                                <th>Días Disponibles</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>

                <div class="alert alert-info" role="alert">
                    No hay empleados registrados para gestionar vacaciones.
                </div>

        </div>
    </div>

    <div class="modal fade" id="assignVacationModal" tabindex="-1" aria-labelledby="assignVacationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="assignVacationModalLabel">Solicitud de Vacaciones</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="vacationForm">
                    <!-- Campo oculto para id_vacaciones -->
                    <input type="hidden" id="id_vacaciones" name="id_vacaciones" value="5">

                    <div class="mb-3">
                        <label for="cedula_empleado" class="form-label">Cédula del Empleado:</label>
                        <input type="text" class="form-control" id="cedula_empleado" name="cedula_empleado" value="26621298" required>
                    </div>

                    <div class="mb-3">
                        <label for="dias" class="form-label">Días de Vacaciones:</label>
                        <input type="number" class="form-control" id="dias" name="dias" value="15" min="1" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fecha_inicio" class="form-label">Fecha de Inicio:</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                        </div>
                        <div class="col-md-6">
                            <label for="fecha_fin" class="form-label">Fecha de Fin:</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_solicitud" class="form-label">Fecha de Solicitud:</label>
                        <input type="date" class="form-control" id="fecha_solicitud" name="fecha_solicitud" required>
                    </div>

                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado:</label>
                        <select class="form-select" id="estado" name="estado" required>
                            <option value="Pendiente" selected>Pendiente</option>
                            <option value="Aprobado">Aprobado</option>
                            <option value="Rechazado">Rechazado</option>
                        </select>
                    </div>

                    <div class="mb-3" id="aprobacionContainer" style="display: none;">
                        <label for="aprobado_por" class="form-label">Aprobado por (ID):</label>
                        <input type="number" class="form-control" id="aprobado_por" name="aprobado_por" value="35">
                        <label for="fecha_aprobacion" class="form-label mt-2">Fecha de Aprobación:</label>
                        <input type="date" class="form-control" id="fecha_aprobacion" name="fecha_aprobacion">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="confirmAssignVacation">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
// Script para manejar la visibilidad del campo de aprobación
document.addEventListener('DOMContentLoaded', function() {
    const estadoSelect = document.getElementById('estado');
    const aprobacionContainer = document.getElementById('aprobacionContainer');

    estadoSelect.addEventListener('change', function() {
        if (this.value === 'Aprobado') {
            aprobacionContainer.style.display = 'block';
        } else {
            aprobacionContainer.style.display = 'none';
        }
    });

    // Establecer fechas en formato adecuado para los inputs de fecha
    const fechaInicio = new Date('2025-06-15');
    const fechaFin = new Date('2025-07-01');
    const fechaSolicitud = new Date('2025-06-01');
    const fechaAprobacion = new Date('2025-06-02');

    document.getElementById('fecha_inicio').valueAsDate = fechaInicio;
    document.getElementById('fecha_fin').valueAsDate = fechaFin;
    document.getElementById('fecha_solicitud').valueAsDate = fechaSolicitud;
    document.getElementById('fecha_aprobacion').valueAsDate = fechaAprobacion;
});
</script>

    {{-- Modal para Registrar Vacaciones Tomadas por un Empleado --}}
    <div class="modal fade" id="takeVacationModal" tabindex="-1" aria-labelledby="takeVacationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="takeVacationModalLabel">Registrar Vacaciones Tomadas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Registrar las vacaciones que un empleado ha tomado.</p>
                    <form>
                        <input type="hidden" id="takeVacationEmployeeId">
                        <div class="mb-3">
                            <label for="takeVacationEmployeeName" class="form-label">Empleado:</label>
                            <input type="text" class="form-control" id="takeVacationEmployeeName" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="startDate" class="form-label">Fecha de Inicio:</label>
                            <input type="date" class="form-control" id="startDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="endDate" class="form-label">Fecha de Fin:</label>
                            <input type="date" class="form-control" id="endDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notas (Opcional):</label>
                            <textarea class="form-control" id="notes" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" id="confirmTakeVacation">Registrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

<script src="{{ asset('js/vacaciones.js') }}"></script>
@endpush
