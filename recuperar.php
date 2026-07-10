<?php
require_once 'config/security.php';
require 'db.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm = $_POST["confirm_password"];

    if($password != $confirm){

        $mensaje = '<div class="alert alert-danger">
                        Las contraseñas no coinciden.
                    </div>';

    }else{

        $sql = "SELECT * FROM registro WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":email" => $email
        ]);

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if($usuario){

            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            $update = $pdo->prepare("
                UPDATE registro
                SET password = :password
                WHERE email = :email
            ");

            $update->execute([
                ":password" => $passwordHash,
                ":email" => $email
            ]);

            $mensaje = '<div class="alert alert-success">
                            Contraseña actualizada correctamente.
                        </div>';

        }else{

            $mensaje = '<div class="alert alert-danger">
                            No existe una cuenta con ese correo.
                        </div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background-color:#f4f6f9;
        }

  .contenedor{
    max-width:420px;
    margin:40px auto;
    padding:20px;
}
 .card-recuperar{
    border:none;
    border-radius:15px;
}

        .icono{
    font-size:50px;
}

        .btn-recuperar{
            background-color:#1f1cff;
            border:none;
        }

        .btn-recuperar:hover{
            background-color:#1714d9;
        }

        .form-control{
            border-radius:12px;
        }

        .volver{
            text-decoration:none;
            color:#1f1cff;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #1f1cff;">
    <div class="container-fluid">

     
        <a class="navbar-brand fw-bold fs-4" href="index.php">
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

    </div>
</nav>


<div class="contenedor">

    <div class="card shadow-lg card-recuperar">
        <div class="card-body p-4">

            <div class="text-center mb-4">

                <div class="icono">🔐</div>

                <h2 class="fw-bold mt-3">
                    Recuperar Contraseña
                </h2>

                <p class="text-muted">
                    Ingresa tu correo y establece una nueva contraseña.
                </p>

            </div>

            <?php
            if(isset($mensaje)){
                echo $mensaje;
            }
            ?>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Correo electrónico
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control "
                        placeholder="correo@ejemplo.com"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Nueva contraseña
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control "
                        placeholder="********"
                        required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Confirmar contraseña
                    </label>

                    <input
                        type="password"
                        name="confirm_password"
                        class="form-control "
                        placeholder="********"
                        required>
                </div>

                <button
                    type="submit"
                    class="btn btn-recuperar text-white w-100">
                    Actualizar Contraseña
                </button>

            </form>

            <div class="text-center mt-4">
                <a href="login.php" class="volver">
                    ← Volver al inicio de sesión
                </a>
            </div>

        </div>
    </div>

</div>

</body>
</html>