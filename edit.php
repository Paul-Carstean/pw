<?php
    session_start();
    require_once('./tickets.php');
    require_once('./db_conn.php');

    $result=getData($_SESSION['table']);
    while($row=mysqli_fetch_assoc($result)){
        if($_SESSION['id'] === $row['id'])
            break;
    }

    if(isset($_POST['edit'])){
     if(empty($_POST['team1']) || empty($_POST['team2']) || empty($_POST['location']) || empty($_POST['date']) || empty($_POST['price']) || empty($_FILES['logo1']['name']) || empty($_FILES['logo1']['name'])){
        header("Location: edit.php?error=You must complete all fields");
    }
    else if(!is_numeric($_POST['price']))
            header("Location: edit.php?error=Price must be a number");
    $id=$_SESSION['id'];
    $table=$_SESSION['table'];
    $team1=$_POST['team1'];
    $team2=$_POST['team2'];
    $logo1=$_FILES['logo1']['name'];
    $logo2=$_FILES['logo2']['name'];
    $location=$_POST['location'];
    $date=$_POST['date'];
    $price=$_POST['price'];
    $con=mysqli_connect("localhost", "root", "", "sports");
    $sql = "UPDATE $table SET team1='$team1', logo1='./logos/{$table}/{$logo1}', team2='$team2', logo2='./logos/{$table}/{$logo2}', location='$location', date='$date', price='$price' WHERE id='$id';";
    $result = mysqli_query($con, $sql);
    header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SportShop</title>
  <link rel="stylesheet" href="css/addStill.css">

  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
  <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
</head>
<body>
    <form action="edit.php" method="post" enctype="multipart/form-data" style="border-color: #bdb8d7;">
        <h2 style="color: #bdb8d7;">EDIT TICKET</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p style="margin-left:380px; color:red;" class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <div class="imp">
            <label style="margin-right: 9px">Team 1:</label>
            <input type="text" name="team1" value="<?php echo $row['team1'] ?>" ><br>
        </div>
        <div class="imp">
            <label style="margin-right: 13px">Logo 1:</label>
            <input style="border: none; color: #bdb8d7; " type="file" name="logo1" accept="image/png"><br>
        </div>
        <div class="imp">
            <label style="margin-right: 9px;">Team 2:</label>
            <input type="text" name="team2" value="<?php echo $row['team2'] ?>" ><br>
        </div>
        <div class="imp">
            <label style="margin-right: 13px">Logo 2:</label>
            <input style="border: none; color: #bdb8d7; " type="file" name="logo2" accept="image/png"/><br>
        </div>
        <div class="imp">
            <label>Location:</label>
               <input type="text" name="location" value="<?php echo $row['location'] ?>" ><br> 
        </div>
        <div class="imp">
            <label style="margin-right: 30px">Date:</label>
            <input type="text" name="date" value="<?php echo $row['date'] ?>" ><br>
        </div>
        <div class="imp">
            <label style="margin-right: 27px">Price:</label>
            <input type="text" name="price" value="<?php echo $row['price'] ?>" ><br>
        </div>

        <div style="margin-right:255px; margin-top:20px;">
            <button type="submit" name="edit" >EDIT</button>
            <a href="admin.php" style="text-decoration: none; color:white;"><button type="button" >BACK</button></a>
        </div>
        
     </form>
</body>
</html>