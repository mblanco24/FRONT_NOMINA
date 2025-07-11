@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Gestión de Pagos por Honorarios</h1>

    <div class="card">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <span>Listado de Honorarios</span>
            <button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#addHonorarioModal">
                <i class="fas fa-plus"></i> Registrar Honorario
            </button>
        </div>
        <div class="card-body">
           
        </div>
    </div>

    {{-- Modal para Registrar Honorario --}}
    <div class="modal fade" id="addHonorarioModal" tabindex="-1" aria-labelledby="addHonorarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="addHonorarioModalLabel">Registrar Nuevo Honorario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="employeeSelectHonorario" class="form-label">Empleado:</label>
                            <select class="form-select" id="employeeSelectHonorario" required>
                                <option value="">Seleccione un empleado...</option>
                                <option value="Roberto Sánchez">Roberto Sánchez</option>
                                <option value="Daniela Rojas">Daniela Rojas</option>
                                <option value="Sofía Gallardo">Sofía Gallardo</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="honorarioDescription" class="form-label">Descripción:</label>
                            <input type="text" class="form-control" id="honorarioDescription" required>
                        </div>
                        <div class="mb-3">
                            <label for="honorarioAmount" class="form-label">Monto:</label>
                            <input type="number" step="0.01" class="form-control" id="honorarioAmount" required>
                        </div>
                        <div class="mb-3">
                            <label for="honorarioPaymentDate" class="form-label">Fecha de Pago:</label>
                            <input type="date" class="form-control" id="honorarioPaymentDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="honorarioInvoice" class="form-label">Número de Factura:</label>
                            <input type="text" class="form-control" id="honorarioInvoice">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-info" onclick="alert('Simulación: Honorario registrado. (No se guarda en DB)')">Registrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
