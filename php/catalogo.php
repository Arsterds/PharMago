<?php
session_start();

$usuarioLogueado = isset($_SESSION['id']);
$nombreUsuario = $_SESSION['usuario'] ?? 'Invitado';
$idUsuario = $_SESSION['id'] ?? null;




/*
 * Catálogo local.
 * La estructura queda preparada para reemplazar este arreglo por una
 * consulta a la tabla productos cuando se quiera conectar completamente
 * el catálogo con MySQL.
 */
$productos = [
    [
        'id' => 1,
        'nombre' => 'Warfarina 5 mg',
        'precio' => 62500,
        'presentacion' => 'Tabletas',
        'categoria' => 'Cardiovascular',
        'imagen' => '../imagenes/warfarina-5mg.png',
        'descripcion' => 'Medicamento anticoagulante utilizado para prevenir y tratar la formación de coágulos sanguíneos.',
        'etiqueta' => 'Destacado'
    ],
    [
        'id' => 2,
        'nombre' => 'Vitamina C 500 mg',
        'precio' => 4400,
        'presentacion' => 'Tabletas',
        'categoria' => 'Vitaminas',
        'imagen' => '../imagenes/vitaminac-500mg.png',
        'descripcion' => 'Vitamina que participa en la formación de colágeno y el mantenimiento de los tejidos.',
        'etiqueta' => 'Popular'
    ],
    [
        'id' => 3,
        'nombre' => 'Vaporub 50 g',
        'precio' => 19000,
        'presentacion' => 'Ungüento',
        'categoria' => 'Cuidado personal',
        'imagen' => '../imagenes/vaporub.png',
        'descripcion' => 'Ungüento de uso tópico para aliviar temporalmente síntomas asociados al resfriado.',
        'etiqueta' => 'Popular'
    ],
    [
        'id' => 4,
        'nombre' => 'Pediasure 400 g',
        'precio' => 56000,
        'presentacion' => 'Polvo',
        'categoria' => 'Nutrición',
        'imagen' => '../imagenes/pediasure-400g.png',
        'descripcion' => 'Suplemento nutricional pensado para complementar la alimentación infantil.',
        'etiqueta' => 'Destacado'
    ],
    [
        'id' => 5,
        'nombre' => 'Paracetamol 500 mg',
        'precio' => 7500,
        'presentacion' => 'Tabletas',
        'categoria' => 'Analgésicos',
        'imagen' => '../imagenes/PARACETAMOL.avif',
        'descripcion' => 'Analgésico y antipirético utilizado para aliviar dolor y reducir la fiebre.',
        'etiqueta' => 'Popular'
    ],
    [
        'id' => 6,
        'nombre' => 'Naproxeno Sódico 275 mg',
        'precio' => 9500,
        'presentacion' => 'Tabletas',
        'categoria' => 'Analgésicos',
        'imagen' => '../imagenes/NaproxenoSodico-275mg.png',
        'descripcion' => 'Antiinflamatorio utilizado para aliviar diferentes tipos de dolor y reducir la inflamación.',
        'etiqueta' => ''
    ],
    [
        'id' => 7,
        'nombre' => 'Ibuprofeno 800 mg',
        'precio' => 4500,
        'presentacion' => 'Tabletas',
        'categoria' => 'Analgésicos',
        'imagen' => '../imagenes/ibu.png',
        'descripcion' => 'Antiinflamatorio, analgésico y antipirético para el alivio de diferentes dolores.',
        'etiqueta' => 'Precio bajo'
    ],
    [
        'id' => 8,
        'nombre' => 'Ensure 400 g',
        'precio' => 79000,
        'presentacion' => 'Polvo',
        'categoria' => 'Nutrición',
        'imagen' => '../imagenes/Ensure-400g.png',
        'descripcion' => 'Suplemento nutricional para complementar una alimentación equilibrada en adultos.',
        'etiqueta' => 'Destacado'
    ],
    [
        'id' => 9,
        'nombre' => 'Benzerin Verde 120 mL',
        'precio' => 64500,
        'presentacion' => 'Líquido',
        'categoria' => 'Cuidado personal',
        'imagen' => '../imagenes/benzerinverde-120mL.png',
        'descripcion' => 'Spray bucal indicado para aliviar molestias e irritación de garganta, boca y encías.',
        'etiqueta' => ''
    ],
    [
        'id' => 10,
        'nombre' => 'Atorvastatina 20 mg',
        'precio' => 8500,
        'presentacion' => 'Tabletas',
        'categoria' => 'Cardiovascular',
        'imagen' => '../imagenes/ATORVASTATINA.png',
        'descripcion' => 'Medicamento utilizado para ayudar a controlar los niveles de colesterol y triglicéridos.',
        'etiqueta' => ''
    ],
    [
        'id' => 11,
        'nombre' => 'Amoxicilina 500 mg',
        'precio' => 7000,
        'presentacion' => 'Tabletas',
        'categoria' => 'Antibióticos',
        'imagen' => '../imagenes/AMOXICILINA.png',
        'descripcion' => 'Antibiótico utilizado para el tratamiento de determinadas infecciones bacterianas.',
        'etiqueta' => ''
    ],
    [
        'id' => 12,
        'nombre' => 'Acetaminofén 500 mg',
        'precio' => 8500,
        'presentacion' => 'Tabletas',
        'categoria' => 'Analgésicos',
        'imagen' => '../imagenes/acetaminofen-500mg.png',
        'descripcion' => 'Analgésico y antipirético indicado para aliviar dolor leve o moderado y reducir la fiebre.',
        'etiqueta' => 'Popular'
    ],
    [
        'id' => 13,
        'nombre' => 'Acetaminofén 160 mg (Niños)',
        'precio' => 14000,
        'presentacion' => 'Tabletas',
        'categoria' => 'Pediatría',
        'imagen' => '../imagenes/acetaminofenniños-160mg.png',
        'descripcion' => 'Presentación pediátrica para el alivio de dolor y fiebre según la dosis indicada.',
        'etiqueta' => 'Pediátrico'
    ],
    [
        'id' => 14,
        'nombre' => 'Omeprazol 20 mg',
        'precio' => 10000,
        'presentacion' => 'Tabletas',
        'categoria' => 'Digestivos',
        'imagen' => '../imagenes/omeprazol.png',
        'descripcion' => 'Medicamento que reduce la producción de ácido en el estómago.',
        'etiqueta' => ''
    ],
    [
        'id' => 15,
        'nombre' => 'Levotiroxina Sódica 100 mcg',
        'precio' => 199000,
        'presentacion' => 'Tabletas',
        'categoria' => 'Especializados',
        'imagen' => '../imagenes/levotiroxina.png',
        'descripcion' => 'Medicamento utilizado en el tratamiento del hipotiroidismo y otras alteraciones tiroideas.',
        'etiqueta' => ''
    ],
    [
        'id' => 16,
        'nombre' => 'Amlodipina 10 mg',
        'precio' => 15000,
        'presentacion' => 'Tabletas',
        'categoria' => 'Cardiovascular',
        'imagen' => '../imagenes/AMLODIPINA-10MG.png',
        'descripcion' => 'Medicamento utilizado para ayudar a controlar la presión arterial y algunas afecciones cardíacas.',
        'etiqueta' => ''
    ]
];

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
            <a href="./php/soporte.php" class="button">
                CONTACTAR AL SOPORTE
            </a>
        </div>
        <h1>PharMago</h1>
        <nav>
            <a href="../index.php">INICIO</a>
            <a href="./catalogo.php">CATÁLOGO</a>
            <a href="../registro.php">REGISTRO</a>
            <a href="../iniciarsesion.php">INICIAR SESIÓN</a>
        </nav>
    </header>

<main class="catalogo-main">
    <section class="bienvenida-catalogo">
        <div>
            <span class="mini-titulo">CATÁLOGO PHARMAGO</span>
            <h2>Hola, <?= "Bienvenido A Nuestro Catalogo"; ?> </h2>
            <p>Encuentra lo que necesitas de forma rápida y sencilla.</p>
        </div>
        <a href="../funciones_especiales/alcarrito.php" onclick="return confirm('Desea dar de baja este usuario?');"> 
        <button class="boton-carrito-superior" id="abrir-carrito" type="button" aria-label="Abrir carrito">
            <span class="icono-carrito">🛒</span>
            <span>Mi carrito</span>
            <span class="contador-carrito" id="contador-carrito">0</span>
        </button>
        </a>
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

