<?php

session_start();
require_once('tickets.php');
require_once('db_conn.php');

if (isset($_POST['remove'])){
  if ($_GET['action'] == 'remove'){
      foreach ($_SESSION['cart'] as $key => $value){
          if($value["product_id"] == $_GET['id']){
              unset($_SESSION['cart'][$key]);
              echo "<script>window.location = 'cart.php'</script>";
          }
      }
  }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="cartStill.css">
</head>
<body>

<div class="cart">
    <div class="tickets">
        <h6 style="width: 900px;" class="myCart">My Cart</h6>
        <hr style="background-color: #19191b;">

        <?php

        $total = 0;
            if (isset($_SESSION['cart'])){
                $product_id = array_column($_SESSION['cart'], 'product_id');
                $tag = array_column($_SESSION['cart'],'tag');

                $result = getData('football');
                while ($row = mysqli_fetch_assoc($result)){
                    //foreach ($product_id as $id){
                        if ($row['id'] == $product_id && $row['tag'] == 'f'){
                            cartTicket($row['team1'],$row['logo1'],$row['team2'],$row['logo2'],$row['location'],$row['date'],$row['price'],$row['id']);
                            $total = $total + (int)$row['price'];
                        //}
                    }
                }

                 $result = getData('bascketball');
                while ($row = mysqli_fetch_assoc($result)){
                    foreach ($product_id as $id){
                        if ($row['id'] == $id && $row['tag'] == 'b'){
                            cartTicket($row['team1'],$row['logo1'],$row['team2'],$row['logo2'],$row['location'],$row['date'],$row['price'],$row['id']);
                            $total = $total + (int)$row['price'];
                        }
                    }
                }
            }else{
                echo "<h5>Cart is Empty</h5>";
            }

        ?>
    </div>

    <div class="detali">
        <h3 style="background-color: #111111; padding-top: 40px;">PRICE DETAILS</h3>
        <hr>
        <div style="padding-top: 0px; " class="row price-details">
            <div style="background-color: #111111;" class="col-md-6">
                <?php
                    if (isset($_SESSION['cart'])){
                        $count  = count($_SESSION['cart']);
                        echo "<h6>Price ($count items)</h6>";
                    }else{
                        echo "<h6>Price (0 items)</h6>";
                    }
                ?>
                <h6 style="padding-bottom: 16px;">Delivery Charges</h6>
                <hr>
                <h6>Amount Payable</h6>
            </div>
            <div style="background-color: #111111;" class="col-md-6">
                <h6>$<?php echo $total; ?></h6>
                <h6 style="padding-bottom: 16px;" class="text-success">FREE</h6>
                <hr>
                <h6>$<?php
                    echo $total;
                    ?></h6>
            </div>
        </div>
        <a class="backBtn" href="football.php"><button class="back">back</button></a>
        <a href="payment.php"><button class="payment">Checkout</button></a>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
