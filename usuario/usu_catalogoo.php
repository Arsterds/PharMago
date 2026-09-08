<?php
session_start();

// Este catálogo pertenece al área privada del usuario.
if (!isset($_SESSION['usuario']) || !isset($_SESSION['id'])) {
    header('Location: ../iniciarsesion.php');
    exit();
}

$nombreUsuario = htmlspecialchars($_SESSION['usuario'], ENT_QUOTES, 'UTF-8');

/*
 * Catálogo local.
 * La estructura queda preparada para reemplazar este arreglo por una
 * consulta a la tabla productos cuando se quiera conectar completamente
 * el catálogo con MySQL.
 */

$productos = [];
while($fila = $resultado->fetch_assoc()){

$productos[] = [

'id' => $fila['cod_productos'],

'nombre' => $fila['nombre'],
'precio' => $fila['precio_venta'],

'presentacion' => $fila['presentacion'],

'categoria' => $fila['categoria'],

'imagen' => '../imagenes/' . trim($fila['imagen']),

'descripcion' => $fila['descripcion'] ?? '',

'stock' => $fila['cantidad'],

'etiqueta' => ''

];

}

$categorias = [];
foreach ($productos as $producto) {
    $categorias[$producto['categoria']] = true;
}
$categorias = array_keys($categorias);
sort($categorias, SORT_NATURAL | SORT_FLAG_CASE);

function precioCOP($precio) {
    return '$' . number_format($precio, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Catálogo de productos PharMago para usuarios registrados.">
    <title>Catálogo | PharMago</title>
    <link rel="icon" href="../imagenes/logo.png" type="image/png">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/catalogo.css">
</head>
<body>

<header>
    <div class="contenedor">
        <img src="../imagenes/logo.png" alt="Logo PharMago">
    </div>

    <div class="contenedor1">
        <a href="./soporte.php" class="button">CONTACTAR AL SOPORTE</a>
    </div>

    <h1>PharMago</h1>
  <nav>
            <a href="./index_usuario.php">INICIO</a>
            <a href="./usu_catalogo.php">CATÁLOGO</a>
            <a href="./comunidad.php">COMENTARIOS</a>
                        <a href="./perfil.php" class="button">
                MI PERFIL
            </a>
        </nav>
</header>

<main class="catalogo-main">
    <section class="bienvenida-catalogo">
        <div>
            <span class="mini-titulo">CATÁLOGO PHARMAGO</span>
            <h2>Hola, <?= $nombreUsuario; ?> </h2>
            <p>Encuentra lo que necesitas de forma rápida y sencilla.</p>
        </div>
        <button class="boton-carrito-superior" id="abrir-carrito" type="button" aria-label="Abrir carrito">
            <span class="icono-carrito">🛒</span>
            <span>Mi carrito</span>
            <span class="contador-carrito" id="contador-carrito">0</span>
        </button>
    </section>

    <section class="herramientas-catalogo" aria-label="Herramientas del catálogo">
        <div class="buscador">
            <span>⌕</span>
            <input type="search" id="buscador-productos" placeholder="Buscar medicamento o producto..." autocomplete="off">
            <button type="button" id="limpiar-busqueda" aria-label="Limpiar búsqueda">×</button>
        </div>

        <div class="ordenar">
            <label for="orden-productos">Ordenar:</label>
            <select id="orden-productos">
                <option value="relevancia">Relevancia</option>
                <option value="nombre-asc">Nombre A-Z</option>
                <option value="nombre-desc">Nombre Z-A</option>
                <option value="precio-asc">Precio menor</option>
                <option value="precio-desc">Precio mayor</option>
            </select>
        </div>
    </section>

    <section class="categorias" aria-label="Categorías">
        <button type="button" class="filtro-categoria activo" data-categoria="Todos">Todos <span><?= count($productos); ?></span></button>
        <?php foreach ($categorias as $categoria): ?>
            <?php
                $cantidadCategoria = count(array_filter($productos, function ($producto) use ($categoria) {
                    return $producto['categoria'] === $categoria;
                }));
            ?>
            <button type="button" class="filtro-categoria" data-categoria="<?= htmlspecialchars($categoria, ENT_QUOTES, 'UTF-8'); ?>">
                <?= htmlspecialchars($categoria, ENT_QUOTES, 'UTF-8'); ?> <span><?= $cantidadCategoria; ?></span>
            </button>
        <?php endforeach; ?>
    </section>

    <div class="resumen-catalogo">
        <strong id="cantidad-resultados"><?= count($productos); ?> productos</strong>
        <span id="texto-filtro">Mostrando todo el catálogo</span>
    </div>

    <section class="catalogo-grid" id="catalogo-productos">
        <?php foreach ($productos as $producto): ?>
            <article
                class="producto"
                data-id="<?= $producto['id']; ?>"
                data-nombre="<?= htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8'); ?>"
                data-categoria="<?= htmlspecialchars($producto['categoria'], ENT_QUOTES, 'UTF-8'); ?>"
                data-precio="<?= $producto['precio']; ?>"
                data-presentacion="<?= htmlspecialchars($producto['presentacion'], ENT_QUOTES, 'UTF-8'); ?>"
                data-descripcion="<?= htmlspecialchars($producto['descripcion'], ENT_QUOTES, 'UTF-8'); ?>"
                data-imagen="<?= htmlspecialchars($producto['imagen'], ENT_QUOTES, 'UTF-8'); ?>"
            >
                <div class="producto-superior">
                    <?php if ($producto['etiqueta'] !== ''): ?>
                        <span class="etiqueta-producto"><?= htmlspecialchars($producto['etiqueta'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <?php endif; ?>
                    <button class="favorito" type="button" data-id="<?= $producto['id']; ?>" aria-label="Agregar a favoritos">♡</button>
                </div>

                <button class="imagen-producto" type="button" data-detalle="<?= $producto['id']; ?>" aria-label="Ver detalles de <?= htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8'); ?>">
                    <img src="<?= htmlspecialchars($producto['imagen'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?= htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                </button>

                <div class="producto-contenido">
                    <span class="categoria-producto"><?= htmlspecialchars($producto['categoria'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <h3><?= htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p><?= htmlspecialchars($producto['descripcion'], ENT_QUOTES, 'UTF-8'); ?></p>

                    <div class="datos-producto">
                        <span><?= htmlspecialchars($producto['presentacion'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <strong><?= precioCOP($producto['precio']); ?></strong>
                    </div>

                    <div class="acciones-producto">
                        <button class="ver-detalle" type="button" data-detalle="<?= $producto['id']; ?>">Ver detalles</button>
                        <button
                            class="boton-comprar"
                            type="button"
                            data-id="<?= $producto['id']; ?>"
                            data-imagen="<?= htmlspecialchars($producto['imagen'], ENT_QUOTES, 'UTF-8'); ?>"
                            data-nombre="<?= htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8'); ?>"
                            data-precio="<?= $producto['precio']; ?>"
                        >
                            🛒 Agregar
                        </button>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </section>

    <div class="sin-resultados" id="sin-resultados" hidden>
        <div>🔎</div>
        <h3>No encontramos productos</h3>
        <p>Prueba con otro nombre o selecciona la categoría “Todos”.</p>
        <button type="button" id="reiniciar-filtros">Mostrar todos</button>
    </div>
</main>

<!-- PANEL DEL CARRITO -->
<div class="carrito-fondo" id="carrito-fondo"></div>
<aside class="carrito-panel" id="carrito-panel" aria-label="Carrito de compras" aria-hidden="true">
    <div class="carrito-cabecera">
        <div>
            <span class="mini-titulo">TU PEDIDO</span>
            <h2>🛒 Mi carrito</h2>
        </div>
        <button type="button" id="cerrar-carrito" class="cerrar-panel" aria-label="Cerrar carrito">×</button>
    </div>

    <div class="lista-carrito" id="lista-carrito"></div>

    <div class="carrito-vacio" id="carrito-vacio">
        <div>🛍️</div>
        <h3>Tu carrito está vacío</h3>
        <p>Agrega productos y aparecerán aquí.</p>
    </div>

    <div class="carrito-pie">
        <div class="subtotal">
            <span>Total</span>
            <strong id="total">$0</strong>
        </div>
        <button type="button" id="vaciar-carrito" class="boton-vaciar">Vaciar carrito</button>
        <button type="button" id="finalizar-compra" class="boton-finalizar">Continuar compra</button>
    </div>
</aside>

<!-- MODAL DE DETALLES -->
<div class="modal-fondo" id="modal-fondo" hidden>
    <section class="modal-producto" role="dialog" aria-modal="true" aria-labelledby="modal-nombre">
        <button type="button" class="cerrar-modal" id="cerrar-modal" aria-label="Cerrar detalles">×</button>
        <div class="modal-imagen">
            <img id="modal-imagen" src="" alt="">
        </div>
        <div class="modal-info">
            <span class="categoria-producto" id="modal-categoria"></span>
            <h2 id="modal-nombre"></h2>
            <p id="modal-descripcion"></p>
            <div class="modal-datos">
                <div><span>Presentación</span><strong id="modal-presentacion"></strong></div>
                <div><span>Precio</span><strong id="modal-precio"></strong></div>
            </div>
            <button type="button" class="boton-comprar modal-agregar" id="modal-agregar">🛒 Agregar al carrito</button>
        </div>
    </section>
</div>

<footer>
    <p>Contáctanos al: +57 xxxxxxxxx o PharMago_official en las redes sociales.</p>
    <p>© 2025 <strong>PharMago</strong> | Desarrollado en el programa Técnico en Programación de Software.</p>
    <p>
        Este sitio web utiliza imágenes y recursos con fines educativos.
        Créditos a <a href="https://pixabay.com" target="_blank" rel="noopener">Pixabay</a>,
        <a href="https://google.com" target="_blank" rel="noopener">Google</a> y
        <a href="https://youtube.com" target="_blank" rel="noopener">YouTube</a>.
    </p>
</footer>

<script src="../js/catalogoo.js"></script>
</body>
</html>
