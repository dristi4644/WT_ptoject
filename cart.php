<?php

session_start();
require_once('php/CreateDb.php');
require_once('php/component.php');
require_once('insert.php');
require_once('db.php');

$db = new CreateDb($dbname="ProductDb",$tablename="ProductDb");

if(isset($_POST['remove']))
{
  // print_r($_GET['id']);
  if($_GET['action']=='remove')
  {
    foreach($_SESSION['cart'] as $key => $value)
    {
      if($value['product_id']==$_GET['id'])
      {
        unset($_SESSION['cart'][$key]);
        echo "<script>alert(\"Product has been remove...\")</script>";
        echo "<script>window.location='cart.php'</script>";
      }
    }
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
<body class="bg-light">

<?php
    include('php/header.php');
?>
    <div class="container-fluid">
      <div>
        <h1 style="text-align:center;color: #1a4380;font-family: emoji;"><b>Order Now</b></h1>
      </div>
      <div class="row px-2">
      
        <div class="col-md-6">
          <div class="shopping-cart">
            <h6>My Cart</h6>
            <hr>
          <?php
            $total =0;
            if(isset($_SESSION['cart']))
            {
            $product_id = array_column($_SESSION['cart'],'product_id');
            $result = $db->getData();
            while($row = mysqli_fetch_assoc($result))
            {
                foreach($product_id as $id)
                {
                  if($row['id'] == $id)
                  {
                    cartElement($row['product_image'],$row['product_name'],$row['product_price'],$row['id']);
                    $total = $total + (int)$row['product_price'];
                  }
                }
            }
            }
            else{
              echo "<h5>Cart is Empty</h5>";
            }
          ?>
          </div>
        </div>
        <div class="col-md-3 offset-md-1 border rounded mt-5 ng-white h-25"> 
            <div class="pt-4">
              <h6 >Price Details</h6>
              <hr>
              <div class="row price-details" style="height:460px;">
                <div class="col-md-6">
                  <?php
                      if(isset($_SESSION['cart']))
                      {
                        $count = count($_SESSION['cart']);
                        echo "<h6>Price($count items)</h6>";
                      }
                      else
                      {
                        echo "<h6>Price(0 items)</h6>";
                      }
                  ?>
                  <h6>Delivery CHarges</h6>
                  <hr>
                  <h6>Amount Payable</h6>
                </div>
                <div class="col-md-6">
                      <h6>$ <?php echo $total;?></h6>
                      <h6 class="text-success">FREE</h6>
                      <hr>
                      <h6>$<?php echo $total; ?>
                      </h6>
                </div>
                <?php

                      if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0)
                      {
                ?>
                      <form style="padding-left:50px;" action="purchase.php" method="post" name="form1">
                        <input type="hidden" name="total_amount" value="<?php echo $total;?>">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" required>
                      </div>
                      <div class="form-group">
                        <label>Mobile No</label>
                        <input type="number" class="form-control" name="phone_no" required>
                      </div>
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" required>
                      </div>
                        <div class="form-check-input"id="flexRadiofault" >
                            <input class="form-check-input" type="radio" name="pay_mode" value="COD" id="flexRadioDefault"style="margin-left:10px;" required>
                            <label class="form-check-input" for="flexRadioDefault" style="width:300px;padding-bottom:30px;margin-left:30px;">
                              Cash On Delivery
                        </div><br><br>
                        <button class="btn btn-info btn-block" name="purchase" onclick="phonenumber(document.form1.phone_no)">Make Purchase</button>
                      </form>  
                <?php
                  }
                ?>
              </div>
             
            </div>

        </div>
      </div>
    </div>
<script>
  function phonenumber(inputtxt)
{
  var phoneno = /^\d{10}$/;
  if(inputtxt.value.match(phoneno))
  {
      return true;
  }
  else
  {
     alert("Not a valid Phone Number");
     return false;
  }
  }
  </script>

</body>
</html>