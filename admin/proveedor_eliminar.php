<?php

include("../conexion.php");
session_start();

//validando que el rol sea administrador
if(!isset($_SESSION["usuario"]) || $_SESSION["rol"]!="admin")
    {
        header("Location:../iniciarsesion.php");
        exit();
    }

    //validando que el codigo de usuario llegue
    if(isset($_GET["id"]))
    {
        $id=$_GET["id"];

        //modifica el estado a e inactivo
        $stmt= $conn->prepare("Update proveedores set estado=0 where cod_proveedor=? ");
        $stmt->bind_param("i",$id);
        if ($stmt->execute())
            {
                header("Location: proveedores_admin.php? msg=eliminado");
                exit();
            }
        else
            {
                echo "Error al Eliminar Usuario ".$stmt->error;
            }
            $stmt->close();
    }
    else
        {
            echo "No se recibio el codigo del usuario";
        }
    $conn->close();
    ?>