<?php
    include './Config/conexion.php';

    if(isset($_GET['category'])){

        $category = $_GET['category'];
        $sqlBookCategory = "SELECT * FROM books WHERE category_book LIKE '$category' ";
        $resultCategory= $conn->query($sqlBookCategory);

    } else{

        $sqldate = "SELECT * FROM books ORDER BY publication_date DESC LIMIT 10 ";
        $resultDate = $conn->query($sqldate);

        $sqlbookAuthor = "SELECT * FROM books WHERE author_book = 'J.R.R. Tolkien' LIMIT 8 ";
        $resultAuthor = $conn->query($sqlbookAuthor);

    }

   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Library</title>
    <link rel="stylesheet" href="./Public/Css/index.css">
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
                <a href="./index.php?category=Fantasia">Fantasia</a>
            </div>
            <div class="div-menu">
                <a href="./index.php?category=Ficcion">Ficcion</a>
            </div>
            <div class="div-menu">
                <a href="./index.php?category=No Ficcion">No Ficcion</a>
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
          <?php
          if(isset($_COOKIE['id'])){
            include './Config/conexion.php';
            $sql = "SELECT name FROM users WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s",$_COOKIE['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $usuario = $result->fetch_assoc();
            $nombre = $usuario['name'];

            echo "<div class='div-menu'>
            <a href='./users.php'>¡Hola, $nombre! </a>
            </div>";

            echo '<div class="div-menu">
            <a href="./Controller/logout-controller.php"><img src="./Public/Img/loguot.png" style="width: 4vh;" alt="" srcset=""></a>
            </div>';
          } else{
              echo '<div class="div-menu">
              <a href="./signin-up.php">Iniciar Sesion</a>
          </div>';
        };
          
          ?>
          
        </div>
    </div>
   </header>
   <div class="Contanier-body">
        <?php if(isset($_GET['category'])): ?>
            <?php
                $category = $_GET['category'];
                
                echo "<div class='container-new-book'>
                    
                <h2>$category</h2>";
            ?>
                <div class='div-category-books'>
                <?php if ($resultCategory->num_rows > 0): ?>
                <?php while($row = $resultCategory->fetch_assoc()): ?>
                    <div class="new-book">
                        <div class="div-img-book">
                            <img src="./uploads/Img/<?php echo $row['img']; ?>" alt="" style="width: 100%;height: 30vh;">
                        </div>
                        <div class="div-info">
                            <h3><?php echo htmlspecialchars($row['title_book']); ?></h3>
                            <span>Categoria: <?php echo htmlspecialchars($row['category_book']); ?></span>
                            <span>Precio: $<?php echo htmlspecialchars($row['price_book']); ?></span>
                        </div>
                        <div class="div-btn-more">
                            <a href="./book.php?id=<?php echo $row['id']; ?>">Ver más</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No se encontraron libros en esta categoría.</p>
            <?php endif; ?>      
          </div>
        </div>
        <?php else: ?>  
           
            <div class="container-new-book slider-container">
                <h2>Nuevos Libros</h2>
                <div class="slider-wrapper">
                    <button class="slider-button prev" onclick="showPrevSlide()">&#10094;</button>
                    <div class="div-new-books slider">
                        <?php if ($resultDate->num_rows > 0): ?>
                        <?php while($rowDate = $resultDate->fetch_assoc()): ?>
                        <div class="new-book slide">
                                <div class="div-img-book">
                                    <img src="./uploads/Img/<?php echo $rowDate['img']; ?>" alt="" style="width: 100%;height: 30vh;">
                                </div>
                                <div class="div-info">
                                    <h3><?php echo htmlspecialchars($rowDate['title_book']); ?></h3>
                                    <span>Categoria: <?php echo htmlspecialchars($rowDate['category_book']); ?></span>
                                    <span>Precio: $<?php echo htmlspecialchars($rowDate['price_book']); ?></span>
                                </div>
                                <div class="div-btn-more">
                                    <a href="./book.php?id=<?php echo $rowDate['id']; ?>">Ver más</a>
                                </div>
                        </div>
                        <?php endwhile; ?>
                        <?php else: ?>
                            <p>No se encontraron libros en esta categoría.</p>
                        <?php endif; ?>   
                    </div>
                    <button class="slider-button next" onclick="showNextSlide()">&#10095;</button>
                </div>
            </div>

        

    
        </div>
          <div class="container-popular-book">
            <h2>Libros Populares</h2>
                <div class="div-new-books">
                     <div class="new-book">
                           <div class="div-img-book">
                           <img src="./uploads/Img/<?php echo $row['img']; ?>" alt="" style="width: 100%;height: 30vh;">
                           </div>
                           <div class="div-info">
                               <h3>Nombre del libro</h3>
                               <span>Categoria</span>
                               <span>Precio: 2$</span>     
                           </div> 
                           <div class="div-btn-more">
                           <a href="">Ver mas</a>
                           </div>
                     </div>
                  
                </div>
          </div>
          <div class="container-sage-book slider-container">
            <h2>Saga del J.R.R. Tolkien</h2>
            <div  class="slider-wrapper">
                <button class="slider-button prev" onclick="showPrevSlide()">&#10094;</button>
                <div class="div-new-books slider">
                    <?php if ($resultAuthor->num_rows > 0): ?>
                    <?php while($rowAuthor = $resultAuthor->fetch_assoc()): ?>
                    <div class="new-book slide">
                            <div class="div-img-book">
                                <img src="./uploads/Img/<?php echo $rowAuthor['img']; ?>" alt="" style="width: 100%;height: 30vh;">
                            </div>
                            <div class="div-info">
                                <h3><?php echo htmlspecialchars($rowAuthor['title_book']); ?></h3>
                                <span>Categoria: <?php echo htmlspecialchars($rowAuthor['category_book']); ?></span>
                                <span>Precio: $<?php echo htmlspecialchars($rowAuthor['price_book']); ?></span>
                            </div>
                            <div class="div-btn-more">
                                <a href="./book.php?id=<?php echo $rowAuthor['id']; ?>">Ver más</a>
                            </div>
                    </div>
                    <?php endwhile; ?>
                    <?php else: ?>
                        <p>No se encontraron libros en esta categoría.</p>
                    <?php endif; ?>   
                </div>  
                <button class="slider-button next" onclick="showNextSlide()">&#10095;</button>
            </div>
        </div>
        
        
        <?php endif;?>


        
    </div>

   
    <footer class="foote-info">
            <span>© 2024 Digital Library. Todos los derechos reservados.</span>
            <span>¿Quieres que tu libro se publique aqui? <a href="">Contactate con nosotros</a></span>
    </footer>

    <script>
            let currentIndex = 0;

            function showNextSlide() {
                const slider = document.querySelector('.slider');
                const slides = document.querySelectorAll('.slide');
                currentIndex = (currentIndex + 1) % slides.length;
                slider.style.transform = `translateX(-${currentIndex * 100 / slides.length}%)`;
            }

            function showPrevSlide() {
                const slider = document.querySelector('.slider');
                const slides = document.querySelectorAll('.slide');
                currentIndex = (currentIndex - 1 + slides.length) % slides.length;
                slider.style.transform = `translateX(-${currentIndex * 100 / slides.length}%)`;
            }

            setInterval(showNextSlide, 3000);
            </script>
</body>
</html>