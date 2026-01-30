<?php
require_once 'conexion.class.php';
require_once 'organizador.class.php';
require_once 'evento.class.php';


class EventoDao
{

    public static function getOrganizadores(): array
    {
        $conexion = Conexion::getInstancia()->getConexion();
        $consulta = "SELECT * FROM organizadores";
        $sentencia = $conexion->query($consulta);
        $organizadores = [];
        while ($row = $sentencia->fetch(PDO::FETCH_ASSOC)) {
            $organizador = new Organizador($row['id'], $row['dni'], $row['nombre'], $row['contacto']);
            $organizadores[] = $organizador;

        }
        return $organizadores;
    }

    public static function getEventos(): array
    {
        $conexion = Conexion::getInstancia()->getConexion();
        $consulta = "SELECT nombre FROM eventos";
        $sentencia = $conexion->query($consulta);
        $eventos = [];
        while ($row = $sentencia->fetch(PDO::FETCH_ASSOC)) {
            $evento = $row['nombre'];
            $eventos[] = $evento;

        }
        return $eventos;
    }

    public static function guardarDatos(Evento $evento)
    {
        $conexion = Conexion::getInstancia()->getConexion();
        $consulta = "INSERT INTO eventos (nombre, fecha, ubicacion, asistentes, organizador) 
                     VALUES (:nombre, :fecha, :ubicacion, :asistentes, :organizador)";
        $sentencia = $conexion->prepare($consulta);


        $sentencia->bindValue(":nombre", $evento->getNombre());
        $sentencia->bindValue(":fecha", $evento->getFecha()->format('Y-m-d'));
        $sentencia->bindValue(":ubicacion", $evento->getUbicacion());
        $sentencia->bindValue(":asistentes", $evento->getAsistentes());
        $sentencia->bindValue(":organizador", $evento->getOrganizador()->getId());

        $sentencia->execute();
    }

    public static function getDatosEventos(): array
    {
        $conexion = Conexion::getInstancia()->getConexion();
        $consulta = "SELECT e.id, 
                            e.nombre, 
                            e.fecha, 
                            e.ubicacion, 
                            e.asistentes, 
                            o.nombre AS organizador_nombre,
                            o.id AS organizador_id,
                            o.dni AS organizador_dni,
                            o.contacto AS organizador_contacto
                            FROM 
                                eventos e
                            INNER JOIN 
                                organizadores o ON e.organizador_id = o.id";
        $sentencia = $conexion->query($consulta);
        $eventos = [];
        while ($row = $sentencia->fetch(PDO::FETCH_ASSOC)) {
            //Crear un objeto de tipo organizador
            $organizador = new Organizador($row['organizador_id'], $row['organizador_dni'], $row['organizador_nombre'], $row['organizador_contacto']);
            $evento = new Evento($row['id'], $row['nombre'], new DateTime($row['fecha']), $row['ubicacion'], $row['asistentes'], $organizador);
            $eventos[] = $evento;
        }
        return $eventos;
    }

    public static function getOrganizadoresPorNombre(string $nombre): ?Organizador
    {
        $organizador = null;
        $conexion = Conexion::getInstancia()->getConexion();
        $consulta = "SELECT * FROM organizadores WHERE nombre=?";
        $sentencia = $conexion->prepare($consulta);

        $sentencia->bindParam(1, $nombre);
        $sentencia->execute();

        if ($row = $sentencia->fetch(PDO::FETCH_ASSOC)) {
            $organizador = new Organizador($row['id'], $row['dni'], $row['nombre'], $row['contacto']);

        }
        return $organizador;
    }

    public static function borrarDatos(int $id)
    {
        try {

            $conexion = Conexion::getInstancia()->getConexion();
            $consulta = "DELETE FROM eventos WHERE id=?";
            $sentencia = $conexion->prepare($consulta);

            $sentencia->bindValue(1, $id);

            $sentencia->execute();
        } catch (Exception $e) {
            echo $e;
        }

    }

    public static function getOrganizadorPorId(int $id): ?Organizador
    {
        $organizador = null;
        $conexion = Conexion::getInstancia()->getConexion();
        $consulta = "SELECT * FROM organizadores WHERE id=?";
        $sentencia = $conexion->prepare($consulta);

        $sentencia->bindParam(1, $id);
        $sentencia->execute();

        if ($row = $sentencia->fetch(PDO::FETCH_ASSOC)) {
            $organizador = new Organizador($row['id'], $row['dni'], $row['nombre'], $row['contacto']);
        }

        return $organizador;
    }


}
