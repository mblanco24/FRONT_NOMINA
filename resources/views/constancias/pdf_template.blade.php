
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Constancia de Trabajo</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .header { text-align: center; margin-bottom: 30px; }
        .title { font-size: 18px; font-weight: bold; }
        .content { margin: 40px 0; }
        .footer { margin-top: 50px; text-align: right; }
        .signature { margin-top: 80px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">CONSTANCIA DE TRABAJO</div>
        <div>N° {{ $constancia['id'] }}</div>
    </div>

    <div class="content">
        <p>A QUIEN CORRESPONDA:</p>

        <p>Por medio de la presente hacemos constar que el(la) Sr(a). <strong>{{ $constancia['employee_name'] }}</strong>
        labora en nuestra empresa bajo el puesto de {{ $constancia['type'] }}.</p>

        <p>{{ $constancia['contenido'] }}</p>

        <p>Esta constancia es expedida a solicitud del interesado para los fines que estime conveniente.</p>
    </div>

    <div class="footer">
        <div>Caracas, {{ $constancia['fecha'] }}</div>
        <div class="signature">
            <p>_________________________</p>
            <p>Nombre del Responsable</p>
            <p>Gerente de Recursos Humanos</p>
        </div>
    </div>
</body>
</html>
