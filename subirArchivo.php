<?php

$conexion = mysqli_connect("localhost", "root", "", "base1");

if (!$conexion) {
    die("Error en la conexión a la base de datos: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conexion, $_POST["id"]);
    $nombre = mysqli_real_escape_string($conexion, $_POST["nombre"]);
    $autor = mysqli_real_escape_string($conexion, $_POST["autor"]);
    $valoracion = mysqli_real_escape_string($conexion, $_POST["valoracion"]);
    $categoria = mysqli_real_escape_string($conexion, $_POST["categoria"]);
    $img = mysqli_real_escape_string($conexion, $_POST["img"]);

    $sql = "INSERT INTO juegosycine (id, nombre, autor, categoria, valoracion, img) 
            VALUES ('$id', '$nombre', '$autor', '$categoria', '$valoracion', '$img')";

    if (mysqli_query($conexion, $sql)) {
        echo "Registro insertado correctamente.";
    } else {
        echo "Error al insertar el registro: " . mysqli_error($conexion);
    }
    mysqli_close($conexion);
}
?>


