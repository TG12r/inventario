<?php
include 'include/db.php';
include 'include/finanzas.php';
include 'include/inventario.php';

$inventario = new inventario();
print_r($inventario->verOperaciones())

?>
