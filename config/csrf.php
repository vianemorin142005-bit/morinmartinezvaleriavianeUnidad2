<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/logger.php';

function csrf_token()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function csrf_verify()
{
    if (
        !isset($_POST['csrf_token']) ||
        !isset($_SESSION['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {

        $usuario = $_SESSION['user'] ?? "Invitado";

        securityLog(
            "CRITICAL",
            "Intento de ataque CSRF bloqueado",
            $usuario
        );

        http_response_code(403);

        exit("Solicitud no válida (CSRF detectado).");
    }
}