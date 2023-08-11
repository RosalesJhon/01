<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="webside icon" type="png" href="./img/logoApp.png">
</head>
<?php

include 'Conexion.php';

$correo = $_POST["correo"];
$contrasena = $_POST["contrasena"];

$stmt = $conexion->prepare("SELECT * FROM datos WHERE Correo = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result()->fetch_assoc();

$hash = $resultado['Contrasena'];
$nm = $resultado['Nombres'];

if (password_verify($contrasena, $hash)) {
    header("Location: Chat.php");
    $id = $resultado["Id"];
    $datos = $resultado["Nombres"];

    session_start();
    $_SESSION['Id'] = $id;
    $_SESSION['Nombres'] = $datos;

    exit();
} else {
    echo "<script>
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'El correo o contraseña son incorrectos'
        });
    </script>";
}
