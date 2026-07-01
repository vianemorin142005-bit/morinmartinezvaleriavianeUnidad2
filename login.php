<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM registro WHERE email = :email";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ":email" => $email
    ]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {

        if (password_verify($password, $usuario["password"])) {

            $_SESSION["id"] = $usuario["id"];
            $_SESSION["name"] = $usuario["name"];
            $_SESSION["user"] = $usuario["user"];
            $_SESSION["email"] = $usuario["email"];

            header("Location: index.php");
            exit();

        } else {
            $error = "Contraseña incorrecta";
        }

    } else {
        $error = "Usuario no encontrado";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f4f6f9;
}

.login-card{
    max-width:450px;
    margin:auto;
    margin-top:80px;
    border-radius:15px;
}

.btn-login{
    background:#1f1cff;
    color:white;
}

.btn-login:hover{
    background:#1714d9;
    color:white;
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


<div class="container">

    <div class="card shadow login-card">

        <div class="card-body p-4">

            <h2 class="text-center mb-4">
                Iniciar Sesión
            </h2>

            <?php if(isset($error)): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-3">
                    <label>Correo Electrónico</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Contraseña</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           required>
                </div>

                <button class="btn btn-login w-100">
                    Ingresar
                </button>

            </form>

           <div class="text-center mt-3">
    <a href="recuperar.php" class="text-decoration-none">
        ¿Olvidaste tu contraseña?
    </a>
</div>

<p class="text-center mt-3">
    ¿No tienes cuenta?
    <a href="registro.php">
        Crear cuenta
    </a>
</p>

        </div>

    </div>

</div>

</body>
</html>