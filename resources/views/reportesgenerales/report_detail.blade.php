@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="{{ route('reportesgenerales.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Volver a Reportes Generales
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ $report_title }}</h4>
        </div>
        <div class="card-body">
            @if ($type == 'antiguedad')
                <h5>Empleados y su Antigüedad</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Empleado</th>
                                <th>Fecha de Ingreso</th>
                                <th>Antigüedad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report_data as $employee)
                                <tr>
                                    <td>{{ $employee['name'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($employee['hire_date'])->format('d/m/Y') }}</td>
                                    <td>{{ $employee['antiquity'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @elseif ($type == 'vacaciones')
                <h5>Días de Vacaciones Consumidos</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Empleado</th>
                                <th>Días 2024</th>
                                <th>Días 2023</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report_data as $vacation)
                                <tr>
                                    <td>{{ $vacation['name'] }}</td>
                                    <td>{{ $vacation['days_taken_2024'] }}</td>
                                    <td>{{ $vacation['days_taken_2023'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @elseif ($type == 'organizacion')
                <h5>Estructura Organizacional</h5>
                <p><strong>Departamentos:</strong></p>
                <ul>
                    @foreach ($report_data['departments'] as $dept)
                        <li>{{ $dept }} (Empleados: {{ $report_data['employees_per_dept'][$dept] ?? 'N/A' }})</li>
                    @endforeach
                </ul>
            @elseif ($type == 'movimientos')
                <h5>Últimos Movimientos de Personal</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Empleado</th>
                                <th>Fecha</th>
                                <th>Notas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report_data as $movement)
                                <tr>
                                    <td>{{ $movement['type'] }}</td>
                                    <td>{{ $movement['employee'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($movement['date'])->format('d/m/Y') }}</td>
                                    <td>{{ $movement['notes'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning" role="alert">
                    No se encontraron datos para este tipo de reporte.
                </div>
            @endif
        </div>
    </div>
@endsection
