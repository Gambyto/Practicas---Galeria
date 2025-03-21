<?php

require_once 'Galeria.php';
require_once 'db.php';

$db = new DB();
$galeria = new Galeria($db);

if (isset($_POST['agregarImagen'])) {
    $imagen = $_FILES['imagen'];
    $descripcion = $_POST['descripcion'];
    $galeria->agregarImagen($imagen, $descripcion);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Galería de Imágenes</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <h1>Galería de Imágenes</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="imagen">
        <input type="text" name="descripcion" placeholder="Descripción de la imagen">
        <button type="submit" name="agregarImagen">Agregar imagen</button>
    </form>

    <div class="galeria">

        <?php $galeria->mostrarGaleria(); ?>
        
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
            $(document).ready(function() {
                $('a').on('click', function(e) {
                    e.preventDefault();
                    var ruta = $(this).data('ruta');
                    $.ajax({
                        type: 'POST',
                        url: 'mostrarImagenGrande.php',
                        data: {ruta: ruta},
                        success: function(data) {
                        $('body').append('<div class="large-image-container"><img src="' + ruta + '" alt=""><button class="close-large-image">Cerrar</button></div>');
                        $('.large-image-container').fadeIn();
                    }
                });
            });
            
            $(document).on('click', '.close-large-image', function() {
                $('.large-image-container').fadeOut(function() {
                    $(this).remove();
                });
            });
        });
        </script>
</div>

</body>
</html>