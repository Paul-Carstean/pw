<?php

$sname= "localhost";
$unmae= "root";
$password = "";

$db_name = "test_db";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}

function getData($table){
    $con=mysqli_connect("localhost", "root", "", "sports");
    $sql="SELECT * FROM $table";
    $result=mysqli_query($con,$sql);

    if(mysqli_num_rows($result)>0){
        return $result;
    }
}