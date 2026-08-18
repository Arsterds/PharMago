<?php
session_start();

 
// Si no existe la sesión, redirigir al inicio de sesión
if (!isset($_SESSION["id"])) {
    echo "Bienvenido " , $_SESSION["usuario"];

} 
else{
header("Location: ../iniciarsesion.php");
    exit();
}

?>
