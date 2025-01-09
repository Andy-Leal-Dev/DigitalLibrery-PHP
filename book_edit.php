<?php
if (!isset($_COOKIE['id'])) {
    header("Location: ./index.php");
    exit();
}
if (isset($_COOKIE['id']) && isset($_COOKIE['id_hash']) && isset($_COOKIE['type']) && isset($_COOKIE['type_hash'])) {
    $id = $_COOKIE['id'];
    $hash_id = $_COOKIE['id_hash'];
    $type = $_COOKIE['type'];
    $hash_type = $_COOKIE['type_hash'];
    $key = 'WcaIcbbjWowtt9Iz1MwRTqFFhl+X0cDTctO2DONphy3e5x/7oxqHm8CtGuVVU8mbJU7prryOBnywFnpOCB+OIQ';

    $expectedHashid = hash_hmac('sha256', $id, $key);
    $expectedHashtype = hash_hmac('sha256', $type, $key);

    if (!hash_equals($expectedHashid, $hash_id) || !hash_equals($expectedHashtype, $hash_type)) {
        setcookie('id', '', time() - 3600, '/');
        setcookie('id_hash', '', time() - 3600, '/');
        setcookie('type', '', time() - 3600, '/');
        setcookie('type_hash', '', time() - 3600, '/');

        unset($_COOKIE['id']);
        unset($_COOKIE['id_hash']);
        unset($_COOKIE['type']);
        unset($_COOKIE['type_hash']);

        header('Location: /DigitalLibrary/index.php');
        exit();
    }
    }
?>


<?php
    include './Config/conexion.php';
    
    $idbook = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->bind_param("i", $idbook);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar LIbro</title>
    <link rel="stylesheet" href="./Public/Css/bookedit.css">
</head>
<body>
<header class="Container-nav-bar">
        <div class="div-nav-bar">
            <div class="div-logo">
                <img src="./Public/Img/milogo.png" alt="" srcset="" style="height: 15vh;">
            </div>
            <div class="div-menu-bar">
            <div class="div-menu">
                <a href="./admin.php?rute=books&page=1">Libros</a>
            </div>
            <div class="div-menu">
                <a href="./admin.php?rute=user&page=1">Usuarios</a>
            </div><div class="div-menu">
                <a href="./admin.php?rute=orders&page=1">Compras</a>
            </div>
            <div class="div-menu">
            <a href="./Controller/logout-controller.php"><img src="./Public/Img/loguot.png" style="width: 4vh;" alt="" srcset=""></a>
            </div>
            </div>
        </div>
    </header>

    <div class="Contanier-body">
        <div class="container-book">
            <div class="div-book">
                 <div class="book">
                    <div class="div-img-book">
                    <img src="./uploads/Img/<?php echo $book['img']; ?>" alt="" style="width: 100%;height: 60vh;">
                    </div>
                    <form class="div-info"  id="form-edit" data-id="<?php echo $idbook; ?>">
                        <input type="hidden" value="<?php echo $idbook; ?>" name="id">
                        <div class="info">
                            <div class="div-input">
                                <label for="titulo">Titulo</label>
                                <div class="div-input-text">
                                    <input type="text" id="titulo" placeholder="<?php echo $book['title_book']?>" name="title_book" >
                                </div>
                            </div>
                            <div class="div-input">
                                <label for="autor">Autor</label>
                                <div class="div-input-text">
                                    <input type="text" id="autor" placeholder="<?php echo $book['author_book']?>" name="author_book" >
                                </div>
                            </div>
                            <div class="div-input">
                                <label for="editorial">Editorial</label>
                                <div class="div-input-text">
                                    <input type="text" id="editorial" placeholder="<?php echo $book['publisher_book']?>" name="publisher_book" >
                                </div>
                            </div>
                            <div class="div-input">
                                <label for="precio">Precio</label>
                                <div class="div-input-text">
                                    <input type="number" id="precio" placeholder="<?php echo $book['price_book']?>" name="price_book" >
                                </div>
                            </div>
                            <div class="div-input">
                                <label for="categoria">Categoria</label>
                                <div class="div-input-text">
                                    <input type="text" id="categoria" placeholder="<?php echo $book['category_book']?>" name="category_book" >
                                </div>
                            </div>
                            <div class="div-input">
                                <label for="fecha_publicacion">Fecha de Publicacion</label>
                                <div class="div-input-text">
                                    <input type="date" id="fecha_publicacion" placeholder="<?php echo $book['publication_date']?>" name="publication_date" >
                                </div>
                            </div>
                            <div class="div-input">
                                <label for="descripcion">Descripcion</label>
                                <div class="div-input-text-area">
                                    <textarea type="text" id="descripcion" placeholder="<?php echo $book['description_book']?>" name="description_book" ></textarea>
                                </div>
                            </div>
               
                        </div>
                    
                    <div class="div-btn-edit" id="btn-edit">
                        <span>Editar</span>
                    </div>    
                    </form> 
                    
                </div>
                     
            </div>
        </div>
   </div>
   <script src="./Public/Javascript/edit-book.js"></script>
</body>
</html>