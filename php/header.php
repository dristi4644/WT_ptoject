<header id="">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="index1.html" class="navbar-brand">
            <h3 class="px-5">
                <i class="nav-item" style="color: white !important;font-size: larger;margin-top: -30px;">Home</i>
                
            </h3>
           </a>
        <a href="index.php" class="navbar-brand">
            <h3 class="px-5">
                <i class="fas fa-shopping-basket">Shopping Cart</i>
                
            </h3>
           </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNaAltMarkup" aria-controls="navbarNaAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>

        </button>
        <div class="collapse navbar-collapse" id="navbarNaAltMarkup">
            <div class="mr-auto"></div>
            <div class="navbar-nav">
                <a href="cart.php" class="nav-item nav-link active">
                    <h5 class="px-5 cart">
                        <i class="fas fa-shopping-cart"> </i>Cart 
                        <!-- <span id="cart_count" class="text-warning bg-light">0</span> -->
                        <?php
                            if(isset($_SESSION['cart']))
                            {
                                $count = count($_SESSION['cart']);
                                echo "<span id=\"cart_count\" class=\"text-warning bg-light\">$count</span>";
                            }
                            else{
                                echo "<span id=\"cart_count\" class=\"text-warning bg-light\">0</span>";
                            }

                        ?>
                    </h5>
                </a>
            </div>
        </div>
    </nav>
</header>