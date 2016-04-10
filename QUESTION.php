<?php
session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>MCQ Question</title>
        <!-- BOOTSTRAP CORE STYLE CSS -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME CSS -->
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
        <!-- STYLE SWITCHER  CSS -->
        <link href="assets/css/styleSwitcher.css" rel="stylesheet" />
        <!-- CUSTOM STYLE CSS -->
        <link href="assets/css/style.css" rel="stylesheet" />  
        <!--GREEN STYLE VERSION IS BY DEFAULT, USE ANY ONE STYLESHEET FROM TWO STYLESHEETS (green or red) HERE-->
        <link href="assets/css/themes/green.css" id="mainCSS" rel="stylesheet" />   
        <!-- Google	Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
    </head>
    <body style="background:white;">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "pratik";
        $dbname = "questions";
        $question[10] = 0;

        $result1 = 0;
        $value[10] = 0;
        $isnotset = 0;
        $conn = new mysqli($servername, $username, $password, $dbname);

        if (!isset($_SESSION["name"])) {
            header("refresh:0; url=index.php");
        }

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $i = 0;
        while ($i != 10) {
            $question[$i] = $_SESSION['question'][$i];
            $i++;
        }

        $i = 0;
        while ($i != 10) {
            $sql = "SELECT question,number,option1,option2,option3,option4,answer FROM data WHERE number = $question[$i] ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $value[$i] = $row;
                }
            } else {
                echo "0 results";
            }
            $i++;
        }
        $i = 0;
        if ($_SESSION["temp"] == 1) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (!isset($_POST["option1"])) {
                    $SelectErr = "option is required";
                } else {
                    $select1 = test_input($_POST["option1"]);
                    if ($select1 == $value[0]["answer"]) {
                        $result1 = $result1 + 1;
                    }
                }
                if (!isset($_POST["option2"])) {
                    $SelectErr = "option is required";
                } else {
                    $select1 = test_input($_POST["option2"]);
                    if ($select1 == $value[1]["answer"]) {
                        $result1 = $result1 + 1;
                    }
                }
                if (!isset($_POST["option3"])) {
                    $SelectErr = "option is required";
                } else {
                    $select1 = test_input($_POST["option3"]);
                    if ($select1 == $value[2]["answer"]) {
                        $result1 = $result1 + 1;
                    }
                }
               if (!isset($_POST["option4"])) {
                    $SelectErr = "option is required";
                } else {
                    $select1 = test_input($_POST["option4"]);
                    if ($select1 == $value[3]["answer"]) {
                        $result1 = $result1 + 1;
                    }
                }

               if (!isset($_POST["option5"])) {
                    $SelectErr = "option is required";
                } else {
                    $select1 = test_input($_POST["option5"]);
                    if ($select1 == $value[4]["answer"]) {
                        $result1 = $result1 + 1;
                    }
                }

                if (!isset($_POST["option6"])) {
                    $SelectErr = "option is required";
                } else {
                    $select1 = test_input($_POST["option6"]);
                    if ($select1 == $value[5]["answer"]) {
                        $result1 = $result1 + 1;
                    }
                }

                if (!isset($_POST["option7"])) {
                    $SelectErr = "option is required";
                } else {
                    $select1 = test_input($_POST["option7"]);
                    if ($select1 == $value[6]["answer"]) {
                        $result1 = $result1 + 1;
                    }
                }

               if (!isset($_POST["option8"])) {
                    $SelectErr = "option is required";
                } else {
                    $select1 = test_input($_POST["option8"]);
                    if ($select1 == $value[7]["answer"]) {
                        $result1 = $result1 + 1;
                    }
                }

               if (!isset($_POST["option9"])) {
                    $SelectErr = "option is required";
                } else {
                    $select1 = test_input($_POST["option9"]);
                    if ($select1 == $value[8]["answer"]) {
                        $result1 = $result1 + 1;
                    }
                }

                if (!isset($_POST["option10"])) {
                    $isnotset = 1;
                    $SelectErr = "option is required";
                } else {
                    $select1 = test_input($_POST["option10"]);
                    if ($select1 == $value[9]["answer"]) {
                        $result1 = $result1 + 1;
                    }
                }
                $value = 1;
            }
            if ($isnotset == 1) {
                echo "<h2>Please select all option </h2>";
               $_SESSION["temp"] = 0;
               sleep(3);
               header("refresh:0;url=QUESTION.php"); 
               die;
            }
            else
            {
               if ($value == 1) {
                    $_SESSION["result"] = $result1;
                }
                header("refresh:0; url=result.php");
            
            }
        }
        $_SESSION["temp"] = 1;

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>	
        <section class="header-sec" id="home">
            <div class="overlay">
                <div class="container">
                    <div class="row text-center">

                        <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">

                            <h2 data-scroll-reveal="enter from the bottom after 0.1s">
                                <strong style="font-size: 1.5em;">
                                    WELCOME &nbsp;&nbsp;&nbsp;<?php echo $_SESSION["name"]; ?>
                                </strong>
                            </h2>
                            <br>
                        </div>

                    </div>
                </div>
            </div>

        </section>
        <form method="post"action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div>
                <h1 style="margin-top: 50px;float: left; font-size: 2.5em; margin-left: 50px;">Q1</h1>
                <input type="text" disabled style="font-size: 2.5em; margin-left: 50px; margin-top: 50px; width: 1100px;" value="<?php echo $value[0]["question"]; ?>"><b></b></input>
                </br></br><input style="margin-left: 200px; " type="radio" name="option1" value='A'>  <?php echo $value[0]["option1"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option1" value='B'>  <?php echo $value[0]["option2"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option1" value='C'>  <?php echo $value[0]["option3"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option1" value='D'>  <?php echo $value[0]["option4"]; ?></input>
            </div>
            <div>
                <h1 style="margin-top: 100px;float: left; font-size: 2.5em; margin-left: 50px;">Q2</h1>
                <input type="text" disabled style="font-size: 2.5em; margin-left: 50px; margin-top: 100px; width: 1100px;" value="<?php echo $value[1]["question"]; ?>"><b></b></input>
                </br></br><input style="margin-left: 200px; " type="radio" name="option2"  value='A'>  <?php echo $value[1]["option1"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option2"  value='B'>  <?php echo $value[1]["option2"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option2"  value = 'C'>  <?php echo $value[1]["option3"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option2" value = 'D'>  <?php echo $value[1]["option4"]; ?></input>
            </div>

            <div>
                <h1 style="margin-top: 50px;float: left; font-size: 2.5em; margin-left: 50px;">Q3</h1>
                <input type="text" disabled style="font-size: 2.5em; margin-left: 50px; margin-top: 50px; width: 1100px;" value="<?php echo $value[2]["question"]; ?>"><b></b></input>
                </br></br><input style="margin-left: 200px; " type="radio" name="option3" value='A' >  <?php echo $value[2]["option1"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option3" value='B'>  <?php echo $value[2]["option2"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option3" value='C'>  <?php echo $value[2]["option3"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option3" value='D'>  <?php echo $value[2]["option4"]; ?></input>
            </div>

            <div>
                <h1 style="margin-top: 50px;float: left; font-size: 2.5em; margin-left: 50px;" >Q4</h1>
                <input type="text" disabled style="font-size: 2.5em; margin-left: 50px; margin-top: 50px; width: 1100px;" value="<?php echo $value[3]["question"]; ?>"><b></b></input>
                </br></br><input style="margin-left: 200px; " type="radio" name="option4" value='A' >  <?php echo $value[3]["option1"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option4" value='B'>  <?php echo $value[3]["option2"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option4" value='C'>  <?php echo $value[3]["option3"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option4" value='D'>  <?php echo $value[3]["option4"]; ?></input>
            </div>

            <div>
                <h1 style="margin-top: 50px;float: left; font-size: 2.5em; margin-left: 50px;" >Q5</h1>
                <input type="text" disabled style="font-size: 2.5em; margin-left: 50px; margin-top: 50px; width: 1100px;" value="<?php echo $value[4]["question"]; ?>"><b></b></input>
                </br></br><input style="margin-left: 200px; " type="radio" name="option5" value='A' >  <?php echo $value[4]["option1"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option5" value='B'>  <?php echo $value[4]["option2"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option5" value='C'>  <?php echo $value[4]["option3"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option5" value='D'>  <?php echo $value[4]["option4"]; ?></input>
            </div>

            <div>
                <h1 style="margin-top:50px;float: left; font-size: 2.5em; margin-left: 50px;" >Q6</h1>
                <input type="text" disabled style="font-size: 2.5em; margin-left: 50px; margin-top: 50px; width: 1100px;" value="<?php echo $value[5]["question"]; ?>"><b></b></input>
                </br></br><input style="margin-left: 200px; " type="radio" name="option6" value='A'>  <?php echo $value[5]["option1"]; ?></input>
                </br> <input style="margin-left: 200px; " type="radio" name="option6" value='B'>  <?php echo $value[5]["option2"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option6" value='C'>  <?php echo $value[5]["option3"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option6" value='D'>  <?php echo $value[5]["option4"]; ?></input>
            </div>

            <div>
                <h1 style="margin-top: 50px;float: left; font-size: 2.5em; margin-left: 50px;" >Q7</h1>
                <input type="text" disabled style="font-size: 2.5em; margin-left: 50px; margin-top: 50px; width: 1100px;" value="<?php echo $value[6]["question"]; ?>"><b></b></input>
                </br></br><input style="margin-left: 200px; " type="radio" name="option7" value='A'>  <?php echo $value[6]["option1"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option7" value='B'>  <?php echo $value[6]["option2"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option7" value='C'>  <?php echo $value[6]["option3"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option7" value='D'>  <?php echo $value[6]["option4"]; ?></input>
            </div>

            <div>
                <h1 style="margin-top: 50px;float: left; font-size: 2.5em; margin-left: 50px;">Q8</h1>
                <input type="text" disabled style="font-size: 2.5em; margin-left: 50px; margin-top:50px; width: 1100px;" value="<?php echo $value[7]["question"]; ?>"><b></b></input>
                </br></br><input style="margin-left: 200px; " type="radio" name="option8" value='A'>  <?php echo $value[7]["option1"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option8" value='B'>  <?php echo $value[7]["option2"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option8" value='C'>  <?php echo $value[7]["option3"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option8" value='D'>  <?php echo $value[7]["option4"]; ?></input>
            </div>

            <div>
                <h1 style="margin-top: 50px;float: left; font-size: 2.5em; margin-left: 50px;">Q9</h1>
                <input type="text" disabled style="font-size: 2.5em; margin-left: 50px; margin-top: 50px; width: 1100px;" value="<?php echo $value[8]["question"]; ?>"><b></b></input>
                </br></br><input style="margin-left: 200px; " type="radio" name="option9" value='A'>  <?php echo $value[8]["option1"]; ?></input>
                </br> <input style="margin-left: 200px; " type="radio" name="option9" value='B'>  <?php echo $value[8]["option2"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option9" value='C'>  <?php echo $value[8]["option3"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option9" value='D'>  <?php echo $value[8]["option4"]; ?></input>
            </div>

            <div>
                <h1 style="margin-top: 50px;float: left; font-size: 2.5em; margin-left: 50px;">Q10</h1>
                <input type="text" disabled style="font-size: 2.5em; margin-left: 50px; margin-top: 50px; width: 1100px;" value="<?php echo $value[9]["question"]; ?>"><b></b></input>
                </br></br><input style="margin-left: 200px; " type="radio" name="option10" value='A'>  <?php echo $value[9]["option1"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option10" value='B'>  <?php echo $value[9]["option2"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option10" value='C'>  <?php echo $value[9]["option3"]; ?></input>
                </br><input style="margin-left: 200px; " type="radio" name="option10" value='D'>  <?php echo $value[9]["option4"]; ?></input>
            </div>
            </br></br>
            <input type="submit" value="SUBMIT" style="margin-left: 600px; "/>
        </form>
        <div class="myfooter">
            © 2014 yourdomain.com | by: <a href="http://binarytheme.com" style="color:#fff;" target="_blank">www.binarytheme.com</a>

        </div>
  

    </body>
</html>
