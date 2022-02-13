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

$sql = "SELECT username FROM $tablename;";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $names[]=$row['username'];
    }
}

//to get appointment date corresponding to username

     foreach ($names as $name_list) {
         $N_tablename[] = $name_list."appointments";
     }


     $sys_date= date("Y-m-d");
     $sys_time=date('H:i:s');
     $date1=date_create($sys_date);
     foreach ($N_tablename as $user_list) {
         $n_sql = "SELECT AppointmentDate,FromTime FROM $user_list;";
         $res = $conn->query($n_sql);
         $dates=array();
         while ($n_res=$res->fetch_assoc()) {
             $dates[]=$n_res['AppointmentDate'];
             $time[]=$n_res['FromTime'];
         }
         $date_list =array_keys($dates);
         $time_list =array_keys($time);

         $min=min(count($dates), count($time));
         for ($i=0;$i<$min;$i++) {
             $final_date=$dates[$date_list[$i]];
             $final_time=$time[$time_list[$i]];
             $date2=date_create($final_date);
             $diff=date_diff($date1, $date2);
             if (($diff->format('%R%a'))==1) {
                 header('location:remaindermail.php');
             }
             $time1=new DateTime($sys_time);
             $time2=new DateTime($final_time);
             $time_diff=$time1->diff($time2);
             if (($date1==$date2) && ($time_diff->format('%h'))) {
                 header('location:remaindermail.php');
             }
         }
     }
