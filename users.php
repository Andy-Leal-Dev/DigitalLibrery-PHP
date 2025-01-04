<?php
if (!isset($_COOKIE['id'])) {
    header("Location: ./index.php");
    exit();
}
?>

<?php
 include './Config/conexion.php';
          if(isset($_COOKIE['id'])){
            $sql = "SELECT name, lastname FROM users WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s",$_COOKIE['id']);
            $stmt->execute();
            $resultU = $stmt->get_result();
            $usuario = $resultU->fetch_assoc();
            $nombre = $usuario['name'];
            $apellido = $usuario['lastname'];

            $iduser = $_COOKIE['id'];
            $sql = "SELECT books.id, books.img, books.title_book, books.author_book, books.category_book  FROM books JOIN orders ON orders.id_book = books.id JOIN users ON users.id = orders.id_user WHERE users.id = '$iduser'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $resultBook = $stmt->get_result();

           
          } 
          
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <link rel="stylesheet" href="./Public/Css/user.css">
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
        <div class="container-new-book">
        
          <h2><?php echo "¡Hola Bienvenido, $nombre $apellido ! " ?></h2>
            
                <div class="div-new-books">
                <?php if ($resultBook->num_rows > 0): ?>
                    <?php while($rowBook = $resultBook->fetch_assoc()): ?>
                    <div class="new-book">
                            <div class="div-img-book">
                                <img src="./uploads/Img/<?php echo $rowBook['img']; ?>" alt="" style="width: 100%;height: 30vh;">
                            </div>
                            <div class="div-info">
                                <h3><?php echo htmlspecialchars($rowBook['title_book']); ?></h3>
                                <span>Categoria: <?php echo htmlspecialchars($rowBook['category_book']); ?></span>
                            </div>
                            <div class="div-btn-more">
                                <a href="./users.php?ReedBook=true&id=<?php echo $rowBook['id']; ?>">Leer</a>
                            </div>
                    </div>
                    <?php endwhile; ?>
                    <?php else: ?>
                        <p>No se encontraron libros</p>
                    <?php endif; ?> 
     
                </div>
        </div>
        <?php if(isset($_GET['ReedBook']) && $_GET['ReedBook'] == 'true'):?>
            <?php 
            $idUser = $_COOKIE['id'];
            $idBook = $_GET['id'];
            $sqlBookFind = "SELECT COUNT(*) as count FROM books JOIN orders ON orders.id_book = books.id JOIN users ON users.id = orders.id_user WHERE books.id = ? AND users.id = ?;";
            $stmt = $conn->prepare($sqlBookFind);
            $stmt->bind_param("ii", $idBook, $idUser);
            $stmt->execute();
            $resultReed = $stmt->get_result();
            $rowReed = $resultReed->fetch_assoc();
            ?>

            <?php if($rowReed['count'] >= 1):?>
                <?php
                    $sql = "SELECT pdf FROM books WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $idBook);
                    $stmt->execute();
                    $resultPDF = $stmt->get_result();
                    $rowPDF = $resultPDF->fetch_assoc();
                    ?>                
            <div class="Continer-Read-Book" id="reed-book">
                    <div class="header">
                        <span id="exit-btn" style="font-size: x-large;cursor: pointer;">X</span>
                    </div>

                    <div class="body">
                        <embed  src="uploads/PDF/<?php echo $rowPDF?>" type="application/pdf" style="width: 100%;height: 100%;" ></embed>
                    </div>
                </div>
                <script>
                    document.getElementById('exit-btn').addEventListener('click',()=>{
                        document.getElementById('reed-book').style.display="none";
                 });
                </script>
            <?php else: ?>
                <?php
                    header("Location: ./users.php");
                    exit();
                ?>
            <?php endif; ?>
            
        <?php endif; ?>   
   </div>
</body>
</html>