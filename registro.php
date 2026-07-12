<?php
require_once 'config/security.php';
require_once 'config/session.php';
require_once 'config/csrf.php';
require_once 'config/logger.php';

if (isset($_SESSION['sessionstatus']) && $_SESSION['sessionstatus'] === true){
header("Location: index.php");
exit();
}
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    csrf_verify();

    $name = $_POST["name"];
    $email = $_POST["email"];
    $user = $_POST["user"];
    $password = $_POST["password"];
    $confirm = $_POST["confirm_password"];

    // 1. Validar contraseñas
    if ($password !== $confirm) {
        die("❌ Las contraseñas no coinciden");
    }

    // 2. Encriptar contraseña
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // 3. Insertar en la base de datos
 $sql = "INSERT INTO registro (name, email, user, password)
        VALUES (:name, :email, :user, :password)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ":name" => $name,
    ":email" => $email,
    ":user" => $user,
    ":password" => $passwordHash
]);
securityLog("Registro de nuevo usuario", $user);
    echo "✅ Usuario registrado correctamente";
}
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
        body{
            background-color:#f4f6f9;
        }

        .registro-card{
            max-width:500px;
            margin:auto;
            margin-top:50px;
            border-radius:15px;
        }

        .btn-crear{
            background-color:#1f1cff;
            color:white;
        }

        .btn-crear:hover{
            background-color:#1714d9;
            color:white;
        }
    </style>
</head>
<body>
 <?php include 'header.php'; ?>


    <div class="container">
        <div class="card shadow registro-card">
            <div class="card-body p-4">

                <h2 class="text-center mb-4">
                    Crear Cuenta
                </h2>

                <form action="registro.php" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8'); ?>">

                    <div class="mb-3">
                        <label class="form-label">Nombre Completo</label>
                        <input type="text" name="name" class="form-control" placeholder="Ingresa tu nombre">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" placeholder="correo@ejemplo.com">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <input type="text" name="user" class="form-control" placeholder="Nombre de usuario">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" placeholder="********">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirmar Contraseña</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="********">
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label">
                            Acepto los términos y condiciones
                        </label>
                    </div>

                    <button type="submit" class="btn btn-crear w-100">
                        Crear Cuenta
                    </button>

                </form>

                <p class="text-center mt-3">
                    ¿Ya tienes una cuenta?
                    <a href="login.php">Inicia sesión</a>
                </p>

            </div>
        </div>
    </div>

</body>
</html>