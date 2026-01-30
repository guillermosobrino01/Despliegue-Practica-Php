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
        echo "<table>
                <tr>
                    <td>Nombre del Evento</td>
                    <td>Fecha</td>
                    <td>Ubicación</td>
                    <td>Número de asistentes</td>
                    <td>Organizador</td>
                </tr>";
                foreach (EventoDao::getDatosEventos() as $evento){
                    echo "<tr>
                            <td>{$evento->getNombre()}</td>
                            <td>{$evento->getFecha()->format('Y-m-d')}</td>
                            <td>{$evento->getUbicacion()}</td>
                            <td>{$evento->getAsistentes()}</td>
                            <td>{$evento->getOrganizador()->getNombre()}</td>
                        </tr>";
                }
        echo "</table>"

    ?>
    <a href="index.php">Volver</a>
</body>

</html>