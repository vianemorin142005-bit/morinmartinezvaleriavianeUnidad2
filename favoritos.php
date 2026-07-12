<?php
require_once 'config/security.php';
require_once 'config/session.php';
require_once 'config/csrf.php';

if (!isset($_SESSION['sessionstatus'])){
header("Location: index.php");
exit();
}else{
    
}
?>
<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Favoritos</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f5f5f5;
}

.navbar{
    background:#1f1cff;
}

.card{

transition:.3s;

height:100%;

}

.card:hover{

transform:translateY(-8px);

}

.card img{

height:220px;

object-fit:contain;

padding:15px;

}

</style>

</head>

<body>

 <?php include 'header.php'; ?>

<div class="container mt-5">

<h2 class="text-center mb-4">

❤️ Mis Favoritos

</h2>

<div class="row" id="contenedor">

</div>

</div>

<script>

let favoritos = JSON.parse(localStorage.getItem("favoritos")) || [];

const contenedor = document.getElementById("contenedor");

function mostrarFavoritos(){

contenedor.innerHTML="";

if(favoritos.length==0){

contenedor.innerHTML=`

<div class="col-12">

<div class="alert alert-warning text-center">

No tienes productos favoritos.

</div>

</div>

`;

return;

}

favoritos.forEach((producto,index)=>{

contenedor.innerHTML +=`

<div class="col-md-4 mb-4">

<div class="card shadow h-100">

<img src="${producto.imagen}" class="card-img-top">

<div class="card-body text-center">

<h5>${producto.nombre}</h5>

<h4 class="text-primary">

${producto.precio}

</h4>

<button
class="btn btn-outline-danger w-100 mt-3"
onclick="eliminar(${index})">

Eliminar

</button>

</div>

</div>

</div>

`;

});

}

function eliminar(index){

favoritos.splice(index,1);

localStorage.setItem("favoritos",JSON.stringify(favoritos));

mostrarFavoritos();

}

function limpiarFavoritos(){

if(confirm("¿Eliminar todos los favoritos?")){

localStorage.removeItem("favoritos");

favoritos=[];

mostrarFavoritos();

}

}

mostrarFavoritos();

</script>

</body>

</html>