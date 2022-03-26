<?php

session_start();
require_once('tickets.php');
require_once('db_conn.php');

if (isset($_POST['remove'])){
  if(isset($_SESSION['uname'])){
    $id=$_GET['id'];
    $tag=$_GET['tag'];
    $con=mysqli_connect("localhost", "root", "", "sportShop_db");
    $sql="DELETE FROM cart WHERE idTicket='$id' AND tagTicket='$tag';";
    $result=mysqli_query($con,$sql);
  }
  else{
    if ($_GET['action'] == 'remove'){
        $id=$_GET['id'];
        $tag=$_GET['tag'];
        $count = count($_SESSION['cart']);
        for($i=0;$i<$count;$i++){
            if($id == $_SESSION['cart'][$i]['product_id'] && $tag == $_SESSION['cart'][$i]['tag']){
                for($j=$i+1;$j<$count;$j++){
                    $_SESSION['cart'][$j-1]=$_SESSION['cart'][$j]; 
                }
                
            }
        }
        unset($_SESSION['cart'][$count-1]);
    } 
  }
}

if(isset($_POST['minus'])){
    if(isset($_SESSION['uname'])){
        $id=$_GET['id'];
        $tag=$_GET['tag'];
        $result=getDataUser("users");
        while ($row = mysqli_fetch_assoc($result)){
          if($row['user_name']==$_SESSION['uname'])
            $idUser=$row['id'];
        }
        $results=getDataUser("cart");
        while ($row = mysqli_fetch_assoc($results)){
            if($row['idTicket'] == $id && $row['tagTicket'] == $tag && $row['idUser'] == $idUser){
                if($row['number']>1){
                    $number=$row['number'];
                    $number--;
                    $con=mysqli_connect("localhost", "root", "", "sportShop_db");
                    $sql = "UPDATE `cart` SET `idUser`='$idUser',`idTicket`='$id',`tagTicket`='$tag',`number`='$number' WHERE `idUser`='$idUser' AND `idTicket`='$id' AND `tagTicket`='$tag';";
                    $result = mysqli_query($con, $sql);
                    $len=strlen($_SESSION['tickets']);
                    for($j=0;$j<$len-2;$j++){
                        if($_SESSION['tickets'][$j] == $id && $_SESSION['tickets'][$j+1] == $tag){
                            $num=(int)$_SESSION['tickets'][$j+2];
                            $num--;
                            $_SESSION['tickets'][$j+2]=(string)$num;
                            
                        }
                    }
                }
            }
        }
    }
    else{
        $id=$_GET['id'];
        $tag=$_GET['tag'];
        $count = count($_SESSION['cart']);
        for($i=0;$i<$count;$i++){
            if ($id == $_SESSION['cart'][$i]['product_id'] && $tag == $_SESSION['cart'][$i]['tag']){
                if($_SESSION['cart'][$i]['number']>1)
                    $_SESSION['cart'][$i]['number']--;
                    $len=strlen($_SESSION['tickets']);
                    for($j=0;$j<$len-2;$j++){
                        if($_SESSION['tickets'][$j] == $id && $_SESSION['tickets'][$j+1] == $tag){
                            $num=(int)$_SESSION['tickets'][$j+2];
                            $num--;
                            $_SESSION['tickets'][$j+2]=(string)$num;
                        }
                    }
            }
        }
    }
}

if(isset($_POST['plus'])){
    if(isset($_SESSION['uname'])){
        $id=$_GET['id'];
        $tag=$_GET['tag'];
        $result=getDataUser("users");
        while ($row = mysqli_fetch_assoc($result)){
          if($row['user_name']==$_SESSION['uname'])
            $idUser=$row['id'];
        }
        $results=getDataUser("cart");
        while ($row = mysqli_fetch_assoc($results)){
            if($row['idTicket'] == $id && $row['tagTicket'] == $tag && $row['idUser'] == $idUser){
                $number=$row['number'];
                $number++;
                $con=mysqli_connect("localhost", "root", "", "sportShop_db");
                $sql = "UPDATE `cart` SET `idUser`='$idUser',`idTicket`='$id',`tagTicket`='$tag',`number`='$number' WHERE `idUser`='$idUser' AND `idTicket`='$id' AND `tagTicket`='$tag';";
                $result = mysqli_query($con, $sql);
                $len=strlen($_SESSION['tickets']);
                    for($j=0;$j<$len-2;$j++){
                        if($_SESSION['tickets'][$j] == $id && $_SESSION['tickets'][$j+1] == $tag){
                            $num=(int)$_SESSION['tickets'][$j+2];
                            $num++;
                            $_SESSION['tickets'][$j+2]=(string)$num;
                            
                        }
                    }
            }
        }
    }
    else{
        $id=$_GET['id'];
        $tag=$_GET['tag'];
        $count = count($_SESSION['cart']);
        for($i=0;$i<$count;$i++){
            if ($id == $_SESSION['cart'][$i]['product_id'] && $tag == $_SESSION['cart'][$i]['tag']){
                $_SESSION['cart'][$i]['number']++;
                $len=strlen($_SESSION['tickets']);
                    for($j=0;$j<$len-2;$j++){
                        if($_SESSION['tickets'][$j] == $id && $_SESSION['tickets'][$j+1] == $tag){
                            $num=(int)$_SESSION['tickets'][$j+2];
                            $num++;
                            $_SESSION['tickets'][$j+2]=(string)$num;
                            
                        }
                    }
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

    <link rel="stylesheet" href="css/cartStilll.css">
</head>
<body>

<div class="cart">
    <div class="tickets">
        <h6 style="width: 900px;" class="myCart">My Cart</h6>
        <hr style="background-color: #19191b;">

        <?php

        if(isset($_SESSION['uname'])){
            showTicketCart();
        }
        else{
          if(isset($_SESSION['cart'])){
            showCart("football");

            showCart("basketball");

            showCart("tennis");

            showCart("baseball");
          }
        }
        ?>
    </div>

    <div class="detali">
        <h3 style="background-color: #111111; padding-top: 40px;">PRICE DETAILS</h3>
        <hr>
        <div style="width: 100%; padding-top: 0px; " class="row price-details">
            <div style="background-color: #111111;" class="col-md-6">
                <?php
                        echo "<h6>Price</h6>";
                ?>
                <h6 style="padding-bottom: 16px;">Delivery Charges</h6>
                <hr>
                <h6>Amount Payable</h6>
            </div>
            <div style="background-color: #111111;" class="col-md-6">
                <h6>$<?php 
                        if(isset($_SESSION['uname'])){
                            $total=total();
                            $_SESSION['total']=$total;
                            echo $total; 
                        }
                        else{
                            if(isset($_SESSION['cart'])){
                            $total=totalNoLog();
                            $_SESSION['total']=$total;
                            echo $total;
                          }
                        } 
                      ?></h6>
                <h6 style="padding-bottom: 16px;" class="text-success">FREE</h6>
                <hr>
                <h6>$<?php
                    if(isset($_SESSION['uname'])){
                        $total=total();
                        echo $total; 
                    }
                    else{
                        if(isset($_SESSION['cart'])){
                        $total=totalNoLog();
                        echo $total;
                      }
                    }                  
                    ?></h6>
            </div>
        </div>
        <a class="backBtn" href="index.php"><button class="back">back</button></a>
        <a href="payment.php"><button class="payment">Checkout</button></a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>