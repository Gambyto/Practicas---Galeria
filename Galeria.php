<?php

class Galeria {
    private $db;
    private $imagenes;

    public function __construct($db) {
        $this->db = $db;
        $this->imagenes = array();
    }

    public function agregarImagen($imagen, $descripcion) {
        $rutaImagen = $this->subirImagen($imagen);
        $this->db->query("INSERT INTO imagenes (ruta, descripcion) VALUES ('$rutaImagen', '$descripcion')");
        $this->imagenes[] = array('ruta' => $rutaImagen, 'descripcion' => $descripcion);
    }

    public function mostrarGaleria() {
        $sql = "SELECT * FROM imagenes";
        $result = $this->db->query($sql);

        if (!$result) {
            throw new Exception("Error al ejecutar la consulta: " . $this->db->error);
        }
            while ($row = $result->fetch_assoc()) {
            echo '<a href="#" data-ruta="' . $row['ruta'] . '"><img src="' . $row['ruta'] . '" alt="' . $row['descripcion'] . '"></a>';
        }
    }

    private function subirImagen($imagen) {
        $rutaImagen = 'imagenes/' . uniqid() . '.' . pathinfo($imagen['name'], PATHINFO_EXTENSION);
        move_uploaded_file($imagen['tmp_name'], $rutaImagen);
        return $rutaImagen;
    }
}

?>