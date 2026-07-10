<?php
require_once 'config/security.php';
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iPhone 13 Pro Max</title>

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
            <img src="https://m.media-amazon.com/images/I/71eOlLE22YL.AC_UF894,1000_QL80.jpg"
                 class="producto-img shadow">
        </div>

        <div class="col-md-7">

            <h2>Apple iPhone 13 Pro Max 128GB</h2>

            <p class="precio-anterior">$13,586 MXN</p>
            <h3 class="precio-nuevo">$12,493 MXN</h3>

            <div class="info-box">
                <h5>📱 Características principales</h5>
                <ul>
                    <li>Pantalla Super Retina XDR de 6.7”</li>
                    <li>Chip A15 Bionic de alto rendimiento</li>
                    <li>Cámara triple de 12 MP</li>
                    <li>Modo noche y grabación en 4K</li>
                    <li>Face ID para seguridad</li>
                    <li>Almacenamiento 128GB</li>
                </ul>
            </div>

            <div class="info-box">
                <h5>🚚 Envío</h5>
                <p>Entrega estimada: 2 a 4 días hábiles</p>
            </div>

            <div class="info-box">
                <h5>🛡 Garantía</h5>
                <p>Garantía oficial de 12 meses por Apple</p>
            </div>

            <div class="info-box">
                <h5>📦 Incluye</h5>
                <p>Cable USB-C a Lightning, manual y caja original</p>
            </div>

        </div>

    </div>

</div>

</body>
</html>