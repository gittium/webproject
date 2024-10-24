<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
@include 'config.php';
if(!isset($_SESSION['admin_username'])){
   header('Location: login_admin.php');
   exit();
}

if(isset($_POST['add_product'])){
  

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_description = $_POST['product_description'];
   $product_stock = $_POST['product_stock'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;
   

   if(empty($product_name) || empty($product_price) || empty($product_image)|| empty($product_description) || empty($product_stock)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO products(name,description, price,stock, image) VALUES('$product_name', '$product_description','$product_price', $product_stock,'$product_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'new product added successfully';
      }else{
         $message[] = 'could not add the product';
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   
   // Basic validation for ID
   if(!empty($id) && is_numeric($id)) {
       // Get image filename before deleting record
       $select_image = mysqli_query($conn, "SELECT image FROM products WHERE product_id = $id");
       if($image_row = mysqli_fetch_assoc($select_image)){
           $image_path = 'uploaded_img/'.$image_row['image'];
           // Delete the image file if it exists
           if(file_exists($image_path)){
               unlink($image_path);
           }
       }
       
       // Delete the product record
       $delete_query = "DELETE FROM products WHERE product_id = ?";
       $stmt = mysqli_prepare($conn, $delete_query);
       mysqli_stmt_bind_param($stmt, "i", $id);
       
       if(mysqli_stmt_execute($stmt)){
           $message[] = 'Product deleted successfully';
       } else {
           $message[] = 'Error deleting product';
       }
       
       // Redirect to prevent resubmission
       header('Location: admin_page.php');
       exit();
   }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Page</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
if (isset($message)) {
   foreach ($message as $message) {
      echo '<span class="message">'.$message.'</span>';
   }
}
?>
   
<div class="container">
   <h1 class="page-title">Bakery Admin Panel</h1>

   <div class="admin-product-form-container">
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         
         <input type="text" placeholder="Product Name" name="product_name" class="box" required>
         <input type="text" placeholder="Product Description" name="product_description" class="box" required>
         <input type="number" placeholder="Product Price" name="product_price" class="box" required>
         <input type="number" placeholder="Stock Quantity" name="product_stock" class="box" required>
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box" required>
         <input type="submit" class="btn" name="add_product" value="Add Product">
      </form>
   </div>

   <?php
   $select = mysqli_query($conn, "SELECT * FROM products");
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
            <tr>
               <th>Image</th>
               <th>Name</th>
               <th>Description</th>
               <th>Price</th>
               <th>Stock</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
         <?php while ($row = mysqli_fetch_assoc($select)) { ?>
            <tr>
               <td><img src="uploaded_img/<?php echo $row['image']; ?>" width="150" alt=""></td>
               <td><?php echo $row['name']; ?></td>
               <td><?php echo $row['description']; ?></td>
               <td>$<?php echo $row['price']; ?>/-</td>
               <td><?php echo $row['stock']; ?></td>
               <td>
                  <a href="admin_update.php?edit=<?php echo $row['product_id']; ?>" class="btn"> <i class="fas fa-edit"></i> Edit </a>
                  <a href="admin_page.php?delete=<?php echo $row['product_id']; ?>" class="btn"> <i class="fas fa-trash"></i> Delete </a>
               </td>
            </tr>
         <?php } ?>
         </tbody>
      </table>
   </div>
</div>

</body>
</html>
