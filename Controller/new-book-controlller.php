<?php

    include './Config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editorial = $_POST['editorial'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];
    $fecha_publicacion = $_POST['fecha_publicacion'];
    $imagen = $_FILES['imagen']['name'];
    $pdf = $_FILES['pdf']['name'];

    // Move uploaded files to a designated directory
    move_uploaded_file($_FILES['imagen']['tmp_name'], "uploads/" . $imagen);
    move_uploaded_file($_FILES['pdf']['tmp_name'], "uploads/" . $pdf);

 
    $sql = "INSERT INTO books (title_book, author_book, publisher_book, price_book, category_book, description_book, publication_date, img, pdf) 
            VALUES ('$titulo', '$autor', '$editorial', '$precio', '$categoria', '$descripcion', '$fecha_publicacion', '$imagen', '$pdf')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo libro agregado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
?>