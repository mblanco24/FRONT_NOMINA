@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Reporte de Transporte (Entrada/Salida)</h1>

    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            Filtros
        </div>
        <div class="card-body">
            <form action="{{ route('transporte.index') }}" method="GET">
                <div class="row align-items-end">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Fecha:</label>
                        <input type="date" class="form-control"  name="date" >
                    </div>
                    <div class="col-md-4 mb-3">
                        <button type="submit" class="btn btn-primary">Aplicar Filtro</button>
                        <a href="{{ route('transporte.index') }}" class="btn btn-secondary">Limpiar Filtro</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-dark text-white">
            Registros de Transporte
        </div>
        <div class="card-body">
                
        </div>
    </div>
@endsection
