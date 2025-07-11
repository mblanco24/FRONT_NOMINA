@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="{{ route('permisos.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Volver a Gestión de Permisos
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Detalle del Permiso #{{ $permiso['id'] }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Empleado:</strong> {{ $permiso['employee_name'] }}</p>
                    <p><strong>Tipo de Permiso:</strong> {{ $permiso['type'] }}</p>
                    <p><strong>Fecha de Inicio:</strong> {{ \Carbon\Carbon::parse($permiso['start_date'])->format('d/m/Y') }}</p>
                    <p><strong>Fecha de Fin:</strong> {{ \Carbon\Carbon::parse($permiso['end_date'])->format('d/m/Y') }}</p>
                    <p><strong>Días Solicitados:</strong> {{ $permiso['days'] }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Estado:</strong>
                        <span class="badge bg-{{ $permiso['status'] == 'Aprobado' ? 'success' : ($permiso['status'] == 'Pendiente' ? 'warning' : 'danger') }}">
                            {{ $permiso['status'] }}
                        </span>
                    </p>
                    <p><strong>Solicitado el:</strong> {{ $permiso['requested_at_formatted'] }}</p>
                    <p><strong>Aprobado/Gestionado por:</strong> {{ $permiso['approved_by'] ?? 'Pendiente' }}</p>
                    <p><strong>Notas:</strong> {{ $permiso['notes'] ?? 'N/A' }}</p>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-end">
                @if ($permiso['status'] == 'Pendiente')
                    <button class="btn btn-success me-2" onclick="updatePermitStatus({{ $permiso['id'] }}, 'Aprobado')">Aprobar</button>
                    <button class="btn btn-danger" onclick="updatePermitStatus({{ $permiso['id'] }}, 'Rechazado')">Rechazar</button>
                @else
                    <div class="alert alert-info mb-0">Este permiso ya ha sido {{ $permiso['status'] }}.</div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function updatePermitStatus(id, status) {
        if (confirm('¿Está seguro de cambiar el estado del permiso a ' + status + '?')) {
            // Simulación: Enviar un formulario para activar la lógica del controlador
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ url("permisos") }}/' + id + '/status';

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT'; // O PATCH, dependiendo de cómo lo definas en la ruta
            form.appendChild(methodInput);

            const statusInput = document.createElement('input');
            statusInput.type = 'hidden';
            statusInput.name = 'status';
            statusInput.value = status;
            form.appendChild(statusInput);

            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
@endpush
