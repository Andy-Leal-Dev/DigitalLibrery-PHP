<?php
if (!isset($_COOKIE['id'])) {
    header("Location: ./index.php");
    exit();
}
?>

<?php
          if(isset($_COOKIE['id'])){
            include './Config/conexion.php';
            $sql = "SELECT name, lastname FROM users WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s",$_COOKIE['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $usuario = $result->fetch_assoc();
            $nombre = $usuario['name'];
            $apellido = $usuario['lastname'];

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
                     <div class="new-book">
                           <div class="div-img-book">

                           </div>
                           <div class="div-info">
                               <h3>Nombre del libro</h3>
                               <span>Categoria</span>
                                   
                           </div> 
                           <div class="div-btn-more">
                                <button>Leer</button>
                           </div>
                     </div>
                     
          </div>
   </div>
</body>
</html>