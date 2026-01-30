<?php
    class Organizador{
        private int $id;
        private string $dni;
        private string $nombre;
        private string $contacto;

        public function __construct(int $id, string $dni, string $nombre, string $contacto)
        {
            $this->id = $id;
            $this->dni = $dni;
            $this->nombre = $nombre;
            $this->contacto = $contacto;

        }
        
        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;

        }

        public function getDni()
        {
                return $this->dni;
        }

        public function setDni($dni)
        {
                $this->dni = $dni;
        }

        public function getNombre()
        {
                return $this->nombre;
        }

        public function setNombre($nombre)
        {
                $this->nombre = $nombre;
        }

        public function getContacto()
        {
                return $this->contacto;
        }

        public function setContacto($contacto)
        {
                $this->contacto = $contacto;
        }
    }
?>