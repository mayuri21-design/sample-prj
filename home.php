<?php

session_start();
include_once("connect.php");

if (!isset($_SESSION["username"])) {
    header('Location: login.php');
    exit();
}

$_SESSION['message']="";

?>

<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>Home | Scheduler</title>
	<link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
	<!-- bootstrap -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<style type="text/css">
		html,
		body {
			margin: 0;
			padding: 0;
			background: white;
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

		#appButtonContainer {
			display: inline-block;
			background: #FFC000;
			color: white;
			font-size: 2.5em;
			padding: 1.1%;
			margin: 2%;
			margin-left: 16%;
			min-width: 15%;
			letter-spacing: 0.2rem;
		}

		#appButtonContainer:hover {
			transform: scale(1.2);
		}

		#invitesButtonContainer {
			display: inline-block;
			background: #FFC000;
			font-size: 2.5em;
			padding: 1.1%;
			margin: 2%;
			margin-left: 10%;
			min-width: 7%;
			letter-spacing: 0.2rem;
		}

		#invitesButtonContainer:hover {
			transform: scale(1.2);
		}

		#logoutButtonContainer {
			display: inline-block;
			background: #FFC000;
			font-size: 2.5em;
			padding: 1.2%;
			margin: 2%;
			margin-left: 10%;
			min-width: 7%;
			letter-spacing: 0.2rem;
		}

		#logoutButtonContainer:hover {
			transform: scale(1.2);
		}

		#eventsButtonContainer {
			display: inline-block;
			background: #FFC000;
			font-size: 2.5em;
			padding: 1.1%;
			margin: 2%;
			margin-left: 10%;
			min-width: 7%;
			letter-spacing: 0.2rem;
		}

		#eventsButtonContainer:hover {
			transform: scale(1.2);
		}

		.sessionDisplay {
			color: black;
			font-family: 'Poppins';
			letter-spacing: 0.1em;
			font-size: 1.4em;
			/* margin-left: 74vw; */
			margin-left: 16vw;

			margin-top: 6vh;
		}

		#profile {
			margin-bottom: 20px;
		}


		.userDisplay {
			margin-bottom: 3%;
		}


		.t_head {
			background-color: #54e85b;
			border-color: blue;
		}
	</style>
</head>

<body>
	<a onclick="home()">
		<h1 class="title">WCE Event Scheduler</h1>
	</a>
	<div class="tagline">Web Application To Manage Events</div>
	<span id="appButtonContainer"><a onclick="appointments()">Appointments</a></span>
	<span id="invitesButtonContainer"><a onclick="invites()">Invites</a></span>
	<span id="logoutButtonContainer"><a onclick="logout()">Logout</a></span>
	<span id="eventsButtonContainer"><a onclick="window.location.href='appointmentdisplay.php'">Events</a></span>

	<div class="sessionDisplay">
		<div>
			<h1 id="profile">Profile</h1>
		</div>
		<table id="users" class="table table-bordered" style="font-family:Piazzolla">
			<thead>
				<tr>
					<th scope="col" class="t_head">Field</th>
					<th scope="col" class="t_head">Value</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row">User</th>
					<td><?php echo $_SESSION["username"];?>
					</td>
				</tr>
				<tr>
					<th scope="row">E-mail</th>
					<td><?php echo $_SESSION["email"];?>
					</td>
				</tr>
				<tr>
					<th scope="row">Department</th>
					<td><?php echo $_SESSION["Department"];?>
					</td>
				</tr>
				<tr>
					<th scope="row">Designation</th>
					<td><?php echo $_SESSION["designation"];?>
					</td>
				</tr>
				<tr>
					<th scope="row">Higher Education</th>
					<td><?php echo $_SESSION["HigherE"];?>
					</td>
				</tr>
				<tr>
					<th scope="row">Research Area</th>
					<td><?php echo $_SESSION["ResearchA"];?>
					</td>
				</tr>
				<tr>
					<th scope="row">contact</th>
					<td><?php echo $_SESSION["contact"];?>
					</td>
				</tr>
			</tbody>
		</table>


	</div>
	<script src="functions.js"></script>
</body>

</html>