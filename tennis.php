<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SportShop</title>
  <link rel="stylesheet" href="still.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>
  <header class="navbar fixed-top">
      <h1 style="color: #bdb8d7; background-color: #111111;">SportShop</h1>
      <nav class="nav-search">
          <div class="search">
            <form action="#">
                <input type="text"
                    placeholder=" Search"
                    name="search">
                <button>
                    <i class="fa fa-search"
                        style="font-size: px;">
                    </i>
                </button>
            </form>
        </div>
      </nav>
      <ul>
        <li class="navli"><a href="favorite.php"><i class="fas fa-heart"></i>  Favorite</a></li>
        <li class="navli"><a href="cart.php"><i class="fas fa-shopping-cart"></i>  Cart 
                        <?php
                        if (isset($_SESSION['cart'])){
                            $count = count($_SESSION['cart']);
                            echo "<span id=\"cart_count\" >$count</span>";
                        }else{
                            echo "<span id=\"cart_count\" >0</span>";
                        }
                        ?></a></li>
        <li class="navli"><a href="logout.php"><i class="fas fa-sign-out-alt"></i>  Logout</a></li>
      </ul> 
    </header>

<div class="continut">
    <div class="wrapper">
        <div class="sidebar">
            <ul>
                <li><a href="football.php"><i style="color: white;"  class="fas fa-futbol"></i>  Football</a></li>
                <li><a href="bascketball.php"><i class="fas fa-basketball-ball"></i>  Bascketball</a></li>
                <li><a style="background-color:black; color: white; text-decoration: blink;" href="#"><i class="far fa-tennis-ball"></i>  Tennis</a></li>
                <li><a href="baseball.php"><i class="fas fa-baseball-ball"></i>
      Baseball</a></li>
            </ul> 
        </div>
    </div>

    <div class="container">
        
    </div>
</div>

</body>
</html>