<?php
    require_once 'eventosdao.class.php';

    if (isset($_POST['enviar'])) {
        $nombre = $_POST['nombre'];
        $fecha = $_POST['fecha'];
        $ubicacion = $_POST['ubicacion'];
        $asistentes = $_POST['asistentes'];
        $organizadorId = $_POST['organizador'];
        
        $organizador = EventoDao::getOrganizadorPorId($organizadorId);
        $evento = new Evento (0, $nombre, new DateTime($fecha), $ubicacion, $asistentes, $organizador);

        EventoDao::guardarDatos($evento);
        echo "Evento guardado<br>";
        echo "<a href='index.php'>Volver</a>";
    }
?>