<?php
require_once 'config/security.php';
require_once 'config/session.php';
require_once 'config/csrf.php';
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

 <?php include 'header.php'; ?>

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