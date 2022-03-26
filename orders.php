<?php 
require_once('db_conn.php');
require_once('tickets.php');
session_start();

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
  <link rel="stylesheet" href="css/ordersStills.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
  <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
</head>
<body>
  <header class="navbar fixed-top">
       <a href="orders.php" style="text-decoration: none;"><h1 style="color: #bdb8d7; background-color: #111111;">SportShop</h1></a>
      <nav class="nav-search">
          <div class="search">
            <form action="orders.php" method="post">
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
                <li><a href="admin.php"><i class="fas fa-ticket-alt"></i> Tickets</a></li>
                <li><a style="background-color:black; color: white; text-decoration: blink;" href="orders.php"><i class="fas fa-archive"></i> Orders</a></li>
            </ul> 
        </div>
    </div>
    <?php 
    $con=mysqli_connect("localhost", "root", "", "sportShop_db");
    $sql="SELECT * FROM orders";
    $result=mysqli_query($con,$sql);

    if(!isset($_POST['details'])){
            $ok=0;
            while($row=mysqli_fetch_assoc($result)){
                if(isset($_SESSION['search']))
                {
                    if(str_contains(strtoupper($row['fullname']),strtoupper($_SESSION['search']))){
                        $name=$row['fullname'];
                        $price=$row['total'];
                        $id=$row['id'];
                        echo "
                            <form action=\"orders.php\" method=\"post\">
                                <div class=\"ticket\">
                                    <div class=\"name\">$name</div><br>
                                    <div class=\"pret\">$$price</div><br>
                                    <input type=\"hidden\" name=\"id\" value=\"$id\">
                                    <button name=\"details\" class=\"details\">more details</button>
                                </div>
                            </form>";
                        $ok=$ok+1;
                    }
                }
                else{
                    $name=$row['fullname'];
                    $price=$row['total'];
                    $id=$row['id'];
                    echo "
                        <form action=\"orders.php\" method=\"post\">
                            <div class=\"ticket\">
                                <div class=\"name\">$name</div><br>
                                <div class=\"pret\">$$price</div><br>
                                <input type=\"hidden\" name=\"id\" value=\"$id\">
                                <button name=\"details\" class=\"details\">more details</button>
                            </div>
                        </form>";
                }
            }
            if($ok === 0 && isset($_SESSION['search']))
                echo "<div style=\"margin-left:250px;\">No order found</div>";
            unset($_SESSION['search']);
        }
    else{
        while($row = mysqli_fetch_assoc($result)){
            if($row['id']===$_POST['id']){
                $name=$row['fullname'];
                $email=$row['email'];
                $address=$row['address'];
                $city=$row['city'];
                $state=$row['state'];
                $zip=$row['zip'];
                echo "
                    <form action=\"orders.php\" method=\"post\">
                        <h2 style=\"width: 47%; margin-left:80px; color:#bdb8d7;\">Informations</h2>
                        <hr style=\"background-color: #bdb8d7; margin-left:21%;\">
                        <div class=\"info\">
                            <div class=\"fullname\">Name: $name</div>
                            <div class=\"email\">Email: $email</div>
                            <div class=\"address\">Address: $address</div>
                            <div class=\"cityAndState\">City and State: $city, $state</div>
                            <div class=\"zip\">ZipCode: $zip</div>
                        </div>
                    </form>
                    <h2 style=\"width: 47%; margin-left:20px; color:#bdb8d7;\">Tickets</h2>
                        <hr style=\"background-color: #bdb8d7; margin-bottom:30px; margin-left:21%;\">";
            }
        }
        $result=mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)){
            if($row['id']===$_POST['id']){
                $commands=$row['command'];
                $aux=strtok($commands," ");
                while($aux!==false){
                    $ticketId=$aux[0];
                    $ticketTag=$aux[1];
                    $number=$aux[2];
                    $resf=getData("football");
                    while($r=mysqli_fetch_assoc($resf)){
                        if($r['id']==$ticketId && $r['tag']==$ticketTag){
                            orderTicket("football.php",$r['tag'],$r['team1'],$r['logo1'],$r['team2'],$r['logo2'],$r['location'],$r['date'],$r['price'],$r['id'],$number);
                        }
                    }
                    $resb=getData("basketball");
                    while($r=mysqli_fetch_assoc($resb)){
                        if($r['id']==$ticketId && $r['tag']==$ticketTag){
                            orderTicket("basketball.php",$r['tag'],$r['team1'],$r['logo1'],$r['team2'],$r['logo2'],$r['location'],$r['date'],$r['price'],$r['id'],$number);
                        }
                    }
                    $rest=getData("tennis");
                    while($r=mysqli_fetch_assoc($rest)){
                        if($r['id']==$ticketId && $r['tag']==$ticketTag){
                            orderTicket("tennis.php",$r['tag'],$r['team1'],$r['logo1'],$r['team2'],$r['logo2'],$r['location'],$r['date'],$r['price'],$r['id'],$number);
                        }
                    }
                    $resq=getData("baseball");
                    while($r=mysqli_fetch_assoc($resq)){
                        if($r['id']==$ticketId && $r['tag']==$ticketTag){
                            orderTicket("baseball.php",$r['tag'],$r['team1'],$r['logo1'],$r['team2'],$r['logo2'],$r['location'],$r['date'],$r['price'],$r['id'],$number);
                        }
                    }
                    $aux=strtok(" ");
                }
            }
        }
    }
    unset($_POST['details']);
    ?>
</div>



</body>
</html>
