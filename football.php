<?php

session_start();
require_once('./tickets.php');
require_once('./db_conn.php');

if (isset($_POST['add'])){
    /// print_r($_POST['product_id']);
    if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], "product_id");
        $item_array_tag = array_column($_SESSION['cart'], "tag");

        if(in_array($_POST['product_id'], $item_array_id) && in_array($_POST['tag'], $item_array_tag)){
            echo "<script>alert('Product is already added in the cart..!')</script>";
            
        }else{

            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id'],
                'tag' => $_POST['tag']
            );

            $_SESSION['cart'][$count] = $item_array;
        }

    }else{

        $item_array = array(
                'product_id' => $_POST['product_id'],
                'tag' => $_POST['tag']
        );

        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SportShop</title>
  <link rel="stylesheet" href="still.css">
  <link rel="stylesheet" href="all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
  <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
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
                <li><a style="background-color:black; color: white; text-decoration: blink;" href="#"><i class="fas fa-futbol"></i>  Football</a></li>
                <li><a href="bascketball.php"><i class="fas fa-basketball-ball"></i>  Bascketball</a></li>
                <li><a href="tennis.php">  Tennis</a></li>
                <li><a href="baseball.php"><i class="fas fa-baseball-ball"></i>  Baseball</a></li>
            </ul> 
        </div>
    </div>
        <?php
            $result=getData("football");
            while($row=mysqli_fetch_assoc($result)){
                ticket($row['tag'],$row['team1'],$row['logo1'],$row['team2'],$row['logo2'],$row['location'],$row['date'],$row['price'],$row['id']);
            }
        ?>
</div>

</body>
</html>