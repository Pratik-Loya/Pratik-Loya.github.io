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

    <body>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "pratik";
        $dbname = "questions";
        $nameErr = $passErr = "";
        $name = $pass = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["Name"])) {
                $nameErr = "Name is required";
            } else if (!preg_match("/^[a-zA-Z ]*$/", $_POST["Name"])) {
                $nameErr = "Only letters and white space allowed";
            } else {
                $name = test_input($_POST["Name"]);
            }

            if (empty($_POST["password1"])) {
                $passErr = "Password is required";
            } else if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{4,10}$/', $_POST["password1"])) {
                $passErr = "should include number,upper,lower case alphabets & minimum 8 chars";
            } else {
                $pass = test_input($_POST["password1"]);
            }

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $flag = 0;
            $sql = "SELECT username, password FROM user";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    //echo " - Name: " . $row["firstname"] . "Password " . $row["password"] . "<br>";
                    if ($row["username"] == $_POST["Name"] and $row["password"] == $_POST["password1"]) {
                        $flag = 1;
                        echo "YOU HAVE SUCCESSFULLY LOGED IN";
                    }
                }
            } else {
                echo "0 results";
            }
            $random = range(1, 13);
            shuffle($random);
            $_SESSION['question'] = $random;
            if ($flag == 1) {
                echo "flag = ",$flag;
               
                header("refresh:0;url=QUESTION.php");
            } else {
                echo "<h2>SORRY NO DATA FOUND</h2>";
            }

            $_SESSION["name"] = $name;
            $_SESSION["result"] = 0;
            $_SESSION["temp"] = 0;

            // echo "Session variables are set.";
            $conn->close();
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
                    <h2>Log In</h2>
                </div>
                <label for="username">Username</label>
                <br/>
                <input type="text" value="" name="Name"><?php echo $nameErr; ?>
                <br/>
                <label for="password">Password</label>
                <br/>
                 <input type="password" value="" name="password1"><?php echo $passErr; ?>
                <br/>
                <button type="submit">Sign In</button>
                <br/>
                <a href="signup1.php"><h6 class="small">Don't have account?</br>Sign up here</h6></a>
                <a href="signup1.php"><h6 class="small">Forgot Your Password?</h6></a>
            </div>
        </div>
             </form>
    </body>
</html>