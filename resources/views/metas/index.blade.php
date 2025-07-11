@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Gestión de Pagos por Metas</h1>

    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <span>Listado de Pagos por Metas</span>
            <button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#addMetaModal">
                <i class="fas fa-plus"></i> Registrar Meta
            </button>
        </div>
        <div class="card-body">
           
        </div>
    </div>

    {{-- Modal para Registrar Pago por Meta --}}
    <div class="modal fade" id="addMetaModal" tabindex="-1" aria-labelledby="addMetaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addMetaModalLabel">Registrar Pago por Meta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="employeeSelectMeta" class="form-label">Empleado:</label>
                            <select class="form-select" id="employeeSelectMeta" required>
                                <option value="">Seleccione un empleado...</option>
                                <option value="Ana Torres">Ana Torres</option>
                                <option value="Luis Méndez">Luis Méndez</option>
                                <option value="María López">María López</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="metaDescription" class="form-label">Descripción de la Meta:</label>
                            <input type="text" class="form-control" id="metaDescription" required>
                        </div>
                        <div class="mb-3">
                            <label for="metaAmount" class="form-label">Monto del Bono:</label>
                            <input type="number" step="0.01" class="form-control" id="metaAmount" required>
                        </div>
                        <div class="mb-3">
                            <label for="metaAchievementDate" class="form-label">Fecha de Logro:</label>
                            <input type="date" class="form-control" id="metaAchievementDate" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="alert('Simulación: Pago por meta registrado. (No se guarda en DB)')">Registrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
