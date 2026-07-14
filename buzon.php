<?php

require_once 'config/security.php';
require_once 'config/session.php';
require_once 'config/logger.php';
require 'db.php';


// VALIDAR ADMIN

if (!isset($_SESSION["rol"]) || $_SESSION["rol"] != "admin") {

    header("Location: index.php");
    exit();

}



// ==================================
// CAMBIAR ESTADO DEL MENSAJE
// ==================================

if(isset($_GET["cambiar_estado"])) {


    $id = (int)$_GET["id"];

    $estado = $_GET["estado"] ?? "";



    if($id > 0 && ($estado == "Pendiente" || $estado == "Atendido")) {



        $sql = "UPDATE contacto
                SET estado = ?
                WHERE id = ?";


        $stmt = $pdo->prepare($sql);


        $stmt->execute([
            $estado,
            $id
        ]);



        securityLog(
            "INFO",
            "Cambió el estado del mensaje #".$id." a ".$estado
        );


    }


    header("Location: buzon.php");

    exit();

}



// ==================================
// CONSULTAR MENSAJES
// ==================================


$sql = "SELECT * FROM contacto ORDER BY id DESC";


$stmt = $pdo->prepare($sql);

$stmt->execute();


$mensajes = $stmt->fetchAll(PDO::FETCH_ASSOC);




// ==================================
// CONTADORES
// ==================================

$total = count($mensajes);

$atendidos = 0;

$pendientes = 0;



foreach($mensajes as $m){


    if(strtolower(trim($m["estado"])) == "atendido"){

        $atendidos++;

    }
    else{

        $pendientes++;

    }

}


?>



<!DOCTYPE html>
<html lang="es">


<head>


<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Buzón de Mensajes</title>



<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>



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




.card-resumen{

    border:none;

    border-radius:20px;

    padding:20px;

    color:white;

}



.total{

    background:white;
    color:#333;
    border-left: 6px solid #1f1cff;

}



.atendido{

    background:white;
    color:#333;
    border-left: 6px solid #198754;

}



.pendiente{

    background:white;
    color:#333;
    border-left: 6px solid #ffc107;

}




.numero{

    font-size:35px;

    font-weight:bold;

}




.table th{

    background:#1f1cff;

    color:white;

}



.badge-pendiente{

    background:#ffc107;

    color:black;

    padding:8px;

    border-radius:10px;

}



.badge-atendido{

    background:#198754;

    color:white;

    padding:8px;

    border-radius:10px;

}
    .btn-estado{

    width:35px;
    height:35px;
    border-radius:50%;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    font-size:18px;

}
.btn-accion{

    width:38px;
    height:38px;
    border-radius:50%;
    display:inline-flex;
    justify-content:center;
    align-items:center;
    font-size:18px;
    padding:0;

}


</style>


</head>



<body>


<?php include 'header.php'; ?>


<div class="container contenedor">


<h2 class="text-center mb-4">
📬 Buzón de Mensajes
</h2>



<!-- CARDS -->

<div class="row mb-4">


<div class="col-md-4">

<div class="card card-resumen total shadow">

<h5>
Total mensajes
</h5>

<div class="numero">
<?= $total ?>
</div>

</div>

</div>




<div class="col-md-4">

<div class="card card-resumen atendido shadow">

<h5>
Atendidos
</h5>

<div class="numero">
<?= $atendidos ?>
</div>

</div>

</div>




<div class="col-md-4">

<div class="card card-resumen pendiente shadow">

<h5>
Pendientes
</h5>

<div class="numero">
<?= $pendientes ?>
</div>

</div>

</div>


</div>






<div class="card shadow card-buzon">


<div class="card-body p-4">


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

<th>Acción</th>

</tr>


</thead>



<tbody>



<?php if(count($mensajes)>0): ?>


<?php foreach($mensajes as $fila): ?>


<tr>



<td>
<?= $fila["id"]; ?>
</td>



<td>
<?= htmlspecialchars($fila["nombre"]); ?>
</td>



<td>
<?= htmlspecialchars($fila["correo"]); ?>
</td>



<td>
<?= htmlspecialchars($fila["asunto"]); ?>
</td>



<td>
<?= htmlspecialchars($fila["mensaje"]); ?>
</td>





<!-- ESTADO -->

<td>


<?php if(strtolower(trim($fila["estado"])) == "atendido"): ?>


<span class="badge badge-atendido">

🟢 Atendido

</span>



<?php else: ?>


<span class="badge badge-pendiente">

🟡 Pendiente

</span>



<?php endif; ?>


</td>





<!-- ACCION -->

<td class="text-center">



<?php if(strtolower(trim($fila["estado"])) == "atendido"): ?>


<a href="buzon.php?cambiar_estado=1&id=<?= $fila['id']; ?>&estado=Pendiente"



title="Cambiar a pendiente">


↩️


</a>




<?php else: ?>


<a href="buzon.php?cambiar_estado=1&id=<?= $fila['id']; ?>&estado=Atendido"



title="Marcar como atendido">


✅


</a>




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