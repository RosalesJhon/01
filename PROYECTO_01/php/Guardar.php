<?php

include 'Conexion.php';

$nombres = $_POST['Nombres'];
$apellidos = $_POST['Apellidos'];
$correo = $_POST['Correo'];
$contrasena1 = $_POST['Contrasena1'];
$contrasena2 = $_POST['Contrasena2'];
$terminos = $_POST['terminos'];

if ($terminos == true) {
    if ($contrasena1 == $contrasena2) {

        $options = ['cost' => 12];
        $hash = password_hash($contrasena1, PASSWORD_BCRYPT, $options);

        $stmt = $conexion->prepare("SELECT * FROM datos WHERE Correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();

        $existe = $resultado['Correo'];

        if ($correo == $existe) {
            echo "<script>alert('El Email ya existe')</script>";
            header('Refresh: 0; URL= ../Crear.html');
            exit;
        } else {
            $stmt = $conexion->prepare("INSERT INTO datos (Nombres, Apellidos, Correo, Contrasena) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('ssss', $nombres, $apellidos, $correo, $hash);
            $stmt->execute();
            $stmt->close();
            $conexion->close();

            header('Refresh: 0; URL= ../Index.html');
            exit;
        }
    }
} else {
}
