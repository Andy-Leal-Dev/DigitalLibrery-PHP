<?php
     include "../Config/conexion.php";

     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(  strlen($_POST['nombre']) >=2 &&
        strlen($_POST['apellido']) >=2 &&
        strlen($_POST['email']) >=2 &&
        strlen($_POST['password']) >=2 ){

            $nameUser = trim($_POST['nombre']);
            $Lastname = trim($_POST['apellido']);
            $email = trim($_POST['email']);
            $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
            $tipo = 1;  


            $sql = "INSERT INTO users (name, lastname, email,pass, type) VALUES (?, ?, ?,?,? )"; 
            $stmt = $conn->prepare($sql); 
            $stmt->execute([$nameUser,$Lastname, $email, $password, $tipo]); 
            $id_user = $conn->insert_id; 
            if ($id_user) { 
                $cookieid = $id_user;
                $cookietype = $tipo;
                $key = 'WcaIcbbjWowtt9Iz1MwRTqFFhl+X0cDTctO2DONphy3e5x/7oxqHm8CtGuVVU8mbJU7prryOBnywFnpOCB+OIQ';
                $hashCookie = hash_hmac('sha256', $cookieid, $key);
                $hashType = hash_hmac('sha256', $cookietype, $key);

                setcookie('id', $cookieid, time() + (60 * 60 * 24 * 365), '/', $_SERVER['HTTP_HOST'], true, true);
                setcookie('id_hash', $hashCookie, time() + (60 * 60 * 24 * 365), '/', $_SERVER['HTTP_HOST'], true, true);
                setcookie('type', $cookietype, time() + (60 * 60 * 24 * 365), '/', $_SERVER['HTTP_HOST'], true, true);
                setcookie('type_hash', $hashType, time() + (60 * 60 * 24 * 365), '/', $_SERVER['HTTP_HOST'], true, true);

              
                $referred = isset($_COOKIE['id']);
                if(!$referred){
                    echo "no hay cokie";
                } else{
                    header('Location: /DigitalLibrary/index.php');
                }
             } 
        }
    }
     
?>