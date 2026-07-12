<?php

function securityLog($nivel, $evento, $usuario = "Invitado")
{
    $archivo = __DIR__ . "/../logs/security.log";

    $fecha = date("Y-m-d H:i:s");
    $ip = $_SERVER['REMOTE_ADDR'] ?? "Desconocida";
    $metodo = $_SERVER['REQUEST_METHOD'] ?? "-";
    $url = $_SERVER['REQUEST_URI'] ?? "-";

    $linea = sprintf(
        "[%s] [%s] Usuario: %s | IP: %s | Método: %s | URL: %s | Evento: %s%s",
        $fecha,
        strtoupper($nivel),
        $usuario,
        $ip,
        $metodo,
        $url,
        $evento,
        PHP_EOL
    );

    file_put_contents($archivo, $linea, FILE_APPEND | LOCK_EX);
}