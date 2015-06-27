<?php
unset($_COOKIE['id_usuario']);
setcookie('id_usuario', NULL, -1);
unset($_COOKIE['nombre_usuario']);
setcookie('nombre_usuario', NULL, -1);
header('Location: index.php');
?>