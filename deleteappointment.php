<?php

session_start();
$_SESSION['message']="";
include_once("connect.php");

if (!isset($_SESSION["username"])) {
    header('Location: login.php');
    exit();
}

?>
<!DOCTYPE html>
<html>

<head>
    <!-- font awesome -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
        integrity="sha512-PgQMlq+nqFLV4ylk1gwUOgm6CtIIXkKwaIHp/PAIWHzig/lKZSEGKEysh0TCVbHJXCLN7WetD8TFecIky75ZfQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

</html>

<?php
 include_once("createDataTable.php");

 $username = $_SESSION["username"];
$tablename = $username."appointments";

$id=$_GET['id'];
 $deletequery="delete from $tablename where id=$id";
 if (mysqli_query($conn, $deletequery)) {
     echo "<script>alert('Event deleted Successfully');</script>";
 } else {
     echo "<script>alert('Event not deleted');</script>";
 }//location where to return
header('location:appointmentdisplay.php');
