<?php
/** 
 * Autor: José María Mayén Pérez
 */

$error = "";
$cont = 0;
$huecos = 0;

 if (isset($_POST["enviar"])) {
    if ($_POST["huecos"] !== "") {
        $huecos = (int) $_POST["huecos"];
        if ($huecos <= 0 || $huecos > 100) {
            $error = "Por favor, ingrese un número entre 1 y 100.";
            $huecos = 0; // Resetear a 0 en caso de error
        }
    } else {
        $error = "Debe introducir algún valor";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Multiplicación con Huecos</title>
</head>
<body>
    <form action="" method="post">
        Número de huecos: <input type="number" name="huecos">
        <span><b><?php echo $error; ?></b></span>
        <br>
        <button type="submit" name="enviar">Enviar</button>
    </form>
    <br>

    <?php if ($huecos > 0): ?>
    <form action="" method="post">
        <input type="hidden" name="huecos" value="<?php echo $huecos; ?>">
        <table border="1">
            <?php
            echo "<tr>";
            for ($i = 1; $i <= 10; $i++) {
                echo "<th>Tabla del $i</th>";
            }
            echo "</tr>";

            for ($j = 1; $j <= 10; $j++) {
                echo "<tr>";
                for ($i = 1; $i <= 10; $i++) {
                    if ($cont < $huecos && random_int(0, 1) === 1) {
                        echo '<td><input type="number" name="resultado[]" placeholder="?" style="width: 50px;"></td>';
                        $cont++;
                    } else {
                        echo "<td>" . ($i * $j) . "</td>";
                    }
                }
                echo "</tr>";
            }
            ?>
        </table>
        <br>
        <button type="submit" name="corregir">Corregir</button>
    </form>
    <?php endif; ?>
    <?php
        if(isset($_POST["corregir"])){
            var_dump( $_POST["resultado"]);
        }
        
    ?>
</body>
</html>
