<?php
include "../Config/conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['email'];
    $contrasena = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    if ($usuario && password_verify($contrasena, $usuario['pass'])) {
        $cookieid = $usuario['id'];
        setcookie('id', $cookieid, time() + (60 * 60 * 24 * 365), '/', $_SERVER['HTTP_HOST'], true, true); // Secure and HttpOnly flags
       
        // Respuesta JSON para éxito
        $response = array('success' => true, 'type' => $usuario['type']);
        echo json_encode($response);
        exit();
    } else {
        // Respuesta JSON para error
        $response = array('success' => false, 'message' => "Correo o contraseña incorrectos");
        echo json_encode($response);
        exit();
    }
} else {
    // Manejar solicitudes que no son POST (opcional, pero recomendado)
    $response = array('success' => false, 'message' => "Solicitud no válida.");
    echo json_encode($response);
    exit();
}
?>