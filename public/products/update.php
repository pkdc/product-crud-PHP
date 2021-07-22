<?php

require_once "../../database.php";
require_once "../../functions.php";
// echo '<pre>';
//     echo var_dump($_SERVER);
//     echo '</pre>';
    
$id = $_GET['id'] ?? NULL;

if(!$id) {
    // header('LOCATION: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE id=:id");
$stmt->bindValue(':id', $id);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// echo '<pre>';
// echo var_dump($product);
// echo '</pre>';
// exit;
?>

  <?php 
    // echo '<pre>';
    // // echo var_dump($_POST);
    // var_dump($_FILES);
    // echo '</pre>';
    // var_dump($_SERVER['REQUEST_METHOD']);

    $errors = [];

    $title = $product['title'];
    $description = $product['description'];
    $price =$product['price'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      require_once "../../validate_product.php";
      
      // if no errors
      if(empty($errors)) {  

        $stmt = $pdo->prepare("UPDATE products SET title = :title, image = :image,
                          description = :description, price = :price WHERE id = :id");
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':image', $imagePath);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        header('Location: index.php');
        }
      }
  ?>
    <?php include_once "../../views/partials/header.php"; ?>
    <p>
      <a href="index.php" class="btn btn-secondary">Index Page</a>
    </p>
    <h1>Update Product <?php echo $product['title'] ?></h1>
    <?php include_once "../../views/products/form.php"; ?>
    <?php include_once "../../views/partials/footer.php"; ?>