<?php

session_start();
$_SESSION['message']="";
include_once("connect.php");

if (!isset($_SESSION["username"])) {
    header('Location: login.php');
    exit();
}

include_once("createDb.php");
include_once("createDataTable.php");

$tablename="user";
$A_tablename = $username."appointments";


$username = $_SESSION["username"];


    $sql = "SELECT designation FROM $tablename where username='$username';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
     if ($row['designation']=='Admin') {
         header('location:AlluserData.php');
     } else {
         ?>
<script>
    alert("Sorry you don't have access to it..");
</script>
<?php
     }
