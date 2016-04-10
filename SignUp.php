<!DOCTYPE html>

<html>
    <head>
        <title>SIGN UP</title>
        <link rel="stylesheet"  href="css/style.css"/>
        <meta charset="UTF-8">
    </head>
    <style>
        
.Login{
    width: 700px;
    height: 400px;
    margin-left: 400px;
    margin-top: 120px;
    background-color: white;
    padding-right: 50px;
}
.Login fieldset{
    margin-left: 50px;
    padding-top: 30px;
    
    
}
        
    </style>
    <body background="images/back.png">

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "pratik";
        $dbname = "Users";
        $nameErr = $emailErr = $passErr = $confirmErr = $phoneErr = "";
        $name = $email = $pass = $confirm = $phone = "";

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

            if (empty($_POST["phone"])) {
                $phoneErr = "Number is required";
            } else if (!preg_match("/^[0-9]*$/", $_POST["phone"])) {
                $phoneErr = "Incorrect Phone Number";
            } else {
                $phone = test_input($_POST["phone"]);
            }




            if ($name == $_POST["Name"] and $pass == $_POST["password1"] and $confirm == $_POST["password"] and $email == $_POST["email_id"] and $phone == $_POST["phone"]) {
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "INSERT INTO myusers (firstname, emailid, password, phonenumber)
            VALUES ('$name', '$email', '$pass', '$phone')";

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




        <div class="Login">

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 


                </br></br></br>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
                    <fieldset class="personal_info">

                        <label> Name    :</label>
                        <input type="text" value="" name="Name">*
<?php echo $nameErr; ?></br></br>
                        </br>
                        <label>email id:  </label>
                        <input type="text" value="" name="email_id">*
<?php echo $emailErr; ?></br></br>
                        </br>

                        <label>Password:  </label>
                        <input type="password" value="" name="password1">*
<?php echo $passErr; ?></br></br>
                        </br>
                        <label>Confirm Password: </label>
                        <input type="password" name="password">*
<?php echo $confirmErr; ?></br></br>

                        </br>
                        <label>Phone Number:  </label>
                        <input type="text" value="" name="phone">*
<?php echo $phoneErr; ?></br></br>

                    </fieldset></br>
                    <a href="index.php"> <center><input type="Submit"></center></a>
                </form>

        </div>
  

</body>
</html>
