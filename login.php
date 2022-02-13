<?php

session_start();
include_once('connect.php');
$_SESSION['message']="";

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $username = trim($_POST['username']);
    $username = stripslashes($username);
    $username = htmlspecialchars($username);
    $username = $conn->real_escape_string($username);

    $password = md5($_POST['password']);
    include_once("createDb.php");
    $stmt = $conn->prepare("SELECT * FROM user WHERE username= ?;");
    if (!$stmt) {
        echo "Error preparing statement ".htmlspecialchars($conn->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows>0) {
        while ($row = $result->fetch_assoc()) {
            if ($row["password"]==$password) {
                $_SESSION["username"] = $username;
                $_SESSION["email"] = $row["email"];
                $_SESSION["Department"] = $row["Department"];
                $_SESSION["designation"] = $row["designation"];
                $_SESSION["HigherE"] = $row["HigherE"];
                $_SESSION["ResearchA"] = $row["ResearchA"];
                $_SESSION["contact"] = $row["contact"];
                

                include("createDataTable.php");
                header("location: home.php");
            } else {
                $_SESSION['message'] = "Sorry, Wrong Password!";
            }
        }
    } else {
        $_SESSION['message'] = "Username doesn't exist!";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>Login | Scheduler</title>
	<link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
	<style type="text/css">
		html,
		body {
			margin: 0;
			padding: 0;
			background: white;
			font-family: 'Sofia';
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

		#loginTitle {
			text-align: center;
			color: orange;
			font-family: 'Piazzolla';
			letter-spacing: 0.4em;
			font-size: 2.5em;
			padding: 5px;
			padding-bottom: 0px;
		}

		#errMsg {
			background: red;
			margin-top: -10px;
			letter-spacing: 0.1em;
			font-size: 1.1em;
			margin-left: 43.2vw;
			width: 14vw;
			padding: 3px;
			border-radius: 4px;
			margin-bottom: 10px;

		}

		.input_edit {
			padding: 8px;
		}

		#usernameIn {
			height: 20px;
			border-radius: 3px;
			margin: 10px;
			font-family: 'Piazzolla';
			letter-spacing: 0.1em;
			font-size: 1.3em;
			margin-left: 42.6vw;
		}

		#passIn {
			height: 20px;
			border-radius: 3px;
			margin: 10px;
			font-family: 'Piazzolla';
			letter-spacing: 0.1em;
			font-size: 1.3em;
			margin-left: 42.6vw;
		}

		#submitIn {
			margin-top: 1%;
			border-radius: 3px;
			font-family: 'Piazzolla';
			letter-spacing: 0.3em;
			font-size: 1.1em;
			margin-left: 45.1vw;
			min-width: 7vw;
			color: white;
			border: none;
			padding: 10px;


		}

		.options {
			margin-top: 10vh;
		}

		.text {
			font-family: 'Piazzolla';
			color: orange;
			font-size: 1.4em;
			margin-left: 40.5vw;
		}

		#signupb {
			border-radius: 3px;
			font-family: 'Piazzolla';
			letter-spacing: 0.3em;
			font-size: 1em;
			min-width: 7vw;
			color: white;
			border: none;
			padding: 10px;

		}

		#foot {
			margin-top: 12vh;
			color: white;
			text-align: center;
			font-size: 1.3em;
			letter-spacing: 4px;
		}

		#heart {
			color: red;
		}

		#nameLink {
			text-decoration: none;
			color: orange;
		}
	</style>
</head>

<body>
	<a onclick="#">
		<h1 class="title">WCE Event Scheduler</h1>
	</a>
	<div class="tagline">Web Application To Manage Events</div>
	<h2 id="loginTitle">Login</h2>
	<form class="formClass" action="login.php" method="post" autocomplete="off">
		<div id="errMsg"><?= $_SESSION['message'] ?>
		</div>
		<div><input id="usernameIn" class="input_edit" type="text" placeholder="Username" name="username" required />
		</div>
		<div><input id="passIn" class="input_edit" type="password" placeholder="Password" name="password" required />
		</div>
		<div><input id="submitIn" class="input_edit" style="background-color:#007bff" type="submit" value="Login"
				name="login" /></div>
	</form>
	<div class="options">
		<span class="text">New User?</span>
		<span><button id="signupb" class="input_edit" style="background-color:#007bff" onclick="register()">Sign
				Up</button></span>
	</div>
	<footer>
		<p id="foot"><a id="#">Walchand College Of Engineering Sangli</a></p>
	</footer>
	<script>
		function register() {
			window.location = "register.php";
		}
	</script>
</body>

</html>