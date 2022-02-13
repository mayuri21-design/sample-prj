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

    $sql = "SELECT email FROM $tablename where username='$username';";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        $row = $result->fetch_assoc();
        $to_email=$row["email"];
        $subject ="\xF0\x9F\x95\x90 test \xF0\x9F\x95\x90";
        $body = "---Alert ---";
        $message = "
        <html>
        <head>
        <title>WCE Event Manager</title>
        </head>
        <body>
        <p>App to manage event application</p>
        <h3>--Remainder for the Event scheduled on the next day--</h3>
        </body>
        </html>
        ";
        // Always set content-type when sending HTML email
        $headers = "From: 77208r6927@gmail.com";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\b";

        
 
        if (mail($to_email, $subject, $message, $headers)) {
            echo "Email successfully sent to $to_email...";
            header('location:appointments.php');
        } else {
            echo "Email sending failed...";
            header('location:appointments.php');
        }
    } else {
        echo "0 results";
    }
