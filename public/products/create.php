<?php

  require_once "../../database.php";
  require_once "../../functions.php";
// echo '<pre>';
//     echo var_dump($_SERVER);
//     echo '</pre>';
    
?>

<?php include_once "../../views/partials/header.php"; ?>
  <?php 
    // echo '<pre>';
    // // echo var_dump($_POST);
    // var_dump($_FILES);
    // echo '</pre>';
    // var_dump($_SERVER['REQUEST_METHOD']);

    $errors = [];

    $title ='';
    $price = '';
    $description ='';
    $product = [
      'image' => ''
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      require_once "../../validate_product.php";
      // if no errors
      if(empty($errors)) {

        $stmt = $pdo->prepare("INSERT INTO products (title, image, description, price, create_date)
                    VALUES (:title, :image, :description, :price, :date)");
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':image', $imagePath);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':date', date('Y-m-d H:i:s'));
        $stmt->execute();

        header('Location: index.php');
        }
      }


  ?>
    <h1>Create new Product</h1>
    <p>
     <a href="index.php" class="btn btn-secondary">Index Page</a>
    </p>
    <?php include_once "../../views/products/form.php"; ?>
    <?php include_once "../../views/partials/footer.php"; ?>