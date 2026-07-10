<?php
require_once 'config/security.php';
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cámara de Seguridad</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .producto-img{
            width: 100%;
            max-width: 320px;
            border-radius: 10px;
        }

        .precio-anterior{
            text-decoration: line-through;
            color: gray;
        }

        .precio-nuevo{
            color: green;
        }

        .info-box{
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>


<div class="container my-5">

    <div class="row align-items-center">

        <div class="col-md-5 text-center">
            <img src="https://http2.mlstatic.com/D_NQ_NP_728013-MLU70713816690_072023-O.webp"
                 class="producto-img shadow">
        </div>

       
        <div class="col-md-7">

            <h2>Cámara de Seguridad con alarma</h2>

            <p class="precio-anterior">$983.45</p>
            <h3 class="precio-nuevo">$297 MXN</h3>

            <div class="info-box">
                <h5>📌 Características</h5>
                <ul>
                    <li>Visión nocturna HD</li>
                    <li>Alarma integrada de seguridad</li>
                    <li>Conexión WiFi en tiempo real</li>
                    <li>Grabación en la nube</li>
                    <li>Detección de movimiento</li>
                </ul>
            </div>

            <div class="info-box">
                <h5>🚚 Envío</h5>
                <p>Entrega estimada: 3 a 5 días hábiles</p>
            </div>

            <div class="info-box">
                <h5>🛡 Garantía</h5>
                <p>Garantía de 12 meses por defecto de fábrica</p>
            </div>

        </div>

    </div>

</div>
</body>
</html>