<?php 
    include "../Config/conexion.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $titulo = !empty($_POST['title_book']) ? $_POST['title_book'] : null;
        $autor = !empty($_POST['author_book']) ? $_POST['author_book'] : null;
        $editorial = !empty($_POST['publisher_book']) ? $_POST['publisher_book'] : null;
        $precio = !empty($_POST['price_book']) ? $_POST['price_book'] : null;
        $categoria = !empty($_POST['category_book']) ? $_POST['category_book'] : null;
        $date = !empty($_POST['publication_date']) ? $_POST['publication_date'] : null;
        $descripcion = !empty($_POST['description_book']) ? $_POST['description_book'] : null;
    
        $fields = [];
        $params = [];
        $types = '';
    
        if ($titulo !== null) {
            $fields[] = 'title_book = ?';
            $params[] = $titulo;
            $types .= 's';
        }
        if ($autor !== null) {
            $fields[] = 'author_book = ?';
            $params[] = $autor;
            $types .= 's';
        }
        if ($editorial !== null) {
            $fields[] = 'publisher_book = ?';
            $params[] = $editorial;
            $types .= 's';
        }
        if ($precio !== null) {
            $fields[] = 'price_book = ?';
            $params[] = $precio;
            $types .= 's';
        }
        if ($descripcion !== null) {
            $fields[] = 'description_book = ?';
            $params[] = $descripcion;
            $types .= 's';
        }
        if ($categoria !== null) {
            $fields[] = 'category_book = ?';
            $params[] = $categoria;
            $types .= 's';
        }
        if ($date !== null) {
            $fields[] = 'publication_date = ?';
            $params[] = $date;
            $types .= 's';
        }
    
        $params[] = $id;
        $types .= 'i';
    
        if (!empty($fields)) {
            $sql = "UPDATE books SET " . implode(', ', $fields) . " WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
    
            if ($stmt->affected_rows > 0) {
                $response = array('success' => true);
                echo json_encode($response);
            } else {
                $response = array('success' => false, 'message' => "No se pudo editar el libro");
                echo json_encode($response);
            }
            $stmt->close();
        } else {
            $response = array('success' => false, 'message' => "No se proporcionaron datos para actualizar");
            echo json_encode($response);
        }
        $conn->close();
        

    }
?>