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
        $cookietype = $usuario['type'];
        $key = 'WcaIcbbjWowtt9Iz1MwRTqFFhl+X0cDTctO2DONphy3e5x/7oxqHm8CtGuVVU8mbJU7prryOBnywFnpOCB+OIQ';
        $hashCookie = hash_hmac('sha256', $cookieid, $key);
        $hashType = hash_hmac('sha256', $cookietype, $key);

        setcookie('id', $cookieid, time() + (60 * 60 * 24 * 365), '/', $_SERVER['HTTP_HOST'], true, true);
        setcookie('id_hash', $hashCookie, time() + (60 * 60 * 24 * 365), '/', $_SERVER['HTTP_HOST'], true, true);
        setcookie('type', $cookietype, time() + (60 * 60 * 24 * 365), '/', $_SERVER['HTTP_HOST'], true, true);
        setcookie('type_hash', $hashType, time() + (60 * 60 * 24 * 365), '/', $_SERVER['HTTP_HOST'], true, true);

        $response = array('success' => true, 'type' => $usuario['type']);
        echo json_encode($response);
        exit();
    } else {

        $response = array('success' => false, 'message' => "Correo o contraseña incorrectos");
        echo json_encode($response);
        exit();
    }
} else {

    $response = array('success' => false, 'message' => "Solicitud no válida.");
    echo json_encode($response);
    exit();
}
?>