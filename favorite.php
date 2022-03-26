<?php

session_start();
require_once('tickets.php');
require_once('db_conn.php');

if (isset($_POST['add'])){

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
}

if (isset($_POST['remove'])){
  if ($_GET['action'] == 'remove'){
      /*foreach ($_SESSION['favorite'] as $key => $value){
          if($value["product_id"] == $_GET['id'] && $value["tag"]== $_GET['tag']){
              unset($_SESSION['favorite'][$key]);
              echo "<script>window.location = 'favorite.php'</script>";
          }
      }*/
      $id=$_GET['id'];
      $tag=$_GET['tag'];
      $con=mysqli_connect("localhost", "root", "", "sportShop_db");
      $sql="DELETE FROM favorite WHERE idTicket='$id' AND tagTicket='$tag';";
      $result=mysqli_query($con,$sql);
  }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Favorite</title>
	<link rel="stylesheet" href="css/favoriteStill.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<header class="navbar fixed-top">
      <a href="index.php" style="text-decoration: none;"><h1 style="color: #bdb8d7; background-color: #111111;">SportShop</h1></a>
     
      <ul>
        <li class="navli"><a href="favorite.php"><i class="fas fa-heart"></i>  Favorite </a></li>
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
    	<?php
            if(isset($_SESSION['uname']))
                showTicketFav();
            else
                echo "You're not logged in";
	    ?>
    </div>
    
</body>
</html>