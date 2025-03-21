<?php

require_once 'Galeria.php';
require_once 'db.php';

$db = new DB();
$galeria = new Galeria($db);

$ruta = $_POST['ruta'];

echo '<div class="imagen-grande">';
echo '<img src="' . $ruta . '">';
echo '</div>';

?>