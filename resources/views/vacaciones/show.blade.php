@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="{{ route('vacaciones.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Volver a Gestión de Vacaciones
            </a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Vacaciones de {{ $employee['full_name'] }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Antigüedad:</strong>
                        {{ $employee['antiquity']['years'] }} años,
                        {{ $employee['antiquity']['months'] }} meses,
                        {{ $employee['antiquity']['days'] }} días
                    </p>
                    <p><strong>Días de Vacaciones Disponibles:</strong>
                        <span class="badge bg-info">{{ $employee['remaining_vacation_days'] }} días</span>
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Últimas Vacaciones Tomadas:</strong>
                        @if ($lastVacation)
                            Del {{ \Carbon\Carbon::parse($lastVacation['start_date'])->format('d/m/Y') }} al {{ \Carbon\Carbon::parse($lastVacation['end_date'])->format('d/m/Y') }}
                            ({{ $lastVacation['days_taken'] }} días)
                        @else
                            <span class="text-muted">No ha tomado vacaciones registradas.</span>
                        @endif
                    </p>
                    <p><strong>Próxima Asignación (Estimada):</strong>
                        @if ($nextVacationAssignmentDate)
                            <span class="badge bg-success">{{ \Carbon\Carbon::parse($nextVacationAssignmentDate)->format('d/m/Y') }}</span>
                        @else
                            <span class="text-danger">Fecha de ingreso no disponible para cálculo.</span>
                        @endif
                        <small class="text-muted d-block mt-1">
                            (Se asignan anualmente a partir de su fecha de ingreso)
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Historial de Vacaciones Tomadas</h5>
        </div>
        <div class="card-body">
            @if (count($vacationRecords) > 0)
                <ul class="list-group list-group-flush">
                    @foreach ($vacationRecords as $record)
                        <li class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">
                                    Vacaciones del {{ \Carbon\Carbon::parse($record['start_date'])->format('d/m/Y') }} al {{ \Carbon\Carbon::parse($record['end_date'])->format('d/m/Y') }}
                                </h6>
                                <small class="text-muted">{{ $record['days_taken'] }} días</small>
                            </div>
                            <p class="mb-1 small">
                                Registrado por: {{ $record['approved_by_user_name'] ?? 'N/A' }} el {{ \Carbon\Carbon::parse($record['created_at'])->format('d/m/Y H:i') }}
                            </p>
                            @if ($record['notes'])
                                <p class="mb-0 small text-muted">Notas: {{ $record['notes'] }}</p>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="alert alert-warning" role="alert">
                    No hay historial de vacaciones para este empleado.
                </div>
            @endif
        </div>
    </div>
@endsection
