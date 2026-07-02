<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Ofertas del Día</title>

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

.card-body{
    display:flex;
    flex-direction:column;
    justify-content:space-between;
}

.animar{
    animation: aparecer .8s;
}
@keyframes aparecer{

from{

opacity:0;
transform:translateY(40px);

}

to{

opacity:1;
transform:translateY(0);

}

}

.animar{

animation:aparecer .8s;

}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark">

<div class="container">

<a class="navbar-brand" href="index.php">

🛒 Online Store

</a>

<a href="index.php" class="btn btn-light">

Regresar

</a>

</div>

</nav>

<div class="container mt-5">

<h2 class="text-center mb-4">

🔥 Ofertas del Día

</h2>

<div class="text-center">

<button class="btn btn-primary"
onclick="cargarOfertas()">

Actualizar ofertas

</button>

</div>

<div id="estado" class="text-center mt-4 fs-5"></div>

<div class="row mt-4" id="productos">

</div>

</div>

<script>

async function cargarOfertas(){

    const estado=document.getElementById("estado");
    const productos=document.getElementById("productos");

    estado.innerHTML="⏳ Consultando promociones...";

    productos.innerHTML="";



    await new Promise(resolve=>setTimeout(resolve,2500));

    estado.innerHTML="✅ Promociones actualizadas";

    productos.innerHTML=`

<div class="col-md-4">

<div class="card shadow animar">

<img src="https://m.media-amazon.com/images/I/71eOlLE22YL.AC_UF894,1000_QL80.jpg"
class="card-img-top">

<div class="card-body">

<h5>iPhone 13 Pro Max</h5>

<p class="text-decoration-line-through">$13,586</p>

<h4>$11,999</h4>

<span class="badge bg-success">

Oferta Especial

</span>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card shadow animar">

<img src="https://http2.mlstatic.com/D_NQ_NP_728013-MLU70713816690_072023-O.webp"
class="card-img-top">

<div class="card-body">

<h5>Cámara de Seguridad</h5>

<p class="text-decoration-line-through">$983</p>

<h4>$249</h4>

<span class="badge bg-danger">

75% OFF

</span>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card shadow animar">

<img src="https://http2.mlstatic.com/D_NQ_NP_2X_694480-MLA100038495791_122025-F.webp"
class="card-img-top">

<div class="card-body">

<h5>Smart Watch</h5>

<p class="text-decoration-line-through">$3,385</p>

<h4>$1,850</h4>

<span class="badge bg-warning text-dark">

Últimas piezas

</span>

</div>

</div>

</div>

`;

}

</script>

</body>

</html>