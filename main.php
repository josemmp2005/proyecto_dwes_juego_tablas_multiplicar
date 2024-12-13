<?php
/** 
 * 
 * Autor: José María Mayén Pérez
 */

// Generar un número aleatorio de huecos (de 1 a 10, por ejemplo)
$huecos_random = random_int(1, 10); 
$aciertos = 0;
$fallos = 0;

// Evaluar las respuestas si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    for ($i = 1; $i <= 10; $i++) {
        for ($j = 1; $j <= 10; $j++) {
            $resultado_correcto = $i * $j;

            // Verificar si hay una respuesta para esta multiplicación
            if (isset($_POST["respuesta_{$i}_{$j}"])) {
                $respuesta_usuario = $_POST["respuesta_{$i}_{$j}"];

                // Comparar la respuesta del usuario con el resultado correcto
                if ($respuesta_usuario == $resultado_correcto) {
                    $aciertos++;
                } else {
                    $fallos++;
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego Tablas Multiplicar</title>
</head>

<body>
    <h2>Juego de Tablas de Multiplicar</h2>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <h3>Resultados</h3>
        <p>Aciertos: <?= $aciertos ?></p>
        <p>Fallos: <?= $fallos ?></p>
    <?php endif; ?>

    <form method="POST">
        <table border="1">
            <tr>
                <th>Número</th>
                <?php
                // Encabezados para las tablas del 1 al 10
                for ($i = 1; $i <= 10; $i++) {
                    echo "<th>Tabla $i</th>";
                }
                ?>
            </tr>
            <?php
            $huecos_mostrados = 0;

            // Generar filas para los números del 1 al 10
            for ($i = 1; $i <= 10; $i++) {
                echo "<tr>";
                echo "<td>$i</td>"; 

                // Generar columnas con las multiplicaciones
                for ($j = 1; $j <= 10; $j++) {
                    $resultado = $i * $j;
                    $pregunta = random_int(0, 1);

                    // Mostrar solo tantos huecos como $huecos_random
                    if ($pregunta == 1 && $huecos_mostrados < $huecos_random) {
                        $nombre_campo = "respuesta_{$i}_{$j}";
                        $valor_respuesta = $_POST[$nombre_campo] ?? ''; // Mantener el valor ingresado en caso de error
                        echo "<td><input type='number' name='$nombre_campo' placeholder='?' value='$valor_respuesta' /></td>";
                        $huecos_mostrados++; 
                    } else {
                        echo "<td>$resultado</td>";
                    }
                }

                echo "</tr>";
            }
            ?>
        </table>
        <br>
        <input type="submit" value="Enviar Respuestas">
    </form>
</body>

</html>
