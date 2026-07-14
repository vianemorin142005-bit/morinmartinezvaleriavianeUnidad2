<?php
require_once 'config/security.php';
require_once 'config/session.php';
require_once 'config/csrf.php';
require_once 'db.php';

// Totales
$totalVisitas = $pdo->query("SELECT COUNT(*) FROM access_log")->fetchColumn();
$totalAtaques = $pdo->query("SELECT COUNT(*) FROM security_log")->fetchColumn();
$totalActividad = $pdo->query("SELECT COUNT(*) FROM audit_log")->fetchColumn();
$totalErrores = $pdo->query("SELECT COUNT(*) FROM error_log")->fetchColumn();



$actividad = $pdo->query("
    SELECT *
    FROM audit_log
    ORDER BY fecha DESC
    LIMIT 50
")->fetchAll(PDO::FETCH_ASSOC);

$ataques = $pdo->query("
    SELECT *
    FROM security_log
    ORDER BY fecha DESC
    LIMIT 20
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Centro de Monitoreo</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

    background:#f4f6f9;

}

.card{

    border:none;
    border-radius:15px;

}

</style>

</head>

<body>

<?php include 'header.php'; ?>


<div class="container contenedor">

<h2 class="mb-4">
🛡 Centro de Monitoreo
</h2>

<div class="row">

<div class="col-md-3">

<div class="card shadow">

<div class="card-body text-center">

<h5>Visitas</h5>

<h2><?= $totalVisitas ?></h2>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card shadow">

<div class="card-body text-center">

<h5>Actividad</h5>

<h2><?= $totalActividad ?></h2>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card shadow">

<div class="card-body text-center">

<h5>Ataques</h5>

<h2><?= $totalAtaques ?></h2>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card shadow">

<div class="card-body text-center">

<h5>Errores</h5>

<h2><?= $totalErrores ?></h2>

</div>

</div>

</div>

</div>

<hr>



<h4>📋 Actividad del Sistema</h4>

<table class="table table-striped">

<thead>

<tr>

<th>Usuario</th>

<th>Tipo</th>

<th>Acción</th>

<th>Página</th>

<th>IP</th>

<th>Fecha</th>

</tr>

</thead>

<tbody>

<?php foreach($actividad as $a): ?>

<tr>

<td><?= htmlspecialchars($a['nombre_usuario']) ?></td>

<td>

<?php

switch($a['tipo']){

    case "INFO":
        echo '<span class="badge bg-primary">INFO</span>';
    break;

    case "WARNING":
        echo '<span class="badge bg-warning text-dark">WARNING</span>';
    break;

    case "ATTACK":
        echo '<span class="badge bg-danger">ATTACK</span>';
    break;

    default:
        echo '<span class="badge bg-secondary">'.$a['tipo'].'</span>';

}

?>

</td>

<td><?= htmlspecialchars($a['accion']) ?></td>

<td><?= htmlspecialchars($a['pagina']) ?></td>

<td><?= htmlspecialchars($a['ip']) ?></td>

<td><?= htmlspecialchars($a['fecha']) ?></td>

</tr>

<?php endforeach; ?>

</tbody>

</table>
    
<h4>Intentos de ataque</h4>

<table class="table table-bordered">

<thead>

<tr>

<th>Tipo</th>

<th>Descripción</th>

<th>IP</th>

<th>Fecha</th>

</tr>

</thead>

<tbody>

<?php foreach($ataques as $a): ?>

<tr>

<td><?= htmlspecialchars($a['tipo']) ?></td>

<td><?= htmlspecialchars($a['descripcion']) ?></td>

<td><?= htmlspecialchars($a['ip']) ?></td>

<td><?= htmlspecialchars($a['fecha']) ?></td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</body>

</html>
