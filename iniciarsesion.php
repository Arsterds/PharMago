
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharMago - Iniciar Sesión</title>

    <link rel="icon" href="./imagenes/logo.png" type="image/png">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/iniciarsesion.css">
</head>

<body>
<?php
//iniciar conexion a la base de datos
session_start();
include("conexion.php");
//inicializar variable
$mensaje="";
if(isset($_POST["ingresar"]))
    {
        $correo=$_POST["correo"];
        $contra=$_POST["contra"];
        //validacion 
        if($correo=="" || $contra=="")
            {
                $mensaje="Todos los campos son obligatorios";
            }
            else
                {
                    //Cosultar usuario activo
                    echo $usuario;
                    echo $contra;
                    $stmt = $conn->prepare("select cod_cliente,nombre,email,contra_encriptada,rol from clientes where email=? and estado=1");
                    $stmt->bind_param("s",$correo);
                    $stmt->execute();
                    $resultado=$stmt->get_result();

                    if($fila=$resultado->fetch_assoc())
                        {
                            //verificar contraseña
                            if(password_verify($contra,$fila["contra_encriptada"]))
                                {
                                    //crea la sesion 
                                    $_SESSION ["id"]=$fila["cod_cliente"];
                                    $_SESSION ["usuario"]=$fila["nombre"];
                                    $_SESSION ["rol"]=$fila["rol"];
                                 //si usuario y contraseña existe redirecciona 
                                 if($fila["rol"]=="admin")
                                    {
                                        header ("Location: ./admin/dashboard_admin.php");
                                        exit();
                                    }   
                                    else{
                                        header("Location: ./usuario/index_usuario.php");
                                        exit();
                                    }
                                
                                }
                                else{
                                    $mensaje="Contraseña Incorrecta";
                                }
                             }
                        
                        else{
                            $mensaje="Usuario No encontrado o Inactivo";
                        }
                        $stmt->close();
                   }
    }
    
    //cierre de conexion
    $conn->close();

?>
    <!-- ENCABEZADO -->
    <header>
        <div class="contenedor">
            <img src="imagenes/logo.png" alt="Logo PharMago">
        </div>
        <div class="contenedor1">
            <a href="soporte.php" class="button">
                CONTACTAR AL SOPORTE
            </a>
        </div>
        <h1>PharMago</h1>
        <nav>
            <a href="index.php">INICIO</a>
            <a href="./php/catalogo.php">CATÁLOGO</a>
            <a href="registro.php">REGISTRO</a>
            <a href="iniciarsesion.php">INICIAR SESIÓN</a>
        </nav>
    </header>

    <!-- CONTENIDO -->
    <main>
        <section id="contacto" class="login">
            <form id="formContacto" action="iniciarsesion.php" method="POST">
                <h2>Iniciar Sesión</h2>
               
    <p><?php echo $mensaje;?></p>
   
                <div class="form-group">
                    <label for="nombre_de_usuario">
                        Correo:
                    </label>
                    <input
                        type="email"

                        name="correo"
                        autocomplete="username"
                        placeholder="Ingrese su usuario"
                        >
                </div>

                <div class="form-group">
                    <label for="contrasena">
                        Contraseña:
                    </label>
                    <input
                        type="password"
                        id="contra"
                        name="contra"
                        autocomplete="current-password"
                        placeholder="Ingrese su contraseña"
                        >
                </div>
                <button type="submit" name="ingresar"> Ingresar </button>
                <p class="registro">
                    ¿No tienes una cuenta?
                    <a href="registro.php">Regístrate aquí</a>
                </p>
            </form>
        </section>
    </main>

    <!-- PIE -->
    <footer>
        <p>
            Contáctanos al:
            +57 xxxxxxxxx o PharMago_official en las redes sociales.
        </p>
        <p>
            © 2025 <strong>PharMago</strong> |
            Desarrollado en el programa Técnico en Programación de Software.
        </p>
        <p>
            Este sitio web utiliza imágenes y recursos con fines educativos.
            Créditos a
            <a href="https://pixabay.com" target="_blank">Pixabay</a>,
            <a href="https://google.com" target="_blank">Google</a>,
            <a href="https://youtube.com" target="_blank">YouTube</a>.
        </p>
    </footer>

</body>

