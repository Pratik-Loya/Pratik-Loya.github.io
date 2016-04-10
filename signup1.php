<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>MCQ TEST</title>

        <!-- Google Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="css/animate.css">
        <!-- Custom Stylesheet -->
        <link rel="stylesheet" href="css/style.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    </head>
    <style>
        .personal_info {
    padding-top: 15px;
    width: 340px;

}
.personal_info label{
    float: left;
    width: 100px;
}

    </style>
    <body>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "pratik";
        $dbname = "questions";
        $nameErr = $emailErr = $passErr = $confirmErr =  "";
        $name = $email = $pass = $confirm = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["Name"])) {
                $nameErr = "Name is required";
            } else if (!preg_match("/^[a-zA-Z ]*$/", $_POST["Name"])) {
                $nameErr = "Only letters and white space allowed";
            } else {
                $name = test_input($_POST["Name"]);
            }

            if (empty($_POST["email_id"])) {
                $emailErr = "Email is required";
            } else if (!filter_var(($_POST["email_id"]), FILTER_VALIDATE_EMAIL) == TRUE) {
                $emailErr = "Invalid email format";
            } else {
                $email = test_input($_POST["email_id"]);
            }

            if (empty($_POST["password1"])) {
                $passErr = "Password is required";
            } else if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{4,10}$/', $_POST["password1"])) {
                $passErr = "should include number,upper,lower case alphabets & minimum 8 chars";
            } else {
                $pass = test_input($_POST["password1"]);
            }

            if (empty($_POST["password"])) {
                $confirmErr = "Password is required";
            } else if ($_POST["password"] != $_POST["password1"]) {
                $confirmErr = "Password does not matches";
            } else {
                $confirm = test_input($_POST["password"]);
            }
      if ($name == $_POST["Name"] and $pass == $_POST["password1"] and $confirm == $_POST["password"] and $email == $_POST["email_id"]) {
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "INSERT INTO user (username, emailid, password)
                VALUES ('$name', '$email', '$pass')";

                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
         <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
        <div class="container">
            <div class="top">
                <h1 id="title" class="hidden"><span id="logo">MCQ<span>  TEST</span></span></h1>
            </div>
            <div class="login-box animated fadeInUp">
                <div class="box-header">
                    <h2>Sign-Up</h2>
                </div>
                <div class="personal_info">
                        <label> Name    :</label>
                        <input type="text" value="" name="Name">*<?php echo $nameErr; ?></br></br>
                        </br>
                        <label>email id:  </label><input type="text" value="" name="email_id">*<?php echo $emailErr; ?></br></br>
                        </br>

                        <label>Password:  </label> <input type="password" value="" name="password1">*<?php echo $passErr; ?></br></br>
                        </br>
                        <label>Confirm Password: </label> <input type="password" name="password">*<?php echo $confirmErr; ?></br></br>

                        </br>
                      
                 <center><input type="Submit"></center>
                </div>
            </div>
        </div>
             </form>
    </body>
</html>