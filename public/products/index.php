<?php

require_once "../../database.php";

// select
$search = $_GET['search'] ?? '';
echo $search;
if ($search) {
  $stmt = $pdo->prepare('SELECT * FROM products WHERE title LIKE :title ORDER BY create_date DESC');
  $stmt->bindValue(':title', "%$search%");
} else {
  $stmt = $pdo->prepare('SELECT * FROM products ORDER BY create_date DESC');
}
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include_once "../../views/partials/header.php"; ?>

    <h1>Product CRUD</h1>
    <p>
      <a href="create.php" class="btn btn-success">Create Product</a>
    </p>

    <form action="" method="GET">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search Products" name="search">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
      </div>
    </form>


    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Title</th>
      <th scope="col">Price</th>
      <th scope="col">Created date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($products as $i => $product) { ?>
    <tr>
      <th scope="row"><?php echo $i+1 ?></th>
      <td><img src="../<?php echo $product['image']?>" class="thumb-image"></td>
      <td><?php echo $product['title']?></td>
      <td><?php echo $product['price']?></td>
      <td><?php echo $product['create_date']?></td>
      <td>
        <!-- <button type="button" class="btn btn-sm btn-primary">Edit</button> -->
        <a href="update.php?id=<?php echo $product['id'] ?>" type="button" class="btn btn-sm btn-primary">Edit</a>
        <form style="display: inline-block" action="delete.php" method="POST">
          <input type="hidden" name="id" value="<?php echo $product['id']?>">
          <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
        
      </td>
    </tr>
<?php } ?>
  </tbody>
</table>


<?php include_once "../../views/partials/footer.php"; ?>