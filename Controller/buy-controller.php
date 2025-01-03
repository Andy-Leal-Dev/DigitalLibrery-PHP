<?php
    include '../Config/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_book = $_GET['id'];
    $id_user = $_COOKIE['id'];
    $nombre = $_POST['name'];
    $apellido = $_POST['lastname'];
    $direccion = $_POST['direction'];
    $numeroTarjeta = $_POST['num_wallet'];
    $MM = $_POST['MM_wallet'];
    $AA = $_POST['AA_wallet'];
    $cvc = $_POST['cvc_wallet'];
    $tipo = $_POST['type_wallet'];
    $date = "$MM/$AA";
    $codigo = mt_rand(100000, 999999);
    $order_date = date("Y-m-d");
    $status = 1;

    $sql = "INSERT INTO info_pay (name, lastname, direction, num_wallet, date_wallet, cvc_wallet, type_wallet, id_user) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"; 
    $stmt = $conn->prepare($sql); 
    $stmt->execute([$nombre, $apellido, $direccion, $numeroTarjeta, $date, $cvc, $tipo, $id_user]); 
    $id_pay = $conn->insert_id; 

    if($id_pay){
        $sql = "INSERT INTO orders (code_orders, id_user, id_book, order_date,id_info_pay, status) VALUES (?, ?, ?, ?,?,?)"; 
        $stmt = $conn->prepare($sql); 
        $stmt->execute([$codigo, $id_user, $id_book, $order_date, $id_pay, $status ]); 
        $id_buy = $conn->insert_id; 
        if($id_buy){
            header("Location: /DigitalLibrary/book.php?id=$id_book&messageBuy=true");
        } else{
            header("Location: /DigitalLibrary/book.php?id=$id_book&messageBuy=false");
        }
    }
}
?>