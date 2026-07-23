<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: ../iniciarsesion.php");
    exit();
}
?>