<?php

session_start();
$_SESSION['message']="";
include_once("connect.php");

if (!isset($_SESSION["username"])) {
    header('Location: login.php');
    exit();
}

include_once("createDataTable.php");

$username = $_SESSION["username"];
$tablename = $username."appointments";


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

        .btn {
            text-align: center;
            letter-spacing: 0.1em;
            margin-bottom: 2%;
            margin-top: 2%;
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
                <th scope="col">act</th>

                <th scop="col">operation</th>

            </tr>
        </thead>
        <tbody>
            <?php


$selectquery="select * from $tablename";
$query=mysqli_query($conn, $selectquery);
$num=mysqli_num_rows($query);
while ($res=mysqli_fetch_array($query)) {  //it will return array
?>
            <tr>
                <td scope="row"><?php echo $res['id']?>
                </td>
                <td><?php echo $res['AppointmentDate']?>
                </td>
                <td><?php echo $res['Title']?>
                </td>
                <td><?php echo $res['Description']?>
                </td>
                <td><?php echo $res['FromTime']?>
                </td>
                <td><?php echo $res['ToTime']?>
                </td>
                <td><?php echo $res['Inviter']?>
                </td>
                <td><?php echo $res['Invitee']?>
                </td>
                <td><?php echo $res['Status']?>
                </td>
                <td><?php echo $res['Notification']?>
                </td>
                <td><?php echo $res['events']?>
                </td>
                <td><?php echo $res['eventlevel']?>
                </td>
                <td><?php echo $res['act']?>
                </td>

                <td><a href="deleteappointment.php?id=<?php echo $res['id'];?>"
                        data-toggle="tooltip" title="Delete" data-placement="bottom">
                        <i class="fas fa-trash-alt"></i></a></td>
                </td>

            </tr>
            <?php
           }
            ?>
        </tbody>
    </table>
    <button class="btn btn-primary btn" name="allusers" onclick="window.location.href='AlluserEvents.php'">All User
        Events</button>
    <footer>
        <p id="foot"><a id="nameLink" href="http://www.walchandsangli.ac.in">Walchand College Of Engineering Sangli</a>
        </p>
    </footer>


    <script src="functions.js"></script>
</body>

</html>