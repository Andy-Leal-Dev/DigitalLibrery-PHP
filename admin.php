<?php
if (!isset($_COOKIE['id'])) {
    header("Location: ./index.php");
    exit();
}
?>

<?php
    include './Config/conexion.php';

    $limit = 10; // Número de resultados por página
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;


    switch ($_GET['rute']) {
        case 'books':
            $sqlBook = "SELECT * FROM books LIMIT $limit OFFSET $offset";
            $resultBook = $conn->query($sqlBook);

            $total_results_sql_Book = "SELECT COUNT(*) FROM books";
            $total_results_result_Book = $conn->query($total_results_sql_Book);
            $total_results_row_Book = $total_results_result_Book->fetch_row();
            $total_results_Book = $total_results_row_Book[0];

            $total_pages_Book = ceil($total_results_Book / $limit);
            break;

        case 'user':
            $sqlusers = "SELECT * FROM users LIMIT $limit OFFSET $offset";
            $resultusers = $conn->query($sqlusers);

            $total_results_sql_Users = "SELECT COUNT(*) FROM users";
            $total_results_result_Users = $conn->query($total_results_sql_Users);
            $total_results_row_Users = $total_results_result_Users->fetch_row();
            $total_results_Users = $total_results_row_Users[0];

            $total_pages_Users = ceil($total_results_Users / $limit);
            break;

        case 'orders':
            $sqlorders = "SELECT orders.id, orders.code_orders,orders.order_date, books.title_book, info_pay.type_wallet, orders.status FROM `orders`
            JOIN books ON books.id = orders.id_book 
            JOIN info_pay ON info_pay.id = orders.id_info_pay LIMIT $limit OFFSET $offset";
            $resulorders = $conn->query($sqlorders);

            $total_results_sql_Orders = "SELECT COUNT(*) FROM orders";
            $total_results_result_Orders = $conn->query($total_results_sql_Orders);
            $total_results_row_Orders = $total_results_result_Orders->fetch_row();
            $total_results_Orders = $total_results_row_Orders[0];

            $total_pages_Orders = ceil($total_results_Orders / $limit);
            break;

        default:
            // Default case if no valid 'rute' is provided
            break;
    }


    if (isset($_GET['search']) && isset($_GET['rute']) && $_GET['rute'] == 'books'){

        $search = $_GET['search'];

        $sqlBook = "SELECT * FROM books WHERE author_book = '$search' LIMIT $limit OFFSET $offset";
        $resultBook = $conn->query($sqlBook);

        $total_results_sql_Book = "SELECT COUNT(*) FROM books WHERE author_book = '$search'";
        $total_results_result_Book = $conn->query($total_results_sql_Book);
        $total_results_row_Book = $total_results_result_Book->fetch_row();
        $total_results_Book = $total_results_row_Book[0];

        $total_pages_Book = ceil($total_results_Book / $limit);


    } elseif(isset($_GET['search']) && isset($_GET['rute']) && $_GET['rute'] == 'user'){

        $search = $_GET['search'];

        $sqlusers = "SELECT * FROM users WHERE email = '$search' LIMIT $limit OFFSET $offset";
        $resultusers = $conn->query($sqlusers);

        $total_results_sql_Users = "SELECT COUNT(*) FROM users WHERE email = '$search'";
        $total_results_result_Users = $conn->query($total_results_sql_Users);
        $total_results_row_Users = $total_results_result_Users->fetch_row();
        $total_results_Users = $total_results_row_Users[0];

        $total_pages_Users = ceil($total_results_Users / $limit);
  


    } elseif(isset($_GET['search']) && isset($_GET['rute']) && $_GET['rute'] == 'orders'){
        
        $search = $_GET['search'];

        $sqlorders = "SELECT * FROM orders WHERE code_orders = '$search' LIMIT $limit OFFSET $offset";
        $resulorders = $conn->query($sqlorders);

        $total_results_sql_Orders = "SELECT COUNT(*) FROM orders  WHERE code_orders = '$search'";
        $total_results_result_Orders = $conn->query($total_results_sql_Orders);
        $total_results_row_Orders = $total_results_result_Orders->fetch_row();
        $total_results_Orders = $total_results_row_Orders[0];

        $total_pages_Orders = ceil($total_results_Orders / $limit);
  

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="./Public/Css/admin.css">
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
        <?php if(isset($_GET['rute']) && $_GET['rute'] == 'books'): ?>
        <div class="div-body">
            
            <div class="div-table">
                <div class="div-title">
                    <h1>Libros</h1>
                </div>
            <div class="div-search-new-book">
                <div class="search-book">
                    <input type="text" placeholder="Buscar libro" id="input_search">
                    <div class="btn-serarch" id="btn-search">
                    <span>Buscar</span>
                  
                </div>
            </div>   
                <?php if(isset($_GET['message'])){
                    $message = $_GET['message'];

                    echo "<span>$message</span>";
                }
                ?>
                <div class="btn-new-book" id="new-book">
                    <span>Nuevo Libro</span>
                </div>
            </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Editorial</th>
                            <th>Precio</th>
                            <th>Categoría</th>
                            <th>Descripcion</th>
                            <th>Fecha de Publicacion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                         <tbody>
                                <?php if ($resultBook->num_rows > 0): ?>
                                    <?php while($rowBook = $resultBook->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo $rowBook['id']; ?></td>
                                            <td><?php echo $rowBook['title_book']; ?></td>
                                            <td><?php echo $rowBook['author_book']; ?></td>
                                            <td><?php echo $rowBook['publisher_book']; ?></td>
                                            <td><?php echo $rowBook['price_book']; ?></td>
                                            <td><?php echo $rowBook['category_book']; ?></td>
                                            <td><?php echo $rowBook['description_book']; ?></td>
                                            <td><?php echo $rowBook['publication_date']; ?></td>
                                            <td>
                                                <div class="div-btn-edit">
                                                    <a href="./book_edit.php?id=<?php echo $rowBook['id']; ?>">Editar</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8">No se encontraron libros</td>
                                    </tr>
                                <?php endif; ?>
                        </tbody>
                </table>
            </div>
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?rute=books&page=<?php echo $page - 1; ?>">&laquo; Anterior</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages_Book; $i++): ?>
                        <a href="?rute=books&page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages_Book): ?>
                    <a href="?rute=books&page=<?php echo $page + 1; ?>">Siguiente &raquo;</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="div-form-new-book" id="form-new-book" >
        <form action="./Controller/new-book-controlller.php" method="post" enctype="multipart/form-data">
                <div class="div-title-form">
                    <h2>Nuevo libro</h2>
                    <span id="exit-btn" style="font-size: x-large;cursor: pointer;">X</span>
                </div>
            <div class="div-inputs">
               
                <div class="div-separtor">
                    <div class="div-input">
                        <label for="titulo">Titulo</label>
                        <div class="div-input-text">
                            <input type="text" id="titulo" name="titulo" required>
                        </div>
                    </div>
                    <div class="div-input">
                        <label for="autor">Autor</label>
                        <div class="div-input-text">
                            <input type="text" id="autor" name="autor" required>
                        </div>
                    </div>
                </div>
                <div class="div-separtor">
                    <div class="div-input">
                        <label for="editorial">Editorial</label>
                        <div class="div-input-text">
                            <input type="text" id="editorial" name="editorial" required>
                        </div>
                    </div>
                    <div class="div-input">
                        <label for="precio">Precio</label>
                        <div class="div-input-text">
                            <input type="number" id="precio" name="precio" required>
                        </div>
                    </div>
                </div>
                <div class="div-separtor">
                    <div class="div-input">
                        <label for="categoria">Categoria</label>
                        <div class="div-input-text">
                            <input type="text" id="categoria" name="categoria" required>
                        </div>
                    </div>
                    <div class="div-input">
                        <label for="fecha_publicacion">Fecha de Publicacion</label>
                        <div class="div-input-text">
                            <input type="date" id="fecha_publicacion" name="fecha_publicacion" required>
                        </div>
                    </div>
                </div>
                <div class="div-separtor">
                    <div class="div-input">
                        <label for="descripcion">Descripcion</label>
                        <div class="div-input-text-area">
                            <textarea type="text" id="descripcion" name="descripcion" required></textarea>
                        </div>
                    </div>
               
                    <div class="div-file">
                        <div class="div-input">
                            <label for="imagen">Imagen</label>
                            <input type="file" id="imagen" name="imagen" required>
                        </div>
                        <div class="div-input">
                            <label for="pdf">PDF</label>
                            <input type="file" id="pdf" name="pdf" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="div-btn">
                <button type="submit">Guardar</button>
            </div>
        </form>
        </div>
    </div>
        <?php endif;?>

        <?php if(isset($_GET['rute']) && $_GET['rute'] == 'user'): ?>  
           
        <div class="div-body">
            
            <div class="div-table">
            <div class="div-title">
                <h1>Usuarios</h1>
            </div>
            <div class="div-search-user">
                <div class="search-user">
                    <input type="text" placeholder="Buscar un Usuario" id="input_search_user" >
                    <div class="btn-serarch" id="btn-search-user">
                    <span >Buscar</span>
                </div>
                </div>   
            </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                  
                    <tbody>
                    <?php if ($resultusers->num_rows > 0): ?>
                            <?php while($rowUsers = $resultusers->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $rowUsers['id']; ?></td>
                                    <td><?php echo $rowUsers['name']; ?></td>
                                    <td><?php echo $rowUsers['lastname']; ?></td>
                                    <td><?php echo $rowUsers['email']; ?></td>
                                    <td><?php if($rowUsers['status'] == 0): ?>
                                            <?php echo 'Activo' ?>
                                        <?php else: ?>
                                            <?php echo 'Inactivo' ?>
                                         <?php endif;?>
                                    </td>
                                    <td>
                                <button>Inhabilitar</button>
                            </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8">No se encontraron Usuarios</td>
                            </tr>
                        <?php endif; ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?rute=user&page=<?php echo $page - 1; ?>">&laquo; Anterior</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages_Users; $i++): ?>
                    <a href="?rute=user&page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($page < $total_pages_Users): ?>
                    <a href="?rute=user&page=<?php echo $page + 1; ?>">Siguiente &raquo;</a>
                <?php endif; ?>
            </div>
        </div>
        
        <?php endif;?>

        <?php if(isset($_GET['rute']) && $_GET['rute'] == 'orders'): ?>  
        <div class="div-body">
            
            <div class="div-table">
            <div class="div-title">
                <h1>Compras</h1>
            </div>
            <div class="div-search-orders">
                <div class="search-orders">
                    <input type="text" placeholder="Buscar una compra" id="input_search_orders">
                    <div class="btn-serarch" id="btn-search-order">
                        <span >Buscar</span>
                    </div>
                </div>   
            </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Code Compra</th>
                            <th>Titulo del Libro</th>
                            <th>Fecha de compra</th>
                            <th>Tipo de Pago</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ($resulorders->num_rows > 0): ?>
                            <?php while($rowOrders = $resulorders->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $rowOrders['id']; ?></td>
                                    <td><?php echo $rowOrders['code_orders']; ?></td>
                                    <td><?php echo $rowOrders['title_book']; ?></td>
                                    <td><?php echo $rowOrders['order_date']; ?></td>
                                    <td><?php echo $rowOrders['type_wallet']; ?></td>
                                    <td><?php echo $rowOrders['status']; ?></td>
                                    <td>
                                        <div class="div-btn-edit">
                                            <a href="./admin.php?rute=orders&page=<?php echo $page; ?>&more&id=<?php echo $rowOrders['id']; ?>">Ver mas</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8">No se encontraron Pedidos</td>
                            </tr>
                        <?php endif; ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?rute=orders&page=<?php echo $page - 1; ?>">&laquo; Anterior</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages_Orders; $i++): ?>
                    <a href="?rute=orders&page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($page < $total_pages_Orders): ?>
                    <a href="?rute=orders&page=<?php echo $page + 1; ?>">Siguiente &raquo;</a>
                <?php endif; ?>
            </div>
        </div>  
        <?php endif;?>

        <?php if(isset($_GET['more']) && $_GET['id']): ?> 
            <?php
                $idOrders = $_GET['id'];
                $sqlFind = 'SELECT COUNT(*) as count FROM `orders` WHERE id = ?';
                $stmt = $conn->prepare($sqlFind);
                $stmt->bind_param("i", $idOrders);
                $stmt->execute();
                $resultFind = $stmt->get_result();
                $rowFind = $resultFind->fetch_assoc();
                if($rowFind['count'] >= 1){
                    $stmt = $conn->prepare('SELECT users.name AS user_name, users.lastname AS user_lastname, users.email, info_pay.name AS pay_name, info_pay.lastname AS pay_lastname, info_pay.direction, info_pay.num_wallet, info_pay.date_wallet, info_pay.cvc_wallet, info_pay.type_wallet, books.title_book, books.author_book, books.publisher_book, books.price_book, books.description_book, books.category_book, books.publication_date FROM `orders` JOIN books ON books.id = orders.id_book JOIN info_pay ON info_pay.id = orders.id_info_pay JOIN users ON users.id = orders.id_user WHERE orders.id = ?');
                    $stmt->bind_param('i', $idOrders);
                    $stmt->execute();
                    $resultOrderInfo = $stmt->get_result();
                    $orderInfo = $resultOrderInfo->fetch_assoc();
                } else{
                    header("Location: ./admin.php?rute=orders&page=$page");
                }
                
               
            ?>
            <div class="container-more-info">
                <div class="div-title-form">
                    <h2>Mas Informacion de la Compra</h2>
                    <a href="./admin.php?rute=orders&page=<?php echo $page; ?>" style="font-size: x-large;cursor: pointer;  outline: none;text-decoration: none;color: #ffff;">X</a>
                </div>
                <div class="info-user">
                    <h4>Informacion del Usuario</h4>
                    <span>Nombre: <?php echo $orderInfo['user_name']; ?></span>
                    <span>Apellido: <?php echo $orderInfo['user_lastname']; ?></span>
                    <span>Correo: <?php echo $orderInfo['email']; ?></span>
                </div>
                <div class="info-pay">
                    <h4>Informacion de Pago:</h4>
                    <span>Nombre Propietario: <?php echo $orderInfo['pay_name']; ?></span>
                    <span>Apellido Propietario: <?php echo $orderInfo['pay_lastname']; ?></span>
                    <span>Direccion de Cobro: <?php echo $orderInfo['direction']; ?></span>
                    <span>Numero de la tarjeta: <?php echo $orderInfo['num_wallet']; ?></span>
                    <span>Fecha de Vencimiento: <?php echo $orderInfo['date_wallet']; ?></span>
                    <span>CVC: <?php echo $orderInfo['cvc_wallet']; ?></span>
                    <span>Tipo de Tarjeta: <?php echo $orderInfo['type_wallet']; ?></span>
                </div>
                <div class="info-book">
                    <h4>Informacion del libro comprado</h4>
                    <span>Titulo: <?php echo $orderInfo['title_book']; ?></span>
                    <span>Autor: <?php echo $orderInfo['author_book']; ?></span>
                    <span>Editorial: <?php echo $orderInfo['publisher_book']; ?></span>
                    <span>Precio: <?php echo $orderInfo['price_book']; ?></span>
                    <span>Descripcion: <?php echo $orderInfo['description_book']; ?></span>
                    <span>Categoria: <?php echo $orderInfo['category_book']; ?></span>
                    <span>Fecha de Publicacion: <?php echo $orderInfo['publication_date']; ?></span>
                </div>
            </div>
        <?php endif;?>
    </div>


<script >
<?php if(isset($_GET['rute']) && $_GET['rute'] == 'books'): ?>

document.getElementById('btn-search').addEventListener('click', ()=> {
    const input = document.getElementById('input_search').value;
    if(input){
        window.location.href = `admin.php?rute=books&page=1&search=${input}`
    }
})

document.getElementById('exit-btn').addEventListener('click', ()=> {
    document.getElementById('form-new-book').style.display="none";
})

document.getElementById('new-book').addEventListener('click', ()=> {
    document.getElementById('form-new-book').style.display="flex";
})

<?php endif;?>

<?php if(isset($_GET['rute']) && $_GET['rute'] == 'user'): ?>  
document.getElementById('btn-search-user').addEventListener('click', ()=> {
    const input = document.getElementById('input_search_user').value;
    if(input){
        window.location.href = `admin.php?rute=user&page=1&search=${input}`
    }
})
<?php endif;?>

<?php if(isset($_GET['rute']) && $_GET['rute'] == 'orders'): ?>  
document.getElementById('btn-search-order').addEventListener('click', ()=> {
    const input = document.getElementById('input_search_orders').value;
    if(input){
        window.location.href = `admin.php?rute=orders&page=1&search=${input}`
    }
})

<?php endif;?>

</script>
</body>
</html>