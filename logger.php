<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../db.php';

/*
|--------------------------------------------------------------------------
| DATOS DEL USUARIO
|--------------------------------------------------------------------------
*/

$usuario_id = $_SESSION['id'] ?? null;

if (isset($_SESSION['user'])) {
    $nombre_usuario = $_SESSION['user'];
} elseif (isset($_SESSION['name'])) {
    $nombre_usuario = $_SESSION['name'];
} else {
    $nombre_usuario = "Invitado";
}

$ip = $_SERVER['REMOTE_ADDR'] ?? "Desconocida";
$metodo = $_SERVER['REQUEST_METHOD'] ?? "GET";
$url = $_SERVER['REQUEST_URI'] ?? "";
$navegador = $_SERVER['HTTP_USER_AGENT'] ?? "";

/*
|--------------------------------------------------------------------------
| REGISTRAR VISITA
|--------------------------------------------------------------------------
*/

try {

    $sql = "INSERT INTO access_log
            (usuario_id,nombre_usuario,url,metodo,ip)
            VALUES
            (:usuario_id,:nombre_usuario,:url,:metodo,:ip)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':usuario_id' => $usuario_id,
        ':nombre_usuario' => $nombre_usuario,
        ':url' => $url,
        ':metodo' => $metodo,
        ':ip' => $ip
    ]);

} catch (Exception $e) {
    // No detener la aplicación
}

/*
|--------------------------------------------------------------------------
| REGISTRAR VISITA EN AUDITORÍA
|--------------------------------------------------------------------------
*/

try {

    $sql = "INSERT INTO audit_log
            (usuario_id,nombre_usuario,accion,tipo,pagina,metodo,ip,navegador)
            VALUES
            (:usuario,:nombre,:accion,:tipo,:pagina,:metodo,:ip,:nav)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':usuario' => $usuario_id,
        ':nombre' => $nombre_usuario,
        ':accion' => 'Visitó la página',
        ':tipo' => 'INFO',
        ':pagina' => $url,
        ':metodo' => $metodo,
        ':ip' => $ip,
        ':nav' => $navegador
    ]);

} catch (Exception $e) {
}

/*
|--------------------------------------------------------------------------
| DETECCIÓN BÁSICA DE ATAQUES
|--------------------------------------------------------------------------
*/

$cadena = strtolower(
    urldecode(
        $_SERVER['REQUEST_URI'] .
        json_encode($_GET) .
        json_encode($_POST)
    )
);

$patrones = [

    "SQL Injection" => [
        "union select",
        "or 1=1",
        "drop table",
        "insert into",
        "sleep(",
        "' or '"
    ],

    "XSS" => [
        "<script",
        "alert(",
        "onerror=",
        "onload="
    ],

    "Path Traversal" => [
        "../",
        "..\\",
        "/etc/passwd",
        "boot.ini"
    ]

];

foreach ($patrones as $tipo => $lista) {

    foreach ($lista as $valor) {

        if (strpos($cadena, $valor) !== false) {

            try {

                $sql = "INSERT INTO security_log
                        (tipo,descripcion,payload,url,ip)
                        VALUES
                        (:tipo,:descripcion,:payload,:url,:ip)";

                $stmt = $pdo->prepare($sql);

                $stmt->execute([

                    ':tipo' => $tipo,
                    ':descripcion' => 'Patrón detectado automáticamente',
                    ':payload' => $cadena,
                    ':url' => $url,
                    ':ip' => $ip

                ]);

            } catch (Exception $e) {
            }

            break;
        }
    }
}

/*
|--------------------------------------------------------------------------
| REGISTRAR ACCIONES
|--------------------------------------------------------------------------
*/

function securityLog($nivel, $evento, $usuario = "Invitado")
{
    global $pdo;

    $usuario_id = $_SESSION['id'] ?? null;

    if (isset($_SESSION['user'])) {
        $nombre_usuario = $_SESSION['user'];
    } elseif (isset($_SESSION['name'])) {
        $nombre_usuario = $_SESSION['name'];
    } else {
        $nombre_usuario = $usuario;
    }

    $ip = $_SERVER['REMOTE_ADDR'] ?? "Desconocida";
    $metodo = $_SERVER['REQUEST_METHOD'] ?? "GET";
    $pagina = $_SERVER['REQUEST_URI'] ?? "";
    $navegador = $_SERVER['HTTP_USER_AGENT'] ?? "";

    try {

        $sql = "INSERT INTO audit_log
                (usuario_id,nombre_usuario,accion,tipo,pagina,metodo,ip,navegador)
                VALUES
                (:usuario_id,:nombre_usuario,:accion,:tipo,:pagina,:metodo,:ip,:navegador)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':usuario_id' => $usuario_id,
            ':nombre_usuario' => $nombre_usuario,
            ':accion' => $evento,
            ':tipo' => strtoupper($nivel),
            ':pagina' => $pagina,
            ':metodo' => $metodo,
            ':ip' => $ip,
            ':navegador' => $navegador
        ]);

    } catch (Exception $e) {
    }
}