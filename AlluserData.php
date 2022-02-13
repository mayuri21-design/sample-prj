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
 


?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Scheduler</title>
    <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>


    <!-- bootstrap links -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
        integrity="sha512-PgQMlq+nqFLV4ylk1gwUOgm6CtIIXkKwaIHp/PAIWHzig/lKZSEGKEysh0TCVbHJXCLN7WetD8TFecIky75ZfQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>

    <!--bootsrap ended  -->


    <style type="text/css">
        html,
        body {
            margin: 0;
            padding: 0;
            background-color: white;
            /* #1A1A1D */
            font-family: 'Piazzolla';
        }

        .title {
            text-align: center;
            background: #111111;
            color: yellow;
            font-family: 'Piazzolla';
            letter-spacing: 0.1em;
            font-size: 4em;
            padding: 5px;
        }

        .tagline {
            text-align: center;
            color: rgb(44, 112, 238);
            font-family: 'Piazzolla';
            letter-spacing: 0.1em;
            font-size: 2.5em;
            padding: 5px;
            margin-bottom: 2%;
            margin-top: 2%;

        }

        th {
            background-color: #54e85b;

        }

        #foot {
            margin-top: 40vh;
            color: orange;
            text-align: center;
            font-size: 1.5em;
            letter-spacing: 4px;
            font-family: 'Piazzolla';
            font-weight: 1.8rem;
        }
    </style>
</head>

<body>
    <a onclick="#">
        <h1 class="title">Welcome to WCE Event Scheduler</h1>
    </a>
    <div class="tagline"> Web Application To Manage Events</div>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">AppointmentDate</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">FromTime</th>
                <th scope="col">ToTime</th>
                <th scope="col">Inviter</th>
                <th scope="col">Invitee</th>
                <th scope="col">Status</th>
                <th scope="col">Notification</th>
                <th scope="col">events</th>
                <th scope="col">eventlevel</th>
                <th scope="col">Activity</th>


            </tr>
        </thead>
        <tbody>
            <?php
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
                 foreach ($N_tablename as $user_list) {
                     $p=0;
                     $n_sql = "select * From  $user_list;";
                     $res = $conn->query($n_sql);
                     while ($n_res=$res->fetch_assoc()) {
                         $Idval[]=$n_res['id'];
                         $Adate[]=$n_res['AppointmentDate'];
                         $Ttitle[]=$n_res['Title'];
                         $Adesc[]=$n_res['Description'];
                         $Ftime[]=$n_res['FromTime'];
                         $TTime[]=$n_res['ToTime'];
                         $IInviter[]=$n_res['Inviter'];
                         $IInvitee[]=$n_res['Invitee'];
                         $SStatus[]=$n_res['Status'];
                         $NNotification[]=$n_res['Notification'];
                         $Eevents[]=$n_res['events'];
                         $Eeventlevel[]=$n_res['eventlevel'];
                         $AAct[]=$n_res['act'];
                     }
                     $Idval_list =array_keys($Idval);
                     $Adate_list =array_keys($Adate);

                     $Ttitle_list =array_keys($Ttitle);
                     $Adesc_list =array_keys($Adesc);
                     $Ftime_list =array_keys($Ftime);
                     $TTime_list =array_keys($TTime);
                     $IInviter_list =array_keys($IInviter);
                     $IInvitee_list =array_keys($IInvitee);
                     $SStatus_list =array_keys($SStatus);
                     $NNotification_list =array_keys($NNotification);
                     $Eevents_list =array_keys($Eevents);
                     $Eeventlevel_list =array_keys($Eeventlevel);
                     $AAct_list =array_keys($AAct);


                     $min=min(
                         count($Idval),
                         count($Adate),
                         count($Ttitle),
                         count($Adesc),
                         count($Ftime),
                         count($TTime),
                         count($IInviter),
                         count($IInvitee),
                         count($SStatus),
                         count($NNotification),
                         count($Eevents),
                         count($Eeventlevel),
                         count($AAct)
                     ); ?>
            <tr>
                <td scope="row"><?php
                        //  print_r($names[$p]);
                        echo "users"; ?>
                </td>
            </tr>

            <?php
                     for ($i=0;$i<$min;$i++) { ?>
            <tr>

                <td scope="row"><?php echo  $Idval[$Idval_list[$i]]; ?>
                </td>
                <td scope="row"><?php echo  $Adate[$Adate_list[$i]]; ?>
                </td>
                <td><?php echo  $Ttitle[$Ttitle_list[$i]]; ?>
                </td>
                <td scope="row"><?php echo  $Adesc[$Adesc_list[$i]]; ?>
                </td>
                <td><?php echo  $Ftime[$Ftime_list[$i]]; ?>
                </td>
                <td><?php echo  $TTime[$TTime_list[$i]]; ?>
                </td>
                <td><?php echo  $IInviter[$IInviter_list[$i]]; ?>
                </td>
                <td scope="row"><?php echo  $IInvitee[$IInvitee_list[$i]]; ?>
                </td>
                <td><?php echo  $SStatus[$SStatus_list[$i]]; ?>
                </td>
                <td scope="row"><?php echo  $NNotification[$NNotification_list[$i]]; ?>
                </td>
                <td><?php echo  $Eevents[$Eevents_list[$i]]; ?>
                </td>
                <td scope="row"><?php echo  $Eeventlevel[$Eeventlevel_list[$i]]; ?>
                </td>
                <td scope="row"><?php echo  $AAct[$AAct_list[$i]]; ?>
                </td>
                <td colspan="10">
                    <hr>
                </td>

            </tr>

            <?php
                     }
                 }
                 ?>
        </tbody>
    </table>

    <footer>
        <p id="foot"><a id="nameLink" href="http://www.walchandsangli.ac.in">Walchand College Of Engineering Sangli</a>
        </p>
    </footer>
</body>

</html>