<?php

session_start();
require_once('./tickets.php');
require_once('./db_conn.php');

if(isset($_POST['add'])){
    $sport = filter_input(INPUT_POST, 'sports', FILTER_SANITIZE_STRING);
    if(empty($_POST['team1']) || empty($_POST['team2']) || empty($_POST['location']) || empty($_POST['date']) || empty($_POST['price']) || empty($_FILES['logo1']['name']) || empty($_FILES['logo1']['name']) || $sport === "none"){
        header("Location: add.php?error=You must complete all fields");
    }
    else if(!is_numeric($_POST['price']))
            header("Location: add.php?error=Price must be a number");
    $team1=$_POST['team1'];
    $team2=$_POST['team2'];
    $logo1=$_FILES['logo1']['name'];
    $logo2=$_FILES['logo2']['name'];
    $location=$_POST['location'];
    $date=$_POST['date'];
    $price=$_POST['price'];
    $con=mysqli_connect("localhost", "root", "", "sports");
    $sql = "INSERT INTO $sport(team1, logo1, team2, logo2, location, date, price) VALUES('$team1', './logos/{$sport}/{$logo1}', '$team2','./logos/{$sport}/{$logo2}','$location','$date',$price)";
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
    <form action="add.php" method="post" enctype="multipart/form-data" style="border-color: #bdb8d7;">
        <h2 style="color: #bdb8d7;">ADD TICKET</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p style="margin-left:380px; color:red;" class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <div class="imp">
            <label style="margin-right: 9px">Team 1:</label>
            <input type="text" name="team1" placeholder="Team 1" ><br>
        </div>
        <div class="imp">
            <label style="margin-right: 13px">Logo 1:</label>
            <input style="border: none; color: #bdb8d7; " type="file" name="logo1" accept="image/png"><br>
        </div>
        <div class="imp">
            <label style="margin-right: 9px;">Team 2:</label>
            <input type="text" name="team2" placeholder="Team 2" ><br>
        </div>
        <div class="imp">
            <label style="margin-right: 13px">Logo 2:</label>
            <input style="border: none; color: #bdb8d7; " type="file" name="logo2" accept="image/png"><br>
        </div>
        <div class="imp">
            <label>Location:</label>
            <input type="text" name="location" placeholder="Location" ><br>
        </div>
        <div class="imp">
            <label style="margin-right: 30px">Date:</label>
            <input type="text" name="date" placeholder="Date" ><br>
        </div>
        <div class="imp">
            <label style="margin-right: 27px">Price:</label>
            <input type="text" name="price" placeholder="Price" ><br>
        </div>
        <div class="imp">
            <label for="sports" style="margin-right: 25px">Sport:</label>
            <select name="sports" id="sports" style="height: 30px; width: 150px; font-size: 15px;color:#888;">
                <option value="none">None</option>
                <option value="football">Football</option>
                <option value="basketball">Baketball</option>
                <option value="tennis">Tennis</option>
                <option value="baseball">Baseball</option>
            </select>
        </div>

        <div style="margin-right:255px;">
            <button type="submit" name="add" >ADD</button>
            <a href="admin.php" style="text-decoration: none; color:white;"><button type="button" >BACK</button></a>
        </div>
        
     </form>
</body>
</html>