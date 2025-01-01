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
    <title>Mi Perfil</title>
    <link rel="stylesheet" href="./Public/Css/book.css">
</head>
<body>
<header class="Container-Nav-bar">
    <div class="div-nav-bar">
        <div class="div-logo">
            <img src="./Public/Img/milogo.png" alt="" srcset="" style="height: 22vh;">
        </div>
        <div class="div-menu-bar">
        <div class="div-menu">
                <a href="./index.php">Inicio</a>
            </div>
            <div class="div-menu">
                <a href="./index.php?category=Aventura">Aventura</a>
            </div><div class="div-menu">
                <a href="./index.php?category=Romance">Romance</a>
            </div>
            <div class="div-menu">
                <a href="./index.php?category=Ficcion">Ficcion</a>
            </div>
            <div class="div-menu">
                <a href="./index.php?category=No-Ficcion">No Ficcion</a>
            </div>
            <div class="div-menu">
                <a href="./index.php?category=Terror">Terror</a>
            </div>
            <div class="div-menu">
                <a href="./index.php?category=Ciencia">Ciencia</a>
            </div>
            <div class="div-menu">
                <a href="./index.php?category=Novelas">Novelas</a>
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
                    <img src="./uploads/Img/<?php echo $book['img']; ?>" alt="" style="width: 100%;height: 50vh;">
                    </div>
                    <div class="div-info">
                    <div class="info">
                        <h2><?php echo $book['title_book']?></h2>
                        <span>Autor: <?php echo $book['author_book']?></span>
                        <span>Editorial:<?php echo $book['publisher_book']?> </span>
                        <span>Categoria:<?php echo $book['category_book']?></span>
                        <span>Precio: <?php echo $book['price_book']?></span> 
                        <h4>Decripcion</h4>
                        <span><?php echo $book['description_book']?></span>
         
                        
                    </div>
                    
                    <?php if(isset($_COOKIE['id'])): ?>
                        <div class="div-btn-more" id="buy-book">
                            <span">Comprar</span>
                        </div>  
                    <?php else: ?>
                        <div class="div-btn-more" id="buy-book-notid">
                            <span">Comprar</span>
                        </div> 
                    <?php endif; ?>     
                    </div> 
                    
                </div>
                     
            </div>
        </div>
 
        <div class="container-login-warning" id="login-warning">
            <div class="div-content">
               <div class="header"> <h3>Inicia Sesion Para Disfrutar de este Libro </h3> <span id="exit-btn" style="font-size: x-large;cursor: pointer;">X</span></div>
                <span>Inicia sesion o registrate para comprar el libro.</span>
                <div class="div-btn-login" id="btn-signup">
                    <a href="./signin-up.php">Iniciar Sesion</a>
                </div>
                <div class="div-btn-signup" id="btn-signup">
                    <a href="./signin-up.php?signup">Registrar me</a>
                </div>
            </div>         
        </div>
   </div>

   <script src="./Public/Javascript/book.js"></script>
</body>
</html>