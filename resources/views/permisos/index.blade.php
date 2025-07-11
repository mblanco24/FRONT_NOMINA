@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Gestión de Permisos</h1>

    <div class="card">
        <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
            <span>Listado de Permisos</span>
            <button class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#requestPermitModal">
                <i class="fas fa-plus"></i> Solicitar Permiso
            </button>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Empleado</th>
                                <th>Tipo de Permiso</th>
                                <th>Fechas</th>
                                <th>Días</th>
                                <th>Estado</th>
                                <th>Solicitado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>



                        </tbody>
                    </table>
                </div>

                <div class="alert alert-info" role="alert">
                    No hay permisos registrados.
                </div>

        </div>
    </div>

    {{-- Modal para Solicitar Permiso --}}
    <div class="modal fade" id="requestPermitModal" tabindex="-1" aria-labelledby="requestPermitModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="requestPermitModalLabel">Solicitar Nuevo Permiso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                        <div class="mb-3">
                            <label for="employeeSelect" class="form-label">Empleado:</label>
                            <select class="form-select" id="employeeSelect" name="employee_name" required>
                                <option value="">Seleccione un empleado...</option>
                                {{-- Aquí cargarías los empleados de la base de datos --}}
                                <option value="Ana Torres">Ana Torres</option>
                                <option value="Luis Méndez">Luis Méndez</option>
                                <option value="María López">María López</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="permitType" class="form-label">Tipo de Permiso:</label>
                            <select class="form-select" id="permitType" name="type" required>
                                <option value="">Seleccione el tipo...</option>
                                <option value="Día Personal">Día Personal</option>
                                <option value="Cita Médica">Cita Médica</option>
                                <option value="Asunto Familiar">Asunto Familiar</option>
                                <option value="Estudios">Estudios</option>
                                <option value="Luto">Luto</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="permitStartDate" class="form-label">Fecha de Inicio:</label>
                                <input type="date" class="form-control" id="permitStartDate" name="start_date" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="permitEndDate" class="form-label">Fecha de Fin:</label>
                                <input type="date" class="form-control" id="permitEndDate" name="end_date" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="permitNotes" class="form-label">Notas (Opcional):</label>
                            <textarea class="form-control" id="permitNotes" name="notes" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-warning">Solicitar</button>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function updatePermitStatus(id, status) {
        if (confirm('¿Está seguro de cambiar el estado del permiso a ' + status + '?')) {
            // Aquí enviarías una solicitud AJAX a Laravel
            // Para fines de simulación, simplemente mostramos una alerta
            alert('Simulación: Permiso ID ' + id + ' cambiado a ' + status + '. (Se debería hacer una llamada AJAX a ' + '{{ url("permisos") }}/' + id + '/status' + ')');

            // En un entorno real, harías algo como esto:
            // fetch('{{ url("permisos") }}/' + id + '/status', {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/json',
            //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
            //     },
            //     body: JSON.stringify({ status: status })
            // })
            // .then(response => response.json())
            // .then(data => {
            //     if (data.success) {
            //         alert('Estado actualizado con éxito.');
            //         location.reload(); // Recargar la página para ver el cambio
            //     } else {
            //         alert('Error al actualizar el estado.');
            //     }
            // })
            // .catch(error => {
            //     console.error('Error:', error);
            //     alert('Error de conexión.');
            // });
        }
    }
</script>
@endpush
