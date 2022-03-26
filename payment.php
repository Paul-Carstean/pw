<?php 
session_start();

if(isset($_POST['order'])){
  if($_POST['firstname']=="" || empty($_POST['email']) || empty($_POST['address']) || empty($_POST['city']) || empty($_POST['state']) || empty($_POST['zip'])){
      unset($_SESSION['order']);
      header("Location: paymant.php?error=You must complete all fields");
  }
  if(preg_match("/([%\$#\*]+)/",$_POST['firstname'] ) || preg_match("/([%\$#\*]+)/", $_POST['email']) || preg_match("/([%\$#\*]+)/",$_POST['address'] ) || preg_match("/([%\$#\*]+)/",$_POST['city'] ) || preg_match("/([%\$#\*]+)/",$_POST['state'] ) ||preg_match("/([%\$#\*]+)/",$_POST['zip'] ))
    {
       header("Location: paymant.php");
    }
  $fullname=$_POST['firstname'];
  $email=$_POST['email'];
  $address=$_POST['address'];
  $city=$_POST['city'];
  $state=$_POST['state'];
  $zip=$_POST['zip'];
  $total=$_SESSION['total'];
  $command=$_SESSION['tickets'];
  $con=mysqli_connect("localhost", "root", "", "sportShop_db");
  $sql = "INSERT INTO orders(fullname, email, address, city, state, zip, total, command) VALUES('$fullname', '$email', '$address','$city','$state','$zip', '$total', '$command')";
  $result = mysqli_query($con, $sql);

  if(isset($_SESSION['uname'])){
    $id=$_SESSION['id'];
    $sql = " DELETE FROM cart WHERE idUser=$id;";
    $result = mysqli_query($con, $sql);
    
  }
  else{
    unset($_SESSION['cart']);
  }
  unset($_SESSION['tickets']);
  header("location:index.php");

}

if(isset($_POST['back'])){
  header("location:cart.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="css/paymentStills.css">
</head>
<body>
  <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
      <?php } ?>

          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>
<form action="payment.php" method="post">
  <div class="row">
    <div class="col-75">
      <div class="container">
        <form action="/action_page.php">
        
          <div class="row">
            <div class="col-50">
              <h3 style="color: white;">Billing Address</h3>
              <label for="fname"><i class="fa fa-user"></i> Full Name</label>
              <input type="text" id="fname" name="firstname" placeholder="...">
              <label for="email"><i class="fa fa-envelope"></i> Email</label>
              <input type="text" id="email" name="email" placeholder="...">
              <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
              <input type="text" id="adr" name="address" placeholder="...">
              <label for="city"><i class="fa fa-institution"></i> City</label>
              <input type="text" id="city" name="city" placeholder="...">

              <div class="row">
                <div class="col-50">
                  <label for="state">State</label>
                  <input type="text" id="state" name="state" placeholder="...">
                </div>
                <div class="col-50">
                  <label for="zip">Zip</label>
                  <input type="text" id="zip" name="zip" placeholder="...">
                </div>
              </div>
            </div>
          </div>

          <div>
            <button type="submit" class="btn2" name="back">Back</button>
            <button type="submit" class="btn1" name="order">Finish order</button>
          </div>

        </form>
      </div>
    </div>    
  </div>
</form>

</body>
</html>
