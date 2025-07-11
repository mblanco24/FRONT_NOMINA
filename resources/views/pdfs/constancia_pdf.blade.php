<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constancia de Trabajo - {{ $employee->full_name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            line-height: 1.6;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 50px;
        }
        .header h1 {
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 0.9em;
            color: #555;
        }
        .content {
            margin-top: 30px;
            text-align: justify;
        }
        .signature-block {
            margin-top: 80px;
            text-align: center;
        }
        .signature-line {
            border-top: 1px solid #ccc;
            width: 250px;
            margin: 0 auto 10px auto;
        }
        .footer {
            position: fixed;
            bottom: 30px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 0.8em;
            color: #777;
        }
        .date-location {
            text-align: right;
            margin-top: 40px;
            margin-bottom: 40px;
        }
        .highlight {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo de la Empresa" style="width: 150px; margin-bottom: 20px;">
        <h1>CONSTANCIA DE TRABAJO</h1>
        <p>RIF J-12345678-9</p>
        <p>Dirección: Calle Ficticia, Edificio Ejemplo, Ciudad, País.</p>
        <p>Teléfono: +XX XXX XXX XXXX | Email: info@empresa.com</p>
    </div>

    <div class="date-location">
        Caracas, {{ \Carbon\Carbon::now()->translatedFormat('d \d\e F \d\e Y') }}
    </div>

    <div class="content">
        <p>A quien pueda interesar:</p>

        <p>Por medio de la presente hacemos constar que el (la) ciudadano(a) <span class="highlight">{{ $employee->full_name }}</span>,
        titular de la Cédula de Identidad N° <span class="highlight">{{ $employee->id_number }}</span>,
        presta sus servicios en nuestra empresa <span class="highlight"> [Nombre de Tu Empresa] </span> desde el
        <span class="highlight">{{ \Carbon\Carbon::parse($employee->hire_date)->format('d \d\e F \d\e Y') }}</span> hasta la presente fecha,
        desempeñando el cargo de <span class="highlight">{{ $employee->position }}</span> en el departamento de <span class="highlight">{{ $employee->department }}</span>.</p>

        <p>Durante su permanencia en nuestra empresa, el (la) Sr(a). <span class="highlight">{{ $employee->full_name }}</span> ha demostrado
        responsabilidad, eficiencia y compromiso en las funciones que le han sido asignadas.</p>

        <p>Se emite la presente constancia a solicitud de parte interesada, en la ciudad de Caracas, a los
        {{ \Carbon\Carbon::now()->day }} días del mes de {{ \Carbon\Carbon::now()->translatedFormat('F') }} de {{ \Carbon\Carbon::now()->year }}.</p>
    </div>

    <div class="signature-block">
        <div class="signature-line"></div>
        <p>______________________________</p>
        <p><span class="highlight">[Nombre del Representante de RRHH/Gerencia]</span></p>
        <p>Cargo: [Cargo del Representante]</p>
        <p>[Nombre de Tu Empresa]</p>
    </div>

    <div class="footer">
        Este documento ha sido generado automáticamente por el Sistema de Nómina.
    </div>
</body>
</html>
