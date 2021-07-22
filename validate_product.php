<?php
$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$imagePath = '';

// push error string into the errors array if any
if (!$title) {
  $errors[] = "product title is required";
}
if (!$price) {
  $errors[] = "product price is required";
}
// make the img folder if there isn't one
if(!is_dir(__DIR__.'/public/images')) {
  mkdir(__DIR__.'/public/images');
}

// if no errors
if(empty($errors)) {
  // can't upload the image to the folder, and there fore the db
  
  // check if the image was really uploaded
  $image = $_FILES['image'] ?? null;
  
  $imagePath = $product['image'];
  
  // if there is an img uploaded
  if ($image['tmp_name']) {

    // if there is already an old img, delete it
    if ($product['image']) {
      unlink(__DIR__.'/public/'.$product['image']);
    }

    // save the uploaded img
    $imagePath = 'images/'.randomString(8).'/'.$image['name'];
    mkdir(dirname(__DIR__.'/public/'.$imagePath));
    move_uploaded_file($image['tmp_name'], __DIR__.'/public/'.$imagePath);
  }
}