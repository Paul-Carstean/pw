<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])
    && isset($_POST['name']) && isset($_POST['re_password'])) {

     function validate($data){
       $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
     }

     $uname = validate($_POST['uname']);
     $pass = validate($_POST['password']);

     $re_pass = validate($_POST['re_password']);
     $name = validate($_POST['name']);

     $user_data = 'uname='. $uname. '&name='. $name;

     if(preg_match("/([%\$#\*]+)/", $uname) || preg_match("/([%\$#\*]+)/", $name))
    {
       header("Location: signup.php?error=Invalid username");
         exit();
    }
     if (empty($uname)) {
          header("Location: signup.php?error=User Name is required&$user_data");
         exit();
     }else if(empty($pass)){
        header("Location: signup.php?error=Password is required&$user_data");
         exit();
     }
     else if(empty($re_pass)){
        header("Location: signup.php?error=Re Password is required&$user_data");
         exit();
     }

     else if(empty($name)){
        header("Location: signup.php?error=Name is required&$user_data");
         exit();
     }

     else if($pass !== $re_pass){
        header("Location: signup.php?error=The confirmation password  does not match&$user_data");
         exit();
     }

     else{

          // hashing the password
        $pass = md5($pass);

         $sql = "SELECT * FROM users WHERE user_name='$uname' ";
          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
               header("Location: signup.php?error=The username is taken try another&$user_data");
             exit();
          }else {
           $sql2 = "INSERT INTO users(user_name, password, name) VALUES('$uname', '$pass', '$name')";
           $result2 = mysqli_query($conn, $sql2);
           if ($result2) {
                header("Location: signup.php?success=Your account has been created successfully");
              exit();
           }else {
                    header("Location: signup.php?error=unknown error occurred&$user_data");
                  exit();
           }
          }
     }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP</title>
	<link rel="stylesheet" type="text/css" href="css/loginStill.css">
</head>
<body>
     <form action="signup.php" method="post" style="border-color: #bdb8d7;">
     	<h2 style="color: #bdb8d7;">SIGN UP</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>

          <label>Name</label>
          <?php if (isset($_GET['name'])) { ?>
               <input type="text" 
                      name="name" 
                      placeholder="Name"
                      value="<?php echo $_GET['name']; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="name" 
                      placeholder="Name"><br>
          <?php }?>

          <label>User Name</label>
          <?php if (isset($_GET['uname'])) { ?>
               <input type="text" 
                      name="uname" 
                      placeholder="User Name"
                      value="<?php echo $_GET['uname']; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="uname" 
                      placeholder="User Name"><br>
          <?php }?>


     	<label>Password</label>
     	<input type="password" 
                 name="password" 
                 placeholder="Password"><br>

          <label>Re Password</label>
          <input type="password" 
                 name="re_password" 
                 placeholder="Re_Password"><br>

     	<button type="submit">Sign Up</button>
          <a href="login.php" class="ca" style="color: #bdb8d7;">Already have an account?</a>
     </form>
</body>
</html>