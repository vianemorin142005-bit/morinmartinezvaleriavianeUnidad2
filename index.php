<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        footer {
            background-color: #343a40; 
            color: white; 
            padding: 20px 0;
        }
        footer a {
            color: #f8f9fa; 
        }
        footer a:hover {
            color: #ced4da; 
        }
        .card-img-top {
    height: 150px;
    object-fit: contain;
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
                    <a class="nav-link" href="buzon.php">Buzon</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="mensaje.html">chat</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                        href="#"
                        data-bs-toggle="dropdown">
                        Categorías
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="oferta.php">Ofertas</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="ayuda.php">Ayuda</a>
                </li>
            </ul>

          <form class="d-flex mx-auto w-50" onsubmit="buscarProducto(event)">
    <input
        id="buscador"
        class="form-control me-2 rounded-pill"
        type="search"
        placeholder="Buscar productos, marcas y más..."
        list="historial">

    <datalist id="historial"></datalist>
</form>

        <div class="d-flex align-items-center gap-3">

    <?php if(isset($_SESSION["id"])): ?>

        <span class="text-white fw-bold">
            👤 <?php echo htmlspecialchars($_SESSION["user"]); ?>
        </span>

        <a href="logout.php" class="btn btn-outline-light btn-sm">
            Cerrar Sesión
        </a>

    <?php else: ?>

        <a href="registro.php" class="btn text-white">
            Crear Cuenta
        </a>

        <a href="login.php" class="btn text-white">
            Ingresar
        </a>

    <?php endif; ?>

</div>
    </div>
</nav>
    <div id="carouselExampleSlidesOnly"
     class="carousel slide"
     data-bs-ride="carousel"
     data-bs-interval="3000">

    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://http2.mlstatic.com/D_NQ_988313-MLA76599053084_062024-OO.webp"
                 class="d-block w-100" alt="">
        </div>

        <div class="carousel-item">
            <img src="https://http2.mlstatic.com/D_NQ_628078-MLA94708797231_102025-OO.webp"
                 class="d-block w-100" alt="">
        </div>

        <div class="carousel-item">
            <img src="https://http2.mlstatic.com/D_NQ_877028-MLA111580634578_062026-OO.webp"
                 class="d-block w-100" alt="">
        </div>
    </div>
</div>

    <br>
    <div class="container mt-4">
        <h4>Inspirado en lo último que viste</h4>
        <br>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">

        <div class="col">
            <div class="card border-0 h-100 shadow-sm">
                <img src="https://http2.mlstatic.com/D_NQ_NP_728013-MLU70713816690_072023-O.webp"
                    class="card-img-top" alt="">
                <div class="card-body">
                      <h5 class="card-title">
                <a href="camara.html" class="text-dark text-decoration-none">
                    Cámara de Seguridad con alarma
                </a>
            </h5>
                    <p class="text-decoration-line-through">$983.45</p>
                    <h5>$297</h5>
                    <p><small class="text-primary">69% OFF en 6 meses sin intereses en $49</small></p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-0 h-100 shadow-sm">
                <img src="https://m.media-amazon.com/images/I/71eOlLE22YL.AC_UF894,1000_QL80.jpg"
                    class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title">
                    <a href="iphone.html" class="text-dark text-decoration-none">
                        Apple iPhone 13 Pro Max 128GB
                    </a>
                    </h5>
                    <p class="text-decoration-line-through">$13,586</p>
                    <h5>$12,493</h5>
                    <p><small class="text-primary">25% OFF en 12 meses sin intereses en $1,041</small></p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-0 h-100 shadow-sm">
                <img src="https://http2.mlstatic.com/D_NQ_NP_2X_694480-MLA100038495791_122025-F.webp"
                    class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title">
                    <a href="reloj.html" class="text-dark text-decoration-none">
                        Reloj Inteligente Smart Watch
                    </a>
                    </h5>
                    <p class="text-decoration-line-through">$3,385</p>
                    <h5>$1,999</h5>
                    <p><small class="text-primary">40% OFF en 24x $120</small></p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-0 h-100 shadow-sm">
                <img src="https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcQdlm55yXBH8nS3lBmPN4ADo1IwvmUVl7eVcgqzhECC6nf7FI79NRqwkCcFZXhvv05cp3r9O2W_K7ye-qjVX2lxFUdmF2H4Wjb02YveebpiZXmzhTan_so9&usqp=CAE"
                    class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title">
                    <a href="xbox.html" class="text-dark text-decoration-none">
                        Consola Microsoft Xbox Series X 1TB
                    </a>
                    </h5>
                    <p class="text-decoration-line-through">$8,999</p>
                    <h5>$8,599</h5>
                    <p><small class="text-primary">4% OFF en 18 meses sin intereses en $477</small></p>
                </div>
            </div>
        </div>

    </div>
</div>
    
    <br>
    <div class="container">
         <img src="https://images-us.nivea.com/-/media/nivea/local/mx/2020/sun/v2/lanzamiento/desktop/banner_desktop.png?rx=0&ry=0&rw=2560&rh=1000" class="img-fluid" alt="...">
    </div>
   
    <br>
    
    <div class="container mt-4">
    <div class="row g-6 justify-content-center">

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="row g-0">
                    <div class="col-md-6">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8pkR51FxXtqnJYJNvF2qnVNONA7T3cETCfA&s"
                             alt="...">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <p class="card-title">Conoce lo Mejor en</p>
                            <br>
                            <h4 class="card-text">Belleza y Cuidado Personal</h4>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="row gx-5">
                    <div class="col-md-4">
                        <img src="https://images.pexels.com/photos/965990/pexels-photo-965990.jpeg?cs=srgb&dl=pexels-valeriya-965990.jpg&fm=jpg"
                             class="img-fluid rounded-start"
                             alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <p class="card-title">Perfumes</p>
                            <br>
                            <h4 class="card-text">Conoce Todos Nuestros Aromas</h4>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
    <br>
    <br>

    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col">
          <h6 class="text-center">Elige cómo Pagar</h6>
          <p class="text-center">Con Mercado Pago, paga con tarjeta, débito o efectivo. También puedes pagar en hasta 12 mensualidades sin tarjeta con Mercado Crédito.</p>
        </div>
        <div class="col">
          <h6 class="text-center">Envío Gratis desde $199</h6>
          <p class="text-center">Al registrarte en Online Store tienes envíos gratis en miles de productos.</p>
        </div>
        <div class="col">
          <h6 class="text-center">Seguridad, de principio a fin</h6>
          <p class="text-center">¿No te gusta? ¡Devuélvelo! Online Store, no hay nada que no puedas hacer, porque estás siempre protegido.</p>
        </div>
      </div>
      
    </div>
    <footer>
        <div class="container text-center">
            <p>&copy; 2024 Tu Tienda. Todos los derechos reservados.</p>
            <p>
                <a href="#">Política de privacidad</a> | 
                <a href="#">Términos de servicio</a>
            </p>
        </div>
      </footer>
      <script>
function buscarProducto(event){
    event.preventDefault();

    let input = document.getElementById("buscador");
    let valor = input.value.toLowerCase().trim();

   
    let historial = JSON.parse(localStorage.getItem("historial")) || [];

    if(valor && !historial.includes(valor)){
        historial.push(valor);
        localStorage.setItem("historial", JSON.stringify(historial));
    }

    actualizarHistorial();

  
    if(valor.includes("iphone")){
        window.location.href = "iphone.html";
    }
    else if(valor.includes("camara")){
        window.location.href = "camara.html";
    }
    else if(valor.includes("reloj")){
        window.location.href = "reloj.html";
    }
    else if(valor.includes("xbox")){
        window.location.href = "xbox.html";
    }
    else {
        alert("Producto no encontrado");
    }

    input.value = "";
}

function actualizarHistorial(){
    let historial = JSON.parse(localStorage.getItem("historial")) || [];
    let datalist = document.getElementById("historial");

    datalist.innerHTML = "";

    historial.forEach(item => {
        let option = document.createElement("option");
        option.value = item;
        datalist.appendChild(option);
    });
}

actualizarHistorial();
</script>
</body>
</html>
