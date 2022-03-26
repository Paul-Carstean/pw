<?php

$sname= "localhost";
$unmae= "root";
$password = "";

$db_name = "sportShop_db";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);
$cartCount=0;

if (!$conn) {
	echo "Connection failed!";
}

function getData($table){
    $con=mysqli_connect("localhost", "root", "", "sports");
    $sql="SELECT * FROM $table";
    $result=mysqli_query($con,$sql);

    if($result){
        if(mysqli_num_rows($result)>0){
            return $result;
        }
    }
}

function getDataUser($table){
    $con=mysqli_connect("localhost", "root", "", "sportShop_db");
    $sql="SELECT * FROM $table";
    $result=mysqli_query($con,$sql);

    if(mysqli_num_rows($result)>0){
        return $result;
    }
}

function showCart($table){
    $results = getData($table);

    while ($row = mysqli_fetch_assoc($results)){
      $count = count($_SESSION['cart']);
        for($i=0;$i<$count;$i++){
            if ($row['id'] == $_SESSION['cart'][$i]['product_id'] && $row['tag'] == $_SESSION['cart'][$i]['tag']){
                cartTicket("{$table}.php",$row['tag'],$row['team1'],$row['logo1'],$row['team2'],$row['logo2'],$row['location'],$row['date'],$row['price'],$row['id'],$_SESSION['cart'][$i]['number']);
            }
        }
    }
}

function showFav($table){
    $product_id = array_column($_SESSION['favorite'], 'product_id');
    $tag = array_column($_SESSION['favorite'],'tag');
    $results = getData($table);

    while ($row = mysqli_fetch_assoc($results)){
      $count = count($_SESSION['favorite']);
        for($i=0;$i<$count;$i++){
            if ($row['id'] == $product_id[$i] && $row['tag'] == $tag[$i]){
                favTicket($table,$row['tag'],$row['team1'],$row['logo1'],$row['team2'],$row['logo2'],$row['location'],$row['date'],$row['price'],$row['id']);
            }
        }
    }
}

function showTicketFav(){
    $result=getDataUser("users");

    while ($row = mysqli_fetch_assoc($result)){
      if($row['user_name']==$_SESSION['uname'])
        $id=$row['id'];
    }

    $results=getDataUser("favorite");
    if($results){
        while ($row = mysqli_fetch_assoc($results)){
          if($row['idUser']==$id){
            $res=getData("football");
            while($r=mysqli_fetch_assoc($res)){
                if($r['id']==$row['idTicket'] && $r['tag']==$row['tagTicket']){
                    favTicket("football.php",$r['tag'],$r['team1'],$r['logo1'],$r['team2'],$r['logo2'],$r['location'],$r['date'],$r['price'],$r['id']);
                }
            }
            $res=getData("basketball");
            while($r=mysqli_fetch_assoc($res)){
                if($r['id']==$row['idTicket'] && $r['tag']==$row['tagTicket']){
                    favTicket("basketball.php",$r['tag'],$r['team1'],$r['logo1'],$r['team2'],$r['logo2'],$r['location'],$r['date'],$r['price'],$r['id']);
                }
            }
            $res=getData("tennis");
            while($r=mysqli_fetch_assoc($res)){
                if($r['id']==$row['idTicket'] && $r['tag']==$row['tagTicket']){
                    favTicket("tennis.php",$r['tag'],$r['team1'],$r['logo1'],$r['team2'],$r['logo2'],$r['location'],$r['date'],$r['price'],$r['id']);
                }
            }
            $res=getData("baseball");
            while($r=mysqli_fetch_assoc($res)){
                if($r['id']==$row['idTicket'] && $r['tag']==$row['tagTicket']){
                    favTicket("baseball.php",$r['tag'],$r['team1'],$r['logo1'],$r['team2'],$r['logo2'],$r['location'],$r['date'],$r['price'],$r['id']);
                }
            }
          }
        }
    }
}

function showTicketCart(){
    $result=getDataUser("users");

    while ($row = mysqli_fetch_assoc($result)){
      if($row['user_name']==$_SESSION['uname'])
        $id=$row['id'];
        $_SESSION['id']=$id;
    }

    $results=getDataUser("cart");

    if($results){
        while ($row = mysqli_fetch_assoc($results)){
          if($row['idUser']==$id){
            $res=getData("football");
            while($r=mysqli_fetch_assoc($res)){
                if($r['id']==$row['idTicket'] && $r['tag']==$row['tagTicket']){
                    cartTicket("football.php",$r['tag'],$r['team1'],$r['logo1'],$r['team2'],$r['logo2'],$r['location'],$r['date'],$r['price'],$r['id'],$row['number']);
                }
            }
            $res=getData("basketball");
            while($r=mysqli_fetch_assoc($res)){
                if($r['id']==$row['idTicket'] && $r['tag']==$row['tagTicket']){
                    cartTicket("basketball.php",$r['tag'],$r['team1'],$r['logo1'],$r['team2'],$r['logo2'],$r['location'],$r['date'],$r['price'],$r['id'],$row['number']);
                }
            }
            $res=getData("tennis");
            while($r=mysqli_fetch_assoc($res)){
                if($r['id']==$row['idTicket'] && $r['tag']==$row['tagTicket']){
                    cartTicket("tennis.php",$r['tag'],$r['team1'],$r['logo1'],$r['team2'],$r['logo2'],$r['location'],$r['date'],$r['price'],$r['id'],$row['number']);
                }
            }
            $res=getData("baseball");
            while($r=mysqli_fetch_assoc($res)){
                if($r['id']==$row['idTicket'] && $r['tag']==$row['tagTicket']){
                    cartTicket("baseball.php",$r['tag'],$r['team1'],$r['logo1'],$r['team2'],$r['logo2'],$r['location'],$r['date'],$r['price'],$r['id'],$row['number']);
                }
            }
          }
        }
    }
}

function cartCount(){
    $count=0;
    $result=getDataUser("users");

    while ($row = mysqli_fetch_assoc($result)){
      if($row['user_name']==$_SESSION['uname'])
        $id=$row['id'];
    }

    $results=getDataUser("cart");

    if($results){
        while ($row = mysqli_fetch_assoc($results)){
          if($row['idUser']==$id){
            $count=$count+1;
          }
        }
        return $count;
    }
}

function total()
{
    $total=0;
    $result=getDataUser("users");

    while ($row = mysqli_fetch_assoc($result)){
      if($row['user_name']==$_SESSION['uname'])
        $id=$row['id'];
    }

    $results=getDataUser("cart");

    if($results){
        while ($row = mysqli_fetch_assoc($results)){
          if($row['idUser']==$id){
            $res=getData("football");
            while($r=mysqli_fetch_assoc($res)){
                if($r['id']==$row['idTicket'] && $r['tag']==$row['tagTicket']){
                    $total=$total+$r['price']*$row['number'];
                }
            }
            $res=getData("basketball");
            while($r=mysqli_fetch_assoc($res)){
                if($r['id']==$row['idTicket'] && $r['tag']==$row['tagTicket']){
                    $total=$total+$r['price']*$row['number'];
                }
            }
            $res=getData("tennis");
            while($r=mysqli_fetch_assoc($res)){
                if($r['id']==$row['idTicket'] && $r['tag']==$row['tagTicket']){
                    $total=$total+$r['price']*$row['number'];
                }
            }
            $res=getData("baseball");
            while($r=mysqli_fetch_assoc($res)){
                if($r['id']==$row['idTicket'] && $r['tag']==$row['tagTicket']){
                    $total=$total+$r['price']*$row['number'];
                }
            }
          }
        }
        return $total;
    }
}

function totalNoLog(){
    $total=0;
    $product_id = array_column($_SESSION['cart'], 'product_id');
    $tag = array_column($_SESSION['cart'],'tag');
    $results = getData("football");
    while ($row = mysqli_fetch_assoc($results)){
      $count = count($_SESSION['cart']);
        for($i=0;$i<$count;$i++){
            if ($row['id'] == $product_id[$i] && $row['tag'] == $tag[$i]){
                $total=$total+$row['price']*$_SESSION['cart'][$i]['number'];
            }
        }
    }
    $results = getData("basketball");
    while ($row = mysqli_fetch_assoc($results)){
      $count = count($_SESSION['cart']);
        for($i=0;$i<$count;$i++){
            if ($row['id'] == $product_id[$i] && $row['tag'] == $tag[$i]){
                $total=$total+$row['price']*$_SESSION['cart'][$i]['number'];
            }
        }
    }
    $results = getData("tennis");
    while ($row = mysqli_fetch_assoc($results)){
      $count = count($_SESSION['cart']);
        for($i=0;$i<$count;$i++){
            if ($row['id'] == $product_id[$i] && $row['tag'] == $tag[$i]){
                $total=$total+$row['price']*$_SESSION['cart'][$i]['number'];
            }
        }
    }
    $results = getData("baseball");
    while ($row = mysqli_fetch_assoc($results)){
      $count = count($_SESSION['cart']);
        for($i=0;$i<$count;$i++){
            if ($row['id'] == $product_id[$i] && $row['tag'] == $tag[$i]){
                $total=$total+$row['price']*$_SESSION['cart'][$i]['number'];
            }
        }
    }
    return $total;
}
