<?php
    session_start();
    $con=mysqli_connect("localhost","root","","productdb");
	
	
	require_once('php/CreateDb.php');
	require_once('php/component.php');
	require_once('db.php');

	$db = new CreateDb($dbname="ProductDb",$tablename="ProductDb");

    if(mysqli_connect_error())
    {
        echo "<script>
        alert('cannot connect to database');
        window.location.href='cart.php'
        </script>";
        exit();
    }
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        
        if(isset($_POST['purchase']))
        {
			$name = $_POST['name'];		 
			$phone_no = $_POST['phone_no'];		 
			$address = $_POST['address'];		 
			$pay_mode = $_POST['pay_mode'];	
			$total_amount = $_POST['total_amount'];	
			
            $query1="INSERT INTO `order_manager`(`name`, `phone_no`, `address`, `pay_mode`, `order_amount`) VALUES ('$name','$phone_no','$address]','$pay_mode ','$total_amount')";
            
			if(mysqli_query($con,$query1))
            {
				
                    $order_id  = mysqli_insert_id($con);
					
					$product_id = array_column($_SESSION['cart'],'product_id');
					$result = $db->getData();
					while($row = mysqli_fetch_assoc($result))
					{
						foreach($product_id as $id)
						{
						  if($row['id'] == $id)
						  {
							$productname =$row['product_name'];
							$productprice=$row['product_price'];
							$productimg = $row['product_image'];
							
							echo $query2="INSERT INTO `user_order`(`order_id`, `product_id`, `product_name`, `product_price`,`product_image`) VALUES ('$order_id', '$id' ,'$productname','$productprice','$productimg')";
							mysqli_query($con,$query2);
						  }
						}
					}
					
					
					unset($_SESSION['cart']);
					echo "<script>
					alert('Order placed');
					window.location.href='cart.php'
					</script>";
            }
            else{
                echo "<script>
                alert('sql error');
                window.location.href='cart.php'
                </script>";

            }
        }
    }



?>