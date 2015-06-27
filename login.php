<?php
include_once('parametros.php');
include_once('class/class.DBPDO.php');
$DB = new DBPDO();

$sql = "SELECT * FROM usuarios WHERE usuario='" . $_POST['usuario'] . "' AND contrasena='" . $_POST['contrasena'] . "'";
$usuarios = $DB->fetch($sql);
if (!empty($usuarios)) {
    setcookie("id_usuario", $usuarios['id']);
    setcookie("nombre_usuario", $usuarios['descripcion']);
    header('Location: index.php');
} else {
    header('Location: index.php?err=1');
}
?>