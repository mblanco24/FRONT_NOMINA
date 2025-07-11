

document.addEventListener('DOMContentLoaded', function () {
    fetchEmployees();
    setupConstanciaModal();
    // Si quieres cargar las constancias inicialmente via JS:
    fetchConstancias();
});


// Obtener empleados desde la API
async function fetchEmployees() {
    try {
        const response = await fetch('https:/clever-lionfish-37.loca.lt/constancias');

        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status}`);
        }

        const employees = await response.json();
        renderEmployeeOptions(employees);
    } catch (error) {
        console.error('Error al obtener constancias:', error);
        showAlert('Error al cargar los constancias', 'danger');
    }
}

// Renderizar opciones de empleados en el select del modal
function renderEmployeeOptions(employees) {
    const select = document.getElementById('employeeSelect');

    // Limpiar opciones existentes excepto la primera
    while (select.options.length > 1) {
        select.remove(1);
    }

    // Agregar nuevas opciones
    employees.forEach(employee => {
        const option = document.createElement('option');
        option.value = employee.id;
        option.textContent = employee.name || `${employee.nombre} ${employee.apellido}`;
        select.appendChild(option);
    });
}

// Configurar eventos del modal de constancias
function setupConstanciaModal() {
    const form = document.querySelector('#requestConstanciaModal form');

    if (form) {
        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = {
                cedula_empleado: document.getElementById('cedula_empleado').value,
                tipo_constancia: document.getElementById('tipo_constancia').value,
                fecha_generacion: document.getElementById('fecha_generacion').value,
                // Puedes agregar más campos según necesites
            };

            try {
                const response = await fetch('https://clever-lionfish-37.loca.lt/constancias/new', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(formData)
                });

                if (!response.ok) {
                    throw new Error(`Error HTTP: ${response.status}`);
                }

                const result = await response.json();
                showAlert('Solicitud de constancia enviada con éxito', 'success');

                // Recargar la página para mostrar la nueva solicitud
                window.location.reload();

            } catch (error) {
                console.error('Error al enviar solicitud:', error);
                showAlert('Error al enviar la solicitud de constancia', 'danger');
            }
        });
    }
}

// Obtener constancias desde la API (opcional si quieres cargarlas via JS)
async function fetchConstancias() {
    try {
        const response = await fetch('https://clever-lionfish-37.loca.lt/constancias/');

        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status}`);
        }

        const constancias = await response.json();
        renderConstancias(constancias);
    } catch (error) {
        console.error('Error al obtener constancias:', error);
        showAlert('Error al cargar las constancias', 'danger');
    }
}

function renderConstancias(constancias) {
    const tbody = document.querySelector('.card-body tbody');

    if (!tbody) return;

    // Limpiar tabla
    tbody.innerHTML = '';

    if (constancias.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="7" class="text-center">
                    <div class="alert alert-info m-0">No hay solicitudes de constancias registradas</div>
                </td>
            </tr>
        `;
        return;
    }

    // Llenar tabla con las constancias
    constancias.forEach((constancia, index) => {
        const row = document.createElement('tr');

        row.innerHTML = `
            <td>${index + 1}</td>
            <td>${constancia.cedula_empleado}</td>
            <td>${constancia.tipo_constancia}</td>
            <td>${constancia.fecha_generacion || `${constancia.empleado_nombre} ${constancia.empleado_apellido}`}</td>
            <td>
                <button class="btn btn-sm btn-success btn-download"
                        data-id="${constancia.id}"
                        data-employee_name="${cedula_empleado} ${constancia.empleado_apellido}"
                        data-type="${constancia.tipo_constancia}"
                        data-contenido="Por medio de la presente hacemos constar que el(la) Sr(a). ${constancia.empleado_nombre} labora en nuestra empresa bajo el puesto de"
                        data-fecha="${new Date().toLocaleDateString('es-ES')}">
                    <i class="fas fa-download"></i> Descargar
                </button>
            </td>
        `;

        tbody.appendChild(row);
    });

    // Agregar event listeners a los botones de descarga
    setupDownloadButtons();
}


function setupDownloadButtons() {
    document.querySelectorAll('.btn-download').forEach(button => {
        button.addEventListener('click', function() {
            const data = {
                id: this.getAttribute('data-id'),
                employee_name: this.getAttribute('data-employee_name'),
                type: this.getAttribute('data-type'),
                contenido: this.getAttribute('data-contenido'),
                fecha: new Date().toLocaleDateString('es-ES', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                })
            };

            generatePDF(data);
        });
    });
}


async function generatePDF(data) {
    try {
        // Crear el HTML del PDF
        const html = `
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="UTF-8">
                <title>Constancia de ${data.type}</title>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; margin: 2cm; }
                    .header { text-align: center; margin-bottom: 30px; }
                    .title { font-size: 18px; font-weight: bold; text-decoration: underline; }
                    .content { margin: 40px 0; text-align: justify; }
                    .footer { margin-top: 50px; text-align: right; }
                    .signature { margin-top: 80px; border-top: 1px solid #000; width: 50%; float: right; padding-top: 10px; }
                </style>
            </head>
            <body>
                <div class="header">
                    <div class="title">CONSTANCIA DE ${data.type.toUpperCase()}</div>
                    <div>N° ${data.id}</div>
                </div>

                <div class="content">
                    <p>A QUIEN CORRESPONDA:</p>

                    <p>${data.contenido}</p>

                    <p>Esta constancia es expedida a solicitud del interesado para los fines que estime conveniente.</p>
                </div>

                <div class="footer">
                    <div>Caracas, ${data.fecha}</div>
                    <div class="signature">
                        <p>_________________________</p>
                        <p>Nombre del Responsable</p>
                        <p>Gerente de Recursos Humanos</p>
                    </div>
                </div>
            </body>
            </html>
        `;

        // Opciones para el PDF
        const opt = {
            margin: 10,
            filename: `constancia_${data.type.toLowerCase()}_${data.id}.pdf`,
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };

        // Generar PDF usando html2pdf.js
        const element = document.createElement('div');
        element.innerHTML = html;
        document.body.appendChild(element);

        await html2pdf().set(opt).from(element).save();

        document.body.removeChild(element);

    } catch (error) {
        console.error('Error al generar PDF:', error);
        showAlert('Error al generar el PDF', 'danger');
    }
}


document.addEventListener('DOMContentLoaded', function() {
    // Validación del formulario
    const form = document.getElementById('constanciaForm');

    form.addEventListener('submit', function(e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        form.classList.add('was-validated');
    });

    // Autocompletar nombre del empleado al ingresar cédula
    const cedulaInput = document.getElementById('cedula_empleado');
    cedulaInput.addEventListener('change', function() {
        // Aquí puedes agregar lógica para buscar el nombre del empleado
        // basado en la cédula ingresada (usando AJAX)
    });
});



document.getElementById('constanciaForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const formData = {
        cedula_empleado: document.getElementById('cedula_empleado').value,
        tipo_constancia: document.getElementById('tipo_constancia').value,
        contenido: document.getElementById('contenido').value,
        fecha_solicitud: document.getElementById('fecha_solicitud').value
    };

    try {
        const response = await fetch('/constancias/new', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(formData)
        });

        if (!response.ok) {
            throw new Error('Error en la solicitud');
        }

        const result = await response.json();
        alert('Constancia creada exitosamente');
        location.reload();
    } catch (error) {
        console.error('Error:', error);
        alert('Error al crear la constancia');
    }
});


// Función auxiliar para formatear fechas
function formatDate(dateString) {
    if (!dateString) return 'N/A';
    // Puedes mejorar este formateo según necesites
    return dateString;
}

// Determinar botones de acción según estado
function getActionButtons(status, constanciaId) {
    switch (status) {
        case 'Completada':
            return `
                <a href="/constancias/generatePdf/${constanciaId}"
                    class="btn btn-sm btn-outline-primary bg-primary text-white hover-bg-white hover-text-primary"
                    title="Descargar Constancia">
                    <i class="fas fa-download"></i> Descargar
                </a>
            `;
        case 'Pendiente':
            return `
                <button class="btn btn-sm btn-secondary" disabled title="Pendiente de Procesar">
                    <i class="fas fa-hourglass-half"></i> Procesando
                </button>
            `;
        case 'Rechazada':
            return `
                <button class="btn btn-sm btn-danger" disabled title="Solicitud Rechazada">
                    <i class="fas fa-times-circle"></i> Rechazada
                </button>
            `;
        default:
            return '';
    }
}

// Mostrar alertas
function showAlert(message, type) {
    // Verificar si ya existe una alerta para evitar duplicados
    const existingAlert = document.querySelector('.alert.alert-dismissible');
    if (existingAlert) {
        existingAlert.remove();
    }

    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.role = 'alert';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;

    const container = document.querySelector('.card-body');
    if (container) {
        container.insertBefore(alertDiv, container.firstChild);

        // Auto-ocultar después de 5 segundos
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alertDiv);
            bsAlert.close();
        }, 5000);
    }
}
