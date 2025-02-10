<?php
session_start(); 

$conexion = mysqli_connect("localhost", "root", "", "base1") or die("Problemas con la conexión");

$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$orden = isset($_GET['orden']) ? $_GET['orden'] : '';

$sql = "SELECT autor, categoria, nombre, valoracion, img FROM juegosycine";

if (!empty($categoria) && $categoria != "todos") {
    $sql .= " WHERE LOWER(categoria) = LOWER('" . mysqli_real_escape_string($conexion, $categoria) . "')";
}

if(empty($orden)){
    $sql .= " ORDER BY valoracion DESC"; 
}elseif ($orden == "valoracion") {
    $sql .= " ORDER BY valoracion DESC"; 
} elseif ($orden == "ascendente") {
    $sql .= " ORDER BY nombre ASC"; 
} elseif ($orden == "descendente") {
    $sql .= " ORDER BY nombre DESC"; 
}

$registros = mysqli_query($conexion, $sql) or die("Problemas en el select: " . mysqli_error($conexion));

$contador = 0; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelis - Juegos - Series / 24h</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <header>
        <ul>
            <li><a href="index.php?categoria=todos">Todos</a></li>
            <li><a href="index.php?categoria=musica">Música</a></li>
            <li><a href="index.php?categoria=pelicula">Películas</a></li>
            <li><a href="index.php?categoria=videojuego">Videojuegos</a></li>
        </ul>
    </header>
    <main>
        <form class="form-index" action="index.php" method="GET">
            <input type="hidden" name="categoria" value="<?= htmlspecialchars($categoria) ?>">
            <select name="orden" onchange="this.form.submit()">
                <option value="valoracion" <?= ($orden == "valoracion") ? "selected" : "" ?>>Valoración</option>
                <option value="ascendente" <?= ($orden == "ascendente") ? "selected" : "" ?>>Alfabético (A-Z)</option>
                <option value="descendente" <?= ($orden == "descendente") ? "selected" : "" ?>>Alfabético (Z-A)</option>
            </select>
        </form>

        <?php
        if (mysqli_num_rows($registros) > 0) {
            while ($reg = mysqli_fetch_array($registros)) {
                if ($contador % 3 == 0) {
                    echo "<div class='container-grande'>";
                }
                echo "<div class='container-pequeno'>";
                echo "<img src='" . $reg['img'] . "' alt='" . $reg['nombre'] . "'>";
                echo "<h3>" . $reg['nombre'] . "</h3>";
                echo "<h3>" . $reg['autor'] . "</h3>";
                echo "<h4>Valoración: " . $reg['valoracion'] . "</h4>";
                echo "</div>";
                $contador++;

                if ($contador % 3 == 0) {
                    echo "</div>"; 
                }
            }

            if ($contador % 3 != 0) {
                echo "</div>";
            }
        } else {
            echo "<h3 style='color: #fff;'>No hay resultados</h3>";
        }

        mysqli_close($conexion);
        
        ?>

        <?php if (isset($_SESSION['usuario'])): ?>
            <button class="boton-redirigir" onclick="window.location.href='formulario-subir.html'">
                SUBIR ARCHIVO
            </button>
        <?php else: ?>
            <button class="boton-redirigir" onclick="window.location.href='inicio-sesion.html'">
                INICIAR SESIÓN PARA SUBIR ARCHIVO
            </button>
        <?php endif; ?>
    </main>

    <footer class="footer">
        <div class="containerFooter">
            <div class="footerIzq">
                <div class="listaFooter"><a href="#">Cookies</a></div>
                <div class="listaFooter"><a href="#">Contáctanos</a></div>
                <div class="listaFooter"><a href="#">Sobre Nosotros</a></div>
            </div>
            <div class="footerDrch">
                <div class="listaFooter"><a href="#">Servicios</a></div>
                <div class="listaFooter"><a href="#">Aviso Legal</a></div>
                <div class="listaFooter"><a href="#">Política de privacidad</a></div>
            </div>
        </div>
        <p class="copy">&copy; 2025 Pelis - Juegos - Series / 24h. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
