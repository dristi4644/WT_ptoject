<?php

//start session
session_start();
require_once('php/CreateDb.php');
require_once('php/component.php');


//create instance of CreateDb class
$database = new CreateDb($database="productdb",$tablename="productdb");


if(isset($_POST["add"]))
{
   // print_r($_POST['product_id']);
   if(isset($_SESSION['cart']))
   {
       $item_array_id = array_column($_SESSION['cart'],"product_id");
       print_r($item_array_id);
       if(in_array($_POST['product_id'],$item_array_id))
        {
            echo "<script> alert(\"Cake is already added in the cart..!\")</script>";
            echo "<script>window.location=\"index.php\"</script>";
        }
        else{
            $count = count($_SESSION['cart']);
            $item_array= array(
                'product_id' =>$_POST['product_id']
            );
            $_SESSION['cart'][$count]=$item_array;
            // print_r($_SESSION['cart']);
        }

    // print_r($_SESSION['cart']);
   }
   else
   {
       $item_array= array(
           'product_id' =>$_POST['product_id']
       );

       //create a new session variable
       $_SESSION['cart'][0]=$item_array;
       print_r($_SESSION['cart']);
   }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cake Order</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">  
</head>
<body>
<?php require_once("php/header.php");  ?>
    <div class="container">
        <div class="row text-center py-5">
            <?php
                $result = $database->getData();
                while($row = mysqli_fetch_assoc($result))
                {
                    component($row['product_name'],$row['product_price'],$row['product_image'],$row['id']);
                }
            ?>

        </div>
    </div>

</body>
</html>