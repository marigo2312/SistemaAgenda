<?php
include_once("modelo/Usuario.php");
session_start();

$sErr = "";
$oUsu = new Usuario();

if (isset($_POST["txtUsuario"]) && !empty($_POST["txtUsuario"]) &&
    isset($_POST["txtContrasena"]) && !empty($_POST["txtContrasena"])) {
    
    $usuario = $_POST["txtUsuario"];
    $contrasena = $_POST["txtContrasena"];
    
    $oUsu->setUsuario($usuario);
    $oUsu->setContrasena($contrasena);

    try {
        if ($oUsu->validarLogin()) {
            $_SESSION["usuario"] = $oUsu->getId();       
            $_SESSION["nombre"] = $oUsu->getUsuario();   
            $_SESSION["rol"] = $oUsu->getRol();          

            header("Location: inicio.php");
            exit();
        } else {
            $sErr = "Usuario o contraseña incorrectos";
            header("Location: error.php?sError=" . urlencode($sErr));
            exit();
        }
    } catch (Exception $e) {
        error_log($e->getMessage(), 0);
        $sErr = "Error al acceder a la base de datos";
        header("Location: error.php?sError=" . urlencode($sErr));
        exit();
    }
} else {
    $sErr = "Faltan datos";
    header("Location: error.php?sError=" . urlencode($sErr));
    exit();
}
?>
