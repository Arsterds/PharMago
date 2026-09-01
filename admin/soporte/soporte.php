<?php
session_start();


// ========================================
// CONEXIÓN A LA BASE DE DATOS
// ========================================

$conexion = mysqli_connect(
    "localhost",
    "root",
    "",
    "pharmago"
);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conexion, "utf8mb4");


// ========================================
// VERIFICAR SESIÓN
// ========================================

if (!isset($_SESSION["id"])) {
    die("No hay un usuario iniciado.");
}

$cod_cliente = $_SESSION["id"];


// ========================================
// OBTENER USUARIO DESDE LA TABLA CLIENTES
// ========================================

$sql_usuario = "SELECT usuario
                FROM clientes
                WHERE cod_cliente = ?";

$stmt_usuario = mysqli_prepare($conexion, $sql_usuario);

if (!$stmt_usuario) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

mysqli_stmt_bind_param(
    $stmt_usuario,
    "i",
    $cod_cliente
);

mysqli_stmt_execute($stmt_usuario);

$resultado = mysqli_stmt_get_result($stmt_usuario);

$cliente = mysqli_fetch_assoc($resultado);

mysqli_stmt_close($stmt_usuario);


if (!$cliente) {
    die("No se encontró el cliente.");
}


// Usuario real registrado en clientes
$usuario = $cliente["usuario"];

$mensaje = "";


// ========================================
// GUARDAR MENSAJE
// ========================================

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $mensaje_usu = trim($_POST["mensaje"] ?? "");

    if ($mensaje_usu == "") {

        $mensaje = "El mensaje es obligatorio.";

    } else {

        $sql = "INSERT INTO mensajes
                (usuario, mensaje, estado)
                VALUES (?, ?, 'activo')";

        $stmt = mysqli_prepare($conexion, $sql);

        if (!$stmt) {

            $mensaje = "Error al preparar la consulta: "
                     . mysqli_error($conexion);

        } else {

            mysqli_stmt_bind_param(
                $stmt,
                "ss",
                $usuario,
                $mensaje_usu
            );

            if (mysqli_stmt_execute($stmt)) {

                $mensaje = "Mensaje enviado correctamente.";

            } else {

                $mensaje = "Error al enviar el mensaje: "
                         . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        }
    }
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soporte | PharMago</title>

    <link rel="icon" href="./imagenes/logo.png" type="image/png">
    <link rel="stylesheet" href="../css/general1.css">
    <link rel="stylesheet" href="../css/style2.css">
</head>


<body>


<!-- ========================================
     ENCABEZADO
======================================== -->

    <header>
        <div class="contenedor">
            <img src="../imagenes/logo.png" alt="Logo PharMago">
        </div>
        <div class="contenedor1">
            <a href="soporte.php" class="button">
                CONTACTAR AL SOPORTE
            </a>
        </div>
        <h1>PharMago</h1>
        <nav>
            <a href="soporte_admin.php">SOPORTE</a>
            <a href="usuarios_admin.php">USUARIOS</a>
            <a href="productos_admin.php">PRODUCTOS</a>
            <a href="proveedores_admin.php">PROVEEDORES</a>

        </nav>
    </header>



<!-- ========================================
     CONTENIDO PRINCIPAL
======================================== -->

<main>

    <div class="formulario">

        <h2>Contactar con soporte</h2>


        <form
            method="POST"
            action=""
        >


            <!-- USUARIO -->

            <label for="usuario">
                Usuario
            </label>


            <input
                type="text"
                id="usuario"
                name="usuario"
                value="<?php echo htmlspecialchars($usuario); ?>"
                readonly
            >


            <!-- MENSAJE -->

            <label for="mensaje">
                Mensaje
            </label>


            <textarea
                id="mensaje"
                name="mensaje"
                placeholder="Escribe tu mensaje..."
                required
            ></textarea>


            <!-- BOTÓN -->

            <button
                type="submit"
                class="button"
            >
                Enviar mensaje
            </button>


        </form>


        <!-- RESPUESTA -->

        <?php if ($mensaje != ""): ?>

            <p class="respuesta">

                <?php
                echo htmlspecialchars($mensaje);
                ?>

            </p>

        <?php endif; ?>


    </div>

</main>



<!-- ========================================
     PIE DE PÁGINA
======================================== -->

<footer>

    <p>

        Contáctanos al:
        +57 xxxxxxxxx o
        PharMago_official en las redes sociales.

    </p>


    <p>

        © 2025
        <strong>PharMago</strong> |

        Desarrollado en el programa
        Técnico en Programación de Software.

    </p>


    <p>

        Este sitio web utiliza imágenes y
        recursos con fines educativos.

        Créditos a

        <a
            href="https://pixabay.com"
            target="_blank"
        >
            Pixabay
        </a>,

        <a
            href="https://google.com"
            target="_blank"
        >
            Google
        </a>,

        <a
            href="https://youtube.com"
            target="_blank"
        >
            YouTube
        </a>.

    </p>

</footer>


</body>

</html>