<?php
    require_once 'eventosdao.class.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
            echo "<form method='POST'>
                <label for='evento'>Eventos:</label>
                    <select name='evento'>";
                    
                    foreach(EventoDao::getDatosEventos() as $evento){
                        $selected = ($organizadorSel == $evento) ? "selected" : "";
                        echo "<option value='{$evento->getId()}' $selected>{$evento->getNombre()} ({$evento->getOrganizador()->getNombre()})</option>";
                    }
                    echo "</select>
                    <br>
                    <input type='submit' name='borrar' value='Borrar'><br>";

                    if(isset($_POST['borrar'])){
                        $id=$_POST['evento'];

                        EventoDao::borrarDatos($id);
                        echo "Borrado el evento {$evento->getNombre()} del organizador {$evento->getOrganizador()->getNombre()}<br>";
                    }
        ?>
        <a href="index.php">Volver</a>
</body>
</html>