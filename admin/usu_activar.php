<?php
include("../conexion.php");
session_start();
//validando que el rol sea administrador
if(!isset($_SESSION["usuario"]) || $_SESSION["rol"]!="admin")
    {
        header("Location:iniciarsesion.php");
        exit();

    }

//validando que el codigo de usuario llegue
    if(isset($_GET["id"]))
        {
            $id=$_GET["id"];

            //modifica el estado a e inactivo

            $stmt= $conn->prepare("Update clientes set estado=1 where cod_cliente=? ");
            $stmt->bind_param("i",$id);
            if($stmt->execute())
                {
                    header("Location: usuarios_admin.php?msg=activado");
                    exit();
                }
            else
                {
                    echo "Error al Habilitar Usuario ".$stmt->error;
                }
                $stmt->close();
        }
        else
            {
                echo "No se recibio el codigo del Usuario";
            }
    $conn->close();
    ?>