<?php
    require_once 'eventosdao.class.php';
    require_once 'eventos_guardar.php';
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Inserte los datos del evento</h1>
    <form action="eventos_guardar.php" method="POST">
        <label for="nombre">Nombre del evento:*</label>
        <input type="text" name="nombre" required>
        <br>
        <label for="fecha">Fecha:*</label>
        <input type="date" name="fecha" required>
        <br>
        <label for="ubicacion">Ubicacion:*</label>
        <input type="text" name="ubicacion" required>
        <br>
        <label for="asistentes">Número de asistentes:*</label>
        <input type="number" name="asistentes" required>
        <br>
        
        <?php

            $organizadorSel = isset($_POST['organizador']) ? $_POST['organizador'] : '';
            echo "<label for='asistentes'>Organizador:</label>
                <select name='organizador'>";
                
                foreach(EventoDao::getOrganizadores() as $evento){
                    $selected = ($organizadorSel == $evento) ? "selected" : "";
                    echo "<option value='{$evento->getId()}' $selected>{$evento->getNombre()}</option>";
                }
                echo "</select>
                <br>
                <input type='submit' name='enviar' value='Guardar datos del evento'>";
        ?>
    </form>
    <a href="eventos_datos.php">Mostrar los eventos guardados</a>
    <br>
    <a href="eventos_borrar.php">Borrar eventos</a>
</body>

</html>