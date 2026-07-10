<?php

$csp = "default-src 'self'; "
     . "script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; "
     . "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; "
     . "img-src 'self' https: data:; "
     . "font-src 'self' https://cdn.jsdelivr.net; "
     . "connect-src 'self'; "
     . "object-src 'none'; "
     . "base-uri 'self'; "
     . "frame-ancestors 'none'; "
     . "form-action 'self';";

header("Content-Security-Policy: $csp");

header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: strict-origin-when-cross-origin");
header("Permissions-Policy: geolocation=(), microphone=(), camera=()");
header("Strict-Transport-Security: max-age=31536000; includeSubDomains");