<?php

session_start();
require_once('./tickets.php');
require_once('./db_conn.php');

if(isset($_POST['searchButton'])){
    if($_POST['searchInput'] !== ""){
        $_SESSION['search'] = $_POST['searchInput'];
    }
}

if(isset($_POST['add'])){
    header("location: add.php");
}

if(isset($_POST['edit'])){
    $_SESSION['table']=$_POST['table'];
    $_SESSION['tag']=$_POST['tag'];
    $_SESSION['id']=$_POST['product_id'];
    header("location: edit.php");
}

if(isset($_POST['searchButton'])){
    if($_POST['searchInput'] !== ""){
        $_SESSION['search'] = $_POST['searchInput'];
    }
}

if(isset($_POST['remove'])){
    $id=$_POST['product_id'];
    $tag=$_POST['tag'];
    $table=$_POST['table'];
    $con=mysqli_connect("localhost", "root", "", "sports");
    $sql="DELETE FROM $table WHERE id='$id' AND tag='$tag';";
    $result=mysqli_query($con,$sql);
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
       <a href="admin.php" style="text-decoration: none;"><h1 style="color: #bdb8d7; background-color: #111111;">SportShop</h1></a>
      <nav class="nav-search">
          <div class="search">
            <form action="admin.php" method="post">
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
        <li class="navli"><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
      </ul> 
    </header>

<div class="continut">
    <div class="wrapper">
        <div class="sidebar">
            <ul>
                <li><a style="background-color:black; color: white; text-decoration: blink;" href="admin.php"><i class="fas fa-ticket-alt"></i> Tickets</a></li>
                <li><a href="orders.php"><i class="fas fa-archive"></i> Orders</a></li>
            </ul> 
        </div>
    </div>
    <form action="admin.php" method="post">
        <div class="ticket" style="height: 100px; width:77%;">
                  <button name="add" style="margin-top: 5px; margin-left: 555px; height: 50px; width: 50px;border-style: none; background-color: #111111; border: 2px solid; border-color: #bdb8d7;font-size: 30px; border-radius: 90px;  color: #bdb8d7;">+</button>  
        </div>
    </form>
     <?php
        $ok=0;
        if(isset($_SESSION['search'])){
            $result=getData("football");
            while($row=mysqli_fetch_assoc($result)){
                if(str_contains(strtoupper($row['team1']),strtoupper($_SESSION['search']))  || str_contains(strtoupper($row['team2']),strtoupper($_SESSION['search']))){
                        ticketAdmin("football",$row['tag'],$row['team1'],$row['logo1'],$row['team2'],$row['logo2'],$row['location'],$row['date'],$row['price'],$row['id']);
                        $ok=$ok+1;
                    }
            }
            $result=getData("basketball");
            while($row=mysqli_fetch_assoc($result)){
                if(str_contains(strtoupper($row['team1']),strtoupper($_SESSION['search']))  || str_contains(strtoupper($row['team2']),strtoupper($_SESSION['search']))){
                        ticketAdmin("basketball",$row['tag'],$row['team1'],$row['logo1'],$row['team2'],$row['logo2'],$row['location'],$row['date'],$row['price'],$row['id']);
                        $ok=$ok+1;
                    }
            }
            $result=getData("tennis");
            while($row=mysqli_fetch_assoc($result)){
                if(str_contains(strtoupper($row['team1']),strtoupper($_SESSION['search']))  || str_contains(strtoupper($row['team2']),strtoupper($_SESSION['search']))){
                        ticketAdmin("tennis",$row['tag'],$row['team1'],$row['logo1'],$row['team2'],$row['logo2'],$row['location'],$row['date'],$row['price'],$row['id']);
                        $ok=$ok+1;
                    }
            }
            $result=getData("baseball");
            while($row=mysqli_fetch_assoc($result)){
                if(str_contains(strtoupper($row['team1']),strtoupper($_SESSION['search']))  || str_contains(strtoupper($row['team2']),strtoupper($_SESSION['search']))){
                        ticketAdmin("baseball",$row['tag'],$row['team1'],$row['logo1'],$row['team2'],$row['logo2'],$row['location'],$row['date'],$row['price'],$row['id']);
                        $ok=$ok+1;
                    }
            }
        }
        else{
            $result=getData("football");
            while($row=mysqli_fetch_assoc($result)){
                ticketAdmin("football",$row['tag'],$row['team1'],$row['logo1'],$row['team2'],$row['logo2'],$row['location'],$row['date'],$row['price'],$row['id']);
            }
            $result=getData("basketball");
            while($row=mysqli_fetch_assoc($result)){
                ticketAdmin("basketball",$row['tag'],$row['team1'],$row['logo1'],$row['team2'],$row['logo2'],$row['location'],$row['date'],$row['price'],$row['id']);
            }
            $result=getData("tennis");
            while($row=mysqli_fetch_assoc($result)){
                ticketAdmin("tennis",$row['tag'],$row['team1'],$row['logo1'],$row['team2'],$row['logo2'],$row['location'],$row['date'],$row['price'],$row['id']);
            }
            $result=getData("baseball");
            while($row=mysqli_fetch_assoc($result)){
                ticketAdmin("baseball",$row['tag'],$row['team1'],$row['logo1'],$row['team2'],$row['logo2'],$row['location'],$row['date'],$row['price'],$row['id']);
            }
        }
        if($ok === 0 && isset($_SESSION['search'])){
            echo "<div style=\"margin-left:250px;\">No ticket found</div>";
        }
        unset($_SESSION['search']);
        ?>
</div>
</body>
</html>
