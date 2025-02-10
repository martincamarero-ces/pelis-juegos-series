<?php
session_start();
$conexion = mysqli_connect("localhost", "root", "", "base1");

if (!$conexion) {
    die("Error en la conexión a la base de datos: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $contrasena = mysqli_real_escape_string($conexion, $_POST['contrasena']);
    
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario	 = '$usuario' LIMIT 1"; 
    $resultado = mysqli_query($conexion, $sql);
    
    if (mysqli_num_rows($resultado) > 0) {
        $usuario_db = mysqli_fetch_assoc($resultado);
        if ($contrasena == $usuario_db['contrasena']) {
            $_SESSION['usuario'] = $usuario;
            header('Location: formulario-subir.php');
            exit; 
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no registrado.";
    }
}

mysqli_close($conexion);
?>