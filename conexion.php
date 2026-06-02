<?php
//declarando variables
$host="localhost";
$usuario="root";
$password="";
$bd="pharmago";

//verificar la conexion con el gestor
$conn= new mysqli($host,$usuario,$password,$bd);

//si no puede conectar a la base genera un mensaje de error
if($conn->connect_error)
    {
        die("error de conexion: ".$conn->connect_error);
        
    }
?>
