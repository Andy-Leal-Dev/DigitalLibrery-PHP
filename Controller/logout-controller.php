<?php

// Establecer la cookie con una fecha de expiración en el pasado para eliminarla
setcookie('id', '', time() - 3600, '/');
setcookie('type', '', time() - 3600, '/');

// Asegurarse de que las cookies se eliminen del array $_COOKIE
unset($_COOKIE['id']);
unset($_COOKIE['type']);

// Redirigir al usuario al index.php
header('Location: /DigitalLibrary/index.php');
exit();
?>