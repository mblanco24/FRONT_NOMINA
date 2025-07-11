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
                        <p><strong>Nombre:</strong> <span id="employeeDetailName"></span></p>
                        <p><strong>Cédula:</strong> <span id="employeeDetailCedula"></span></p>
                        <p><strong>Cargo:</strong> <span id="employeeDetailPosition"></span></p>
                        <p><strong>Departamento:</strong> <span id="employeeDetailDepartment"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Email:</strong> <span id="employeeDetailEmail"></span></p>
                        <p><strong>Teléfono:</strong> <span id="employeeDetailPhone"></span></p>
                        <p><strong>Fecha de Ingreso:</strong> <span id="employeeDetailHireDate"></span></p>
                    </div>
                </div>

                <hr>

                <h6>Recibos de Pago</h6>
                <div id="employeePayStubs" class="mt-3">
                    <!-- Los recibos se cargarán aquí dinámicamente -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
