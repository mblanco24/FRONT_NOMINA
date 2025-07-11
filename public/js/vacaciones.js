let employees = [];
let vacations = [];

document.addEventListener('DOMContentLoaded', function () {
    fetchEmployees();
    setupModals();
});

// Obtener empleados desde la API
async function fetchEmployees() {
    try {
        const response = await fetch('https://backend-api.loca.lt/empleados/');

        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status}`);
        }

        employees = await response.json();
        console.log('Empleados obtenidos:', employees);
        renderEmployees(employees);
    } catch (error) {
        console.error('Error al obtener empleados:', error);
        showAlert('Error al cargar los empleados', 'danger');
    }
}

// Obtener vacaciones desde la API
async function fetchVacations() {
    try {
        const response = await fetch('https://backend-api.loca.lt/vacaciones/');

        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status}`);
        }

        vacations = await response.json();
        console.log('Vacaciones obtenidas:', vacations);
    } catch (error) {
        console.error('Error al obtener vacaciones:', error);
        showAlert('Error al cargar las vacaciones', 'danger');
    }
}

// Renderizar empleados en la tabla
function renderEmployees(employees) {
    const tableBody = document.querySelector('tbody');

    // Limpiar tabla
    tableBody.innerHTML = '';

    // Mostrar cada empleado
    employees.forEach((employee, index) => {
        const row = document.createElement('tr');

        // Calcular antigüedad
        const antiquity = calculateAntiquity(employee.fecha_ingreso);

        // Calcular días disponibles (aquí deberías integrar con los datos de vacaciones)
        const remainingDays = calculateRemainingVacationDays(employee.id);

        row.innerHTML = `
            <td>${index + 1}</td>
            <td>${employee.nombre} ${employee.apellido}</td>
            <td>
                ${antiquity.years} años,
                ${antiquity.months} meses,
                ${antiquity.days} días
            </td>
            <td>
                <span class="badge bg-${getBadgeColor(remainingDays)}">
                    ${remainingDays} días
                </span>
            </td>
            <td>
                <a href="/vacaciones/${employee.id}" class="btn btn-sm btn-info text-white" title="Ver Historial">
                    <i class="fas fa-calendar-alt"></i> Detalles
                </a>
                <button class="btn btn-sm btn-primary"
                        title="Registrar Vacaciones"
                        data-bs-toggle="modal"
                        data-bs-target="#takeVacationModal"
                        data-employee-id="${employee.id}"
                        data-employee-name="${employee.nombre} ${employee.apellido}">
                    <i class="fas fa-plus-circle"></i> Registrar
                </button>
            </td>
        `;

        tableBody.appendChild(row);
    });
}

// Configurar los modales
function setupModals() {
    // Modal para asignar días
    const assignVacationModal = new bootstrap.Modal(document.getElementById('assignVacationModal'));
    document.getElementById('confirmAssignVacation').addEventListener('click', async function () {
        const days = document.getElementById('dias').value;
        const assignTo = document.getElementById('cedula_empleado').value;



        try {
            const response = await fetch('https://backend-api.loca.lt/vacaciones/new', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    cedula_empleado: document.getElementById('cedula_empleado').value,
                    fecha_solicitud: document.getElementById('fecha_solicitud').value,
                    fecha_inicio: document.getElementById('fecha_inicio').value,
                    fecha_fin: document.getElementById('fecha_fin').value,
                    estado: 'Pendiente',
                    aprobado_por: null,
                    fecha_aprobacion: null,
                    dias: days,
                    empleado_id: assignTo

                })
            });

            if (!response.ok) {
                throw await response.json();
            }

            const data = await response.json();
            assignVacationModal.hide();
            showAlert(data.message || 'Días asignados correctamente', 'success');
            await fetchEmployees(); // Refrescar datos
        } catch (error) {
            console.error('Error al asignar vacaciones:', error);
            showAlert(error.message || 'Error al asignar días de vacaciones', 'danger');
        }
    });

    // Modal para registrar vacaciones tomadas
    const takeVacationModal = new bootstrap.Modal(document.getElementById('takeVacationModal'));
    const takeVacationEmployeeId = document.getElementById('takeVacationEmployeeId');
    const takeVacationEmployeeName = document.getElementById('takeVacationEmployeeName');

    document.getElementById('takeVacationModal').addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        takeVacationEmployeeId.value = button.getAttribute('data-employee-id');
        takeVacationEmployeeName.value = button.getAttribute('data-employee-name');
    });

    document.getElementById('confirmTakeVacation').addEventListener('click', async function () {
        const employeeId = takeVacationEmployeeId.value;
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        const notes = document.getElementById('notes').value;

        if (!startDate || !endDate) {
            showAlert('Por favor ingrese las fechas de inicio y fin', 'warning');
            return;
        }

        try {
            const response = await fetch('https://backend-api.loca.lt/vacaciones/registrar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    employee_id: employeeId,
                    start_date: startDate,
                    end_date: endDate,
                    notes: notes
                })
            });

            if (!response.ok) {
                throw await response.json();
            }

            const data = await response.json();
            takeVacationModal.hide();
            showAlert(data.message || 'Vacaciones registradas correctamente', 'success');
            await fetchEmployees(); // Refrescar datos
        } catch (error) {
            console.error('Error al registrar vacaciones:', error);
            showAlert(error.message || 'Error al registrar vacaciones', 'danger');
        }
    });
}

// Funciones auxiliares
function calculateAntiquity(startDate) {
    const now = new Date();
    const start = new Date(startDate);
    const diff = new Date(now - start);

    return {
        years: diff.getUTCFullYear() - 1970,
        months: diff.getUTCMonth(),
        days: diff.getUTCDate() - 1
    };
}

function calculateRemainingVacationDays(employeeId) {
    // Aquí deberías integrar con los datos reales de vacaciones
    const employeeVacations = vacations.filter(v => v.employee_id === employeeId);
    const assignedDays = 15; // Esto debería venir de la base de datos
    const takenDays = employeeVacations.reduce((sum, v) => sum + v.days_taken, 0);

    return assignedDays - takenDays;
}

function getBadgeColor(days) {
    return days > 10 ? 'success' : (days > 0 ? 'warning' : 'danger');
}

function showAlert(message, type) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;

    const cardBody = document.querySelector('.card-body');
    cardBody.prepend(alertDiv);

    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
}
