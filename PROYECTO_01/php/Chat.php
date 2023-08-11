<?php

session_start();
$id = $_SESSION['Id'];
$datos = $_SESSION['Nombres'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chats</title>
    <link rel="stylesheet" href="../css/Chat.css">
</head>
<body>
    <header>
        <img src="../img/img1.avif" width="100px">
        <ul>
            <li>Home</li>
            <li>Amigos</li>
            <li>Solicitudes</li>
            <li>Perfil</li>
            <!-- <li><?php echo $datos; ?></li> -->
        </ul>
    </header>
</body>
</html>