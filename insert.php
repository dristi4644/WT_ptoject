<?php
include_once 'db.php';
if(isset($_POST['purchase']))
{    
     $id = $_POST['id'];
     $product_name = $_POST['product_name'];
     $product_price = $_POST['product_price'];
     $product_image = $_POST['product_image'];

   
     $sql = "INSERT INTO order (id,product_name,product_price,product_image)
     VALUES ('$id ','$product_name','$product_price','$product_image')";

     if (mysqli_query($conn, $sql)) {
        echo "New record has been added successfully !";
     } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
     }
     mysqli_close($conn);
}
?>