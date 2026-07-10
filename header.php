<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    
}

$paginaActual = basename($_SERVER['PHP_SELF']);
?>
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
            <?php if ($paginaActual === 'index.php'): ?>

            <ul class="navbar-nav me-4">
                <li class="nav-item">
                    <a class="nav-link" href="buzon.php">Buzón</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="mensaje.php">Chat</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                        href="#"
                        data-bs-toggle="dropdown">
                        Categorías
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="oferta.php">Ofertas</a></li>
                        <li><a class="dropdown-item" href="favoritos.php">Favoritos</a></li>
                        <li><a class="dropdown-item" href="promoexterna.php">Promociones Externas</a></li>
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
            <?php endif; ?>
            <div class="d-flex align-items-center gap-3">
                <?php if($paginaActual === 'favoritos.php'):?>
                <button
                    class="btn btn-danger"
                    onclick="limpiarFavoritos()">

                    Vaciar Favoritos

                </button>    
                <?php endif; ?>
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
    </div>
</nav>