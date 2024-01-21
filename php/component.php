<?php

    function component($productname,$productprice,$productimg,$productid)
    {
        $element ="
        <div class=\"col-md-3 col-sm-6 my-4 my-md-0\">
        <form action=\"index.php\" method=\"post\">
            <div class=\"card shadow\">
                <div>
                    <img src=\"$productimg\" alt img=\"Image1\" class=\"img-fluid card-img-top\">
                </div>
                <div class=\"card-body\">
                <h5 class=\"cart-title\">$productname</h5>
                <h5><span class=\"price\"> &#8377;$productprice</span></h5>
                <button type=\"submit\" class=\"btn btn-warning my-3\"name=\"add\">Add to cart<i class=\"fas fa-shopping-cart\"></i></button>
                <input type=\"hidden\" name=\"product_id\" value=$productid>
                
                </div>
            </div>
            
        </form>
    </div>
        ";
        echo $element;
    }

    function cartElement($productimg,$productname,$productprice,$productid)
    {
        $element ="
        <form action=\"cart.php?action=remove&id=$productid\" method = \"post\" class=\"cart-items\">
        <div class=\"border rounded\">
        
          <div class=\"row bg-white\">
          <div class=\"col-md-3 pl-0\">
            <img src=$productimg alt=\"image\" class=\"img-fluid\"> 
          </div>
          <div class=\"col-md-6\">
            <h5 class=\"pt-2\">$productname</h5>
            <small class=\"text-secondary\">Seller</small>
            <h5 class=\"pt-2\">$productprice</h5>
            <button type=\"submit\" class=\"btn btn-warning\"> Save for Later</button>
            <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\"> Remove</button>
          </div>
          </div>
        </div>
      </form>
        ";
        echo $element;
    }

?>