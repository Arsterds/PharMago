<?php
session_start();
Include("../conexion.php");
$id=$_SESSION["id"];
$mensaje="";
if (isset($_POST["guardar"]))
    {
        $nombre=$_POST["nombre"];
            $apellido=$_POST["apellido"];
            $usuario=$_POST["usuario"];
            $email=$_POST["email"];
            $numero=$_POST["numero"];
            $documento=$_POST["documento"];
            
           
            $stmt=$conn->prepare("update clientes set nombre=?,apellido=?,usuario=?,email=?,numero=?,documento=? where cod_cliente=?");
            $stmt->bind_param("ssssssi",$nombre,$apellido,$usuario,$email,$numero,$documento,$id);
            if($stmt->execute())
                {
                $mensaje="Datos Actualizados";
            }
    }
    //Codigo para cambiar la contraseña
if (isset($_POST["cambiar"]))
{
        $actual=$_POST["actual"];
        $nueva=$_POST["nueva"];

    if($actual=="" || $nueva=="")
        {
            $mensaje="Todos los campos son obligatorios";
        }
    else
    {
        //cargar los datos de la contraseña y la encripta
        $stmt=$conn->prepare("SELECT contra_encriptada FROM clientes WHERE cod_cliente=?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $user=$stmt->get_result()->fetch_assoc();

    
        if($actual== $user["contra_encriptada"])
            {
                //encriptando la contraseña si la contraseña actual es correcta
                $hash=password_hash($nueva, PASSWORD_DEFAULT);

                $actualizar=$conn->prepare("UPDATE clientes SET contraseña=?, contra_encriptada=? WHERE cod_cliente=?");
                $actualizar->bind_param("ssi", $nueva, $hash, $id);

                if($actualizar->execute())
                    {
                        $mensaje="Contraseña actualizada correctamente";
                    }
                else
                    {
                        $mensaje="Error al actualizar";
                    }
                    $actualizar->close();
            }   
         
    else
                {
                    $mensaje="Contraseña actual incorrecta";
                }
    }
}

            //cargar datos
            $stmt=$conn->prepare("select * from clientes where cod_cliente=?");
            $stmt->bind_param("i",$id);
            $stmt->execute();

            $user=$stmt->get_result()->fetch_assoc();
            ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | PharMago</title>
        <link rel="icon" href="../imagenes/logo.png" type="image/png">
    <link rel="stylesheet" href="../css/general_perfil.css">
</head>
     <header>
        <div class="contenedor">
            <img src="../imagenes/logo.png" alt="Logo PharMago">
        </div>
        
                <div class="contenedor1">
            <a href="../soporte_desde_admin.php" class="button">
                CONTACTAR AL SOPORTE
            </a>
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
<body>
    <div class="card">
        <h2>EDITAR PERFIL </h2>
        <p><?php echo $mensaje; ?></p>
        <form method="POST" action="">
    <label>NOMBRE</label> <input type="text" name="nombre" value="<?php echo $user["nombre"];?>"><br>
    <label>APELLIDO</label> <input type="text" name="apellido" value="<?php echo $user["apellido"];?>"><br>
    <label>USUARIO</label> <input type="text" name="usuario" value="<?php echo $user["usuario"];?>"><br>
    <label>EMAIL</label> <input type="text" name="email" value="<?php echo $user["email"];?>"><br>
    <label>NUMERO</label> <input type="text" name="numero" value="<?php echo $user["numero"];?>"><br>
    <label>DOCUMENTO</label> <input type="text" name="documento" value="<?php echo $user["documento"];?>"><br>
            <button name="guardar" class="btn editar">Actualizar Datos </button>
        </form>
        <hr>
        <h2> CAMBIAR CONTRASEÑA </h2>
        <form method="POST" action="">
            CONTRASEÑA ACTUAL:<input type="password" name="actual"><br>
            NUEVA CONTRASEÑA:<input type="password" name="nueva" placeholder="Nueva Contraseña"><br>
            <button name="cambiar" class="btn editar">Cambiar Contraseña</button>
        </form>
        <a href="perfil.php" class="btn volver">VOLVER </a>
</div>
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
</html>