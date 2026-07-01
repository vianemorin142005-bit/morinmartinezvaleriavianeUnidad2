<?php
require 'db.php';

$sql = "SELECT * FROM contacto";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$mensajes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buzón de Mensajes</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background-color:#f4f6f9;
        }

        .contenedor{
            max-width:1200px;
            margin:auto;
            margin-top:40px;
        }

        .card-buzon{
            border:none;
            border-radius:20px;
        }

        .table th{
            background:#1f1cff;
            color:white;
        }

        .badge-pendiente{
            background:#ffc107;
            color:black;
        }

        .badge-atendido{
            background:#198754;
            color:white;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #1f1cff;">
    <div class="container-fluid">

     
        <a class="navbar-brand fw-bold fs-4" href="#">
            🛒 Online Store
        </a>

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

      
            <ul class="navbar-nav me-4">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>

        <div class="ms-auto d-flex align-items-center gap-3">

                <a href="registro.php" class="nav-link text-white">
                    Crear Cuenta
                </a>

                <a href="login.php" class="nav-link text-white">
                    Ingresar
                </a>

            </div>

       
    </div>
</nav>

<div class="container contenedor">

    <div class="card shadow card-buzon">
        <div class="card-body p-4">

            <h2 class="text-center mb-4">
                📬 Buzón de Mensajes
            </h2>

            <div class="table-responsive">

                <table class="table table-hover table-bordered align-middle">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Asunto</th>
                            <th>Mensaje</th>
                            <th>Estado</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if(count($mensajes) > 0): ?>

                        <?php foreach($mensajes as $fila): ?>

                            <tr>

                                <td>
                                    <?php echo $fila["id"]; ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($fila["nombre"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($fila["correo"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($fila["asunto"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($fila["mensaje"]); ?>
                                </td>

                               

                                <td>

                                    <?php if($fila["estado"] == "Pendiente"): ?>

                                        <span class="badge badge-pendiente">
                                            Pendiente
                                        </span>

                                    <?php else: ?>

                                        <span class="badge badge-atendido">
                                            Atendido
                                        </span>

                                    <?php endif; ?>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="7" class="text-center">
                                No hay mensajes registrados.
                            </td>
                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>



</body>
</html>