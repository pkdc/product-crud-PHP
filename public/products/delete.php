<?php

require_once "../../database.php";

    $id = $_POST['id'] ?? NULL;
    
    if(!$id) {
        header("Location:index.php");
        exit;
    }

    $stmt = $pdo->prepare('DELETE FROM products WHERE id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    header('Location: index.php');
    // echo '<pre>';
    // var_dump($id);
    // echo '</pre>';
    
?>