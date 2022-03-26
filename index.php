<?php

session_start();
require_once('tickets.php');
require_once('db_conn.php');

if(isset($_SESSION['admin'])){
    header("Location: admin.php");
}

if (isset($_POST['add'])){
    $id=$_POST['nr']-1;
    if(isset($_SESSION['uname'])){
        $result=getDataUser("users");

        while ($row = mysqli_fetch_assoc($result)){
          if($row['user_name']==$_SESSION['uname'])
            $id=$row['id'];
        }
        $idTicket=$_POST['product_id'];
        $tagTicket=$_POST['tag'];
        $con=mysqli_connect("localhost", "root", "", "sportShop_db");
        $sql = "SELECT * FROM cart WHERE idUser='$id' AND idTicket='$idTicket' AND tagTicket='$tagTicket';";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Product is already added in cart..!')</script>";
        }else{
            
            $sql="INSERT INTO cart (idUser, idTicket, tagTicket) VALUES('$id', '$idTicket', '$tagTicket');";
            $result=mysqli_query($con,$sql);
        
        }
    }
    else{
        if(isset($_SESSION['cart'])){

            $item_array_id = array_column($_SESSION['cart'], "product_id");
            $item_array_tag = array_column($_SESSION['cart'], "tag");

            if(in_array($_POST['product_id'], $item_array_id) && in_array($_POST['tag'], $item_array_tag)){
                echo "<script>alert('Product is already added in cart..!')</script>";
                
            }else{

                $count = count($_SESSION['cart']);
                $item_array = array(
                    'product_id' => $_POST['product_id'],
                    'tag' => $_POST['tag'],
                    'number'=> 1
            );

                $_SESSION['cart'][$count] = $item_array;
            }

        }else{

            $item_array = array(
                    'product_id' => $_POST['product_id'],
                    'tag' => $_POST['tag'],
                    'number'=> 1
            );

            // Create new session variable
            $_SESSION['cart'][0] = $item_array;
        }
    }
    
}

if (isset($_POST['favorite'])){
    if(isset($_SESSION['uname'])){
        $result=getDataUser("users");

        while ($row = mysqli_fetch_assoc($result)){
          if($row['user_name']==$_SESSION['uname'])
            $id=$row['id'];
        }
        $idTicket=$_POST['product_id'];
        $tagTicket=$_POST['tag'];
        $con=mysqli_connect("localhost", "root", "", "sportShop_db");
        $sql = "SELECT * FROM favorite WHERE idUser='$id' AND idTicket='$idTicket' AND tagTicket='$tagTicket';";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Product is already added fav..!')</script>";
        }else{
            
            $sql="INSERT INTO favorite (idUser, idTicket, tagTicket) VALUES('$id', '$idTicket', '$tagTicket');";
            $result=mysqli_query($con,$sql);
        }
    }
}

if(isset($_POST['searchButton'])){
    if($_POST['searchInput'] !== ""){
        $_SESSION['search'] = $_POST['searchInput'];
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SportShop</title>
  <link rel="stylesheet" href="css/stilll.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
  <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
</head>
<body>
  <header class="navbar fixed-top">
       <a href="index.php" style="text-decoration: none;"><h1 style="color: #bdb8d7; background-color: #111111;">SportShop</h1></a>
      <nav class="nav-search">
          <div class="search">
            <form action="index.php" method="post">
                <input type="text"
                    placeholder=" Search"
                    name="searchInput">
                <button name="searchButton">
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
                        if(isset($_SESSION['uname'])){
                            $count=cartCount();
                            echo "<span id=\"cart_count\" >$count</span>";
                        }
                        else{
                            if (isset($_SESSION['cart'])){
                                $count = count($_SESSION['cart']);
                                echo "<span id=\"cart_count\" >$count</span>";
                            }else{
                                echo "<span id=\"cart_count\" >0</span>";
                            }
                        }
                        ?></a></li>
        <?php
            if(isset($_SESSION['uname']))
                echo "<li class=\"navli\"><a href=\"logout.php\"><i class=\"fas fa-sign-out-alt\"></i>  Logout</a></li>";
            else
                echo "<li class=\"navli\"><a href=\"login.php\"><i class=\"fas fa-sign-out-alt\"></i>  Login</a></li>";

        ?>
      </ul> 
    </header>

<div class="continut">
    <div class="wrapper">
        <div class="sidebar">
            <ul>
                <li><a style="background-color:black; color: white; text-decoration: blink;" href="index.php"><i class="fas fa-futbol"></i>  Football</a></li>
                <li><a href="basketball.php"><i class="fas fa-basketball-ball"></i>  Basketball</a></li>
                <li><a href="tennis.php"><span style="height: 20px; width: auto; margin-bottom: 2px;"class="iconify" data-icon="bx:bxs-tennis-ball"></span>  Tennis</a></li>
                <li><a href="baseball.php"><i class="fas fa-baseball-ball"></i>  Baseball</a></li>
            </ul> 
        </div>
    </div>
        <?php
            $result=getData("football");
            $ok=0;
            while($row=mysqli_fetch_assoc($result)){
                if(isset($_SESSION['search']))
                {
                    $str1=$_SESSION['search'];
                    $str2=$row['team1'];
                    if(str_contains(strtoupper($row['team1']),strtoupper($_SESSION['search']))  || str_contains(strtoupper($row['team2']),strtoupper($_SESSION['search']))){
                        ticket("index.php",$row['tag'],$row['team1'],$row['logo1'],$row['team2'],$row['logo2'],$row['location'],$row['date'],$row['price'],$row['id']);
                        $ok=$ok+1;
                    }
                }
                else{
                    ticket("index.php",$row['tag'],$row['team1'],$row['logo1'],$row['team2'],$row['logo2'],$row['location'],$row['date'],$row['price'],$row['id']);
                }
            }
            if($ok === 0 && isset($_SESSION['search']))
                echo "<div style=\"margin-left:250px;\">No ticket found</div>";
            unset($_SESSION['search']);
        ?>
</div>

</body>
</html>