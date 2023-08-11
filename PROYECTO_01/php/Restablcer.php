<?php

include 'Conexion.php';

$correo = $_POST['correo'];
$ape = $_POST['ape'];

if (!empty($correo) && !empty($ape)) {
    $stmt = $conexion->prepare("SELECT * FROM datos WHERE Correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result()->fetch_assoc();

    $bdemail = $resultado["Correo"];
    $bdnum = $resultado["Apellidos"];
    $bdid = $resultado["Id"];

    $contra1 = $_POST['pass1'];
    $contra2 = $_POST['pass2'];

    if ($contra1 == $contra2) {
        $options = ['cost' => 12];
        $hash = password_hash($contra1, PASSWORD_BCRYPT, $options);

        $query = "UPDATE datos SET Contrasena = ? WHERE Id = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("si", $hash, $bdid);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>alert('La contraseña se actualizó correctamente');</script>";
            header('Refresh: 0.1; URL=../Index.html');
            exit;
        } else {
            echo "<script>alert('No se pudo actualizar la contraseña');</script>";
            header('Refresh: 0.1; URL=../Restablecer.html');
            exit;
        }
    }
} else {
    echo "<script>alert('Los campos email y número son obligatorios');</script>";
    header('Refresh: 0.1; URL=../Restablecer.html');
    exit;
}
