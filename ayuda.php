<?php
require 'db.php';

$alerta = "";

if(isset($_POST["guardar"])){

    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $asunto = trim($_POST["asunto"]);
    $mensaje = trim($_POST["mensaje"]);

    $sql = "INSERT INTO contacto
            (nombre, correo, asunto, mensaje)
            VALUES
            (:nombre, :correo, :asunto, :mensaje)";

    $stmt = $pdo->prepare($sql);

    if($stmt->execute([
        ":nombre" => $nombre,
        ":correo" => $correo,
        ":asunto" => $asunto,
        ":mensaje" => $mensaje
    ])){

        $alerta = '
        <div class="alert alert-success">
            ✅ Mensaje enviado correctamente.
        </div>';

    }else{

        $alerta = '
        <div class="alert alert-danger">
            ❌ Ocurrió un error al enviar el mensaje.
        </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro de Ayuda</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background-color: #f4f6f9;
        }

        .hero{
            background: linear-gradient(135deg,#1f1cff,#5b59ff);
            color: white;
            padding: 70px 20px;
            text-align: center;
        }

        .card-ayuda{
            border: none;
            border-radius: 18px;
            transition: all .3s ease;
            cursor: pointer;
        }

        .card-ayuda:hover{
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0,0,0,.15);
        }

        .icono{
            font-size: 55px;
        }

        section{
            scroll-margin-top: 90px;
        }

        .btn-flotante{
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 65px;
            height: 65px;
            border-radius: 50%;
            font-size: 28px;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .card-info{
            border: none;
            border-radius: 15px;
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
<section class="hero">
    <h1 class="fw-bold">Centro de Ayuda</h1>
    <p class="lead">
        Encuentra respuestas rápidas a tus preguntas.
    </p>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <input
                    type="text"
                    class="form-control form-control-lg"
                    placeholder="¿En qué podemos ayudarte?">
            </div>
        </div>
    </div>
</section>

<div class="container my-5">

    <div class="row g-4">

        <div class="col-md-4">
            <a href="#pedidos" class="text-decoration-none text-dark">
                <div class="card card-ayuda shadow text-center p-4 h-100">
                    <div class="icono">📦</div>
                    <h4 class="mt-3">Mis Pedidos</h4>
                    <p>Seguimiento y estado de compras.</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="#envios" class="text-decoration-none text-dark">
                <div class="card card-ayuda shadow text-center p-4 h-100">
                    <div class="icono">🚚</div>
                    <h4 class="mt-3">Envíos</h4>
                    <p>Tiempos y costos de entrega.</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="#pagos" class="text-decoration-none text-dark">
                <div class="card card-ayuda shadow text-center p-4 h-100">
                    <div class="icono">💳</div>
                    <h4 class="mt-3">Pagos</h4>
                    <p>Métodos de pago disponibles.</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="#devoluciones" class="text-decoration-none text-dark">
                <div class="card card-ayuda shadow text-center p-4 h-100">
                    <div class="icono">🔄</div>
                    <h4 class="mt-3">Devoluciones</h4>
                    <p>Cambios y reembolsos.</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="#cuenta" class="text-decoration-none text-dark">
                <div class="card card-ayuda shadow text-center p-4 h-100">
                    <div class="icono">🔐</div>
                    <h4 class="mt-3">Cuenta y Seguridad</h4>
                    <p>Contraseñas y acceso.</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="#contacto" class="text-decoration-none text-dark">
                <div class="card card-ayuda shadow text-center p-4 h-100">
                    <div class="icono">📞</div>
                    <h4 class="mt-3">Contacto</h4>
                    <p>Habla con nuestro equipo.</p>
                </div>
            </a>
        </div>

    </div>

    <section id="pedidos" class="mt-5">
        <div class="card card-info shadow">
            <div class="card-body">
                <h3>📦 Mis Pedidos</h3>
                <ul>
                    <li>Consultar estado del pedido.</li>
                    <li>Ver fecha estimada de entrega.</li>
                    <li>Descargar facturas.</li>
                    <li>Consultar historial de compras.</li>
                </ul>
            </div>
        </div>
    </section>

    <section id="envios" class="mt-4">
        <div class="card card-info shadow">
            <div class="card-body">
                <h3>🚚 Envíos</h3>
                <p>
                    Los envíos suelen tardar entre 3 y 7 días hábiles.
                    Recibirás un correo con tu número de seguimiento.
                </p>
            </div>
        </div>
    </section>

    <section id="pagos" class="mt-4">
        <div class="card card-info shadow">
            <div class="card-body">
                <h3>💳 Pagos</h3>
                <ul>
                    <li>Tarjetas Visa y Mastercard.</li>
                    <li>PayPal.</li>
                    <li>Transferencia bancaria.</li>
                    <li>Pago contra entrega (según zona).</li>
                </ul>
            </div>
        </div>
    </section>

    <section id="devoluciones" class="mt-4">
        <div class="card card-info shadow">
            <div class="card-body">
                <h3>🔄 Devoluciones</h3>
                <p>
                    Dispones de 30 días para solicitar devoluciones
                    siempre que el producto se encuentre en buen estado.
                </p>
            </div>
        </div>
    </section>

    <section id="cuenta" class="mt-4">
        <div class="card card-info shadow">
            <div class="card-body">
                <h3>🔐 Cuenta y Seguridad</h3>
                <ul>
                    <li>
                        <a class="dropdown-item" href="recuperar.php">
                           Cambiar contraseña
                        </a>
                    </li>
                    <li>Recuperar acceso a la cuenta.</li>
                    <li>Actualizar correo electrónico.</li>
                    <li>Configurar seguridad adicional.</li>
                </ul>
            </div>
        </div>
    </section>

    <div class="mt-5">
        <h2 class="text-center mb-4">Preguntas Frecuentes</h2>

        <div class="accordion" id="faq">

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#faq1">
                        ¿Cómo rastreo mi pedido?
                    </button>
                </h2>

                <div id="faq1" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        Puedes consultar el estado desde tu historial de compras.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#faq2">
                        ¿Cuánto tarda un reembolso?
                    </button>
                </h2>

                <div id="faq2" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        Entre 3 y 10 días hábiles dependiendo del método de pago.
                    </div>
                </div>
            </div>

        </div>
    </div>

   <section id="contacto" class="mt-5 mb-5">
    <div class="card shadow">
        <div class="card-body p-4">

            <h3 class="mb-4">📞 Contactar Soporte</h3>

            <?php echo $alerta; ?>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input
                        type="text"
                        name="nombre"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Correo Electrónico
                    </label>

                    <input
                        type="email"
                        name="correo"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Asunto
                    </label>

                    <input
                        type="text"
                        name="asunto"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Mensaje
                    </label>

                    <textarea
                        name="mensaje"
                        class="form-control"
                        rows="5"
                        required></textarea>
                </div>

                <button
                    type="submit"
                    name="guardar"
                    class="btn btn-primary">

                    Enviar Mensaje

                </button>

            </form>

        </div>
    </div>
</section>
</div>

<a href="#contacto" class="btn btn-primary btn-flotante shadow">
    💬
</a>

</body>
</html>