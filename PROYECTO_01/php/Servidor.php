<?php
include 'Conexion.php';

function parseToXML($htmlStr)
{
    $xmlStr=str_replace('<','&lt;',$htmlStr);
    $xmlStr=str_replace('>','&gt;',$xmlStr);
    $xmlStr=str_replace('"','&quot;',$xmlStr);
    $xmlStr=str_replace("'",'&#39;',$xmlStr);
    $xmlStr=str_replace("&",'&amp;',$xmlStr);
    return $xmlStr;
}

$query = "SELECT * FROM datos WHERE Nombres !=''";
$result = mysqli_query($conexion, $query);
if (!$result) {
    die('Invalid query: ' . mysqli_error($conexion));
}

header("Content-type: text/xml");

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<markers>';

while ($row = mysqli_fetch_assoc($result)){
    echo '<marker id="' . $row['Id'] . '" ';
    echo 'Nombres="' . $row['Nombres'] . '" ';
    echo 'Apellidos="' . parseToXML($row['Apellidos']) . '" ';
    echo '/>';
}

echo '</markers>';
?>
