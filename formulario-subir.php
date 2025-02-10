<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    die("Acceso denegado");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Sube tu peli - música - juego</title>
        <link rel="stylesheet" href="./styles.css" />
    </head>
    <body class="body-subir">
        <form class="form" action="subirArchivo.php" method="POST">
            <div class="caja-input">
                <label for="id">Id:</label>
                <input type="number" id="id" name="id" required />
            </div>
            <div class="caja-input">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required />
            </div>
            <div class="caja-input">
                <label for="autor">Autor:</label>
                <input type="text" id="autor" name="autor" required />
            </div>
            <div class="caja-input">
                <label for="valoracion">Valoración:</label>
                <input
                    type="number"
                    id="valoracion"
                    name="valoracion"
                    min="0"
                    max="10"
                    required
                />
            </div>
            <div class="caja-input">
                <label for="categoria">Categoría:</label>
                <input type="text" id="categoria" name="categoria" required />
            </div>
            <div class="caja-input">
                <label for="img">Imagen:</label>
                <input type="text" id="img" name="img" />
            </div>
            <div class="caja-boton">
                <input type="submit" value="ENVIAR" />
            </div>
        </form>
<?php
    
        echo"<div class='caja-boton-regresar'>".
            "<button id='logoutButton'>".
                "LOGOUT".
            "</button>".
        "</div>"
?>
<script>
    document.getElementById("logoutButton").addEventListener("click", function() {
        window.location.href = "logout.php";
    });
</script>

    </body>
</html>
