<?php

session_start();
include_once('connect.php');
include_once("createDb.php");
$_SESSION['message']="";

$tablename = "user";

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $sql = "USE Scheduler;";
    $conn->query($sql);

    $_SESSION['message']="";
    $allow=1;

    // $url ='https://www.google.com/recaptcha/api/siteverify';
    // include_once("config.php");//To include $privateKey variable which contains the secret key to Google reCaptacha's API

    // $response = file_get_contents($url."?secret=".$privateKey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);
    // $data = json_decode($response);

    // if (!((isset($data->success))and($data->success==true))) {
    //     $_SESSION['message'] = 'Captcha Failed!';
    //     $allow=0;
    // }

    $username = $conn->real_escape_string($_POST['username']);
    $email = $_POST['email'];

    //start code
    $Department=$_POST['Department'];
    $designation=$_POST['designation'];
    $HigherE=$_POST['HigherE'];
    $ResearchA=$_POST['ResearchA'];
    $contact=$_POST['contact'];
    //end code

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = 'Please enter a valid E-Mail address!';
        $allow=0;
    }

    if (!preg_match("/^[a-zA-Z0-9_.-]*$/", $_POST['username'])) {
        $_SESSION['message'] = 'Your username can only contain letters, numbers, underscore, dash, point, no other special characters are allowed!';
        $allow=0;
    }

    // start code

    // end code

    $sql = "SELECT * FROM $tablename;";
    $result = $conn->query($sql);

    if ($result->num_rows>0) {
        while ($row = $result->fetch_assoc()) {
            if ($row["username"]==$username) {
                $_SESSION['message'] = 'Username already exists!';
                $allow=0;
            }

            if ($row["email"]==$email) {
                $_SESSION['message'] = 'E-Mail already exists!';
                $allow=0;
            }
        }
    }

    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{4,}$/", $_POST['password'])) {
        $_SESSION['message'] = 'Your password should contain minimum four characters, at least one letter and one number!';
        $allow=0;
    }


    if ($allow==1) {

        //if two passwords are equal to each other
        if ($_POST["password"]==$_POST["confirmpassword"]) {
            $password = md5($_POST['password']); //md5 hash password for security

            //set session variables
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;

            //start code
            $_SESSION['Department']=$Department;
            $_SESSION['designation']= $designation;
            $_SESSION['HigherE']=  $HigherE;
            $_SESSION['ResearchA']=$ResearchA;
            $_SESSION['contact']= $contact;
            //end code

            include("createDataTable.php");

            //insert user data into database
            $stmt = $conn->prepare("INSERT INTO $tablename (username,email,password,Department,designation,HigherE,ResearchA,contact) "."VALUES (?,?,?,?,?,?,?,?)");
            if (!$stmt) {
                echo "Error preparing statement ".htmlspecialchars($conn->error);
            }
            $stmt->bind_param("sssssssi", $username, $email, $password, $Department, $designation, $HigherE, $ResearchA, $contact);
            
            if ($stmt->execute() === true) {
                $_SESSION['message'] = "Registration succesful! Added $username to the database!";
                header("location: home.php");
            } else {
                $_SESSION['message'] = 'User could not be added to the database!';
            }

            $stmt->close();
            $conn->close();
        } else {
            $_SESSION['message'] = 'Two passwords do not match!';
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Sign Up | Scheduler</title>
    <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- bootstrap links -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

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
            background: white;
            font-family: 'Piazzolla';
        }

        .title {
            text-align: center;
            background: #111111;
            background: ;
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
            margin-bottom: 1%;
        }

        #registerTitle {
            text-align: center;
            color: orange;
            font-family: 'Piazzolla';
            letter-spacing: 0.4em;
            font-size: 2.5em;
            padding: 5px;
            padding-bottom: 0px;
        }

        #errMsg {
            overflow: auto;
            background: red;
            margin-top: -10px;
            letter-spacing: 0.1em;
            font-size: 1.1em;
            margin-left: 42.2vw;
            width: 14vw;
            padding: 3px;
            padding-left: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        #usernameIn {
            height: 20px;
            border-radius: 3px;
            margin: 10px;
            font-family: 'Piazzolla';
            letter-spacing: 0.1em;
            font-size: 1.3em;
            margin-left: 42vw;
        }

        #emailIn {
            height: 20px;
            border-radius: 3px;
            margin: 15px;
            font-family: 'Piazzolla';
            letter-spacing: 0.1em;
            font-size: 1.3em;
            margin-left: 42vw;
        }

        .passIn {
            height: 20px;
            border-radius: 3px;
            margin: 15px;
            font-family: 'Piazzolla';
            letter-spacing: 0.1em;
            font-size: 1.3em;
            margin-left: 42vw;
        }

        .reCaptchaClass {
            margin-left: 40.5vw;
            margin-top: 1vh;
            margin-bottom: 1vh;
        }

        #submitIn {
            margin-top: 1%;
            border-radius: 3px;
            font-family: 'Piazzolla';
            letter-spacing: 0.3em;
            font-size: 1.1em;
            margin-left: 43.4vw;
            min-width: 7vw;
        }

        .options {
            margin-top: 5vh;
        }

        .text {
            font-family: 'Piazzolla';
            color: orange;
            font-size: 1.2em;
            margin-left: 35.3vw;
        }

        #loginb {
            border-radius: 3px;
            font-family: 'Piazzolla';
            letter-spacing: 0.3em;
            font-size: 1em;
            min-width: 7vw;

        }

        #foot {
            margin-top: 5vh;
            color: white;
            text-align: center;
            font-size: 1.5em;
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
    <h2 id="registerTitle">Sign Up</h2>
    <form action="register.php" method="post" autocomplete="off">
        <div id="errMsg"><?= $_SESSION['message'] ?><span
                id="errMsg1"></span></div>
        <div><input id="usernameIn" type="text" placeholder="Username" name="username"
                onkeyup="usernameAvailabilty(this.value);" onblur="usernameFocusOut();" required /></div>
        <div><input id="emailIn" type="email" placeholder="Email" name="email" required /></div>

        <!-- code -->
        <label for="designation" id="emailIn" style="color:black;background-color:lightblue">Designation</label>
        <select name="designation" id="emailIn">
            <option value="">-- Choose a option --</option>
            <option value="HOD">HOD</option>
            <option value="Admin">Admin</option>
            <option value="Faculty" selected>Faculty </option>
        </select>


        <label for="Department" id="emailIn" style="color:black;background-color:lightblue">Department</label>
        <select name="Department" id="emailIn">
            <option value="">--Choose a option --</option>
            <option value="Computer Science" selected>Computer Science</option>
            <option value="mechanical Engineernig">mechanical Engineernig</option>
            <option value="Information Technology">Information Technology</option>
            <option value="civil Engineernig">civil Engineernig</option>
            <option value="Electrical Engineernig">Electrical Engineernig</option>
            <option value="Electronics Engineernig">Electronics Engineernig</option>
            <option value="other">other</option>
        </select>


        <label for="HigherE" id="emailIn" style="color:black; background-color:lightblue">Higher Education</label>
        <select name="HigherE" id="emailIn">
            <option value="">-- Choose a option --</option>
            <option value="BTech">Btech</option>
            <option value="MTech">MTech</option>
            <option value="PHD" selected>PHD</option>
            <option value="other">other</option>
        </select>


        <label for="ResearchA" id="emailIn" style="color:black;background-color:lightblue">Research Area</label>
        <select name="ResearchA" id="emailIn">
            <option value="">-- Choose a option --</option>
            <option value="ML">ML</option>
            <option value="Data Science">Data Science</option>
            <option value="Big Data" selected>Big Data</option>
            <option value="cyber security">Cyber Security</option>
            <option value="other">other</option>
        </select>

        <input id="emailIn" type="tel" name="contact" placeholder="contact Number" />

        <!-- end code -->

        <div><input class="passIn" type="password" placeholder="Password" name="password" required /></div>
        <div><input class="passIn" type="password" placeholder="Confirm Password" name="confirmpassword" required />
        </div>
        <!-- <div class="reCaptchaClass">
            <div class="g-recaptcha" data-sitekey="6Leby0MeAAAAAGpjNl5fOfQfqZbSO0ls0lIYKec7"></div>
        </div> -->
        <div><input style="background-color:#0096FF" id="submitIn" type="submit" value="Register" name="register" />
        </div>
    </form>
    <div class="options">
        <span class="text">Already have an account?</span>
        <span><button style="background-color:#FF3131" id="loginb" class="bt btn-alert"
                onclick="login()">Login</button></span>
    </div>
    <footer>
        <p id="foot"><a id="nameLink" href="http://www.walchandsangli.ac.in">Walchand College Of Engineering Sangli</a>
        </p>
    </footer>
    <script>
        function login() {
            window.location = "login.php";
        }
    </script>
    <script src="register.js"></script>
</body>

</html>