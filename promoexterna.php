<?php require_once 'config/security.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Promociones</title>

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
            cursor:pointer;
        }
        .card:hover{
            transform:translateY(-8px);
        }
        .card img{
            height:220px;
            object-fit:contain;
            padding:15px;
        }
        .codigo{
            font-weight:bold;
            color:#dc3545;
        }
    </style>
</head>
<body>
 <?php include 'header.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center mb-4">🔥 Promociones Exclusivas</h2>
        <p class="text-center text-muted">Haz clic en cualquier tarjeta para copiar el código promocional.</p>
        <div class="row" id="contenedor"></div>
    </div>
    <script>
        const promociones = [
            {
                nombre: "Disney Plus",
                descuento: "10% de descuento",
                codigo: "DISNEY10",
                imagen: "https://upload.wikimedia.org/wikipedia/commons/3/3e/Disney%2B_logo.svg"
            },
            {
                nombre: "Prime Video",
                descuento: "10% de descuento",
                codigo: "PRIME10",
                imagen: "https://upload.wikimedia.org/wikipedia/commons/f/f1/Prime_Video.png"
            },

            {
                nombre: "Netflix",
                descuento: "10% de descuento",
                codigo: "NETFLIX10",
                imagen: "https://upload.wikimedia.org/wikipedia/commons/0/08/Netflix_2015_logo.svg"
            }

];

        const contenedor = document.getElementById("contenedor");

        promociones.forEach(producto => {

        contenedor.innerHTML += `

        <div class="col-md-4 mb-4">

        <div class="card shadow h-100"
        onclick="copiarCodigo('${producto.codigo}')">

        <img src="${producto.imagen}" class="card-img-top">

        <div class="card-body text-center">

        <h4>${producto.nombre}</h4>

        <h5 class="text-success">
        ${producto.descuento}
        </h5>

        <p class="codigo">
        Código: ${producto.codigo}
        </p>

        <button class="btn btn-primary w-100">
        Copiar código
        </button>

        </div>

        </div>

        </div>

        `;

        });

function copiarCodigo(codigo){

navigator.clipboard.writeText(codigo)
.then(() => {
    alert("✅ Código copiado: " + codigo);
})
.catch(() => {
    alert("No fue posible copiar el código.");
});

}

</script>

</body>

</html>
```
