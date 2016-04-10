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
        
        <section class="header-sec" id="home">
            <div class="overlay">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                            <h2 data-scroll-reveal="enter from the bottom after 0.1s">
                                <strong style="font-size: 1.5em;">
                                    HELLO <?php echo $_SESSION["name"]; ?></br></br>
                                    YOUR RESULT IS -  &nbsp;&nbsp;&nbsp;<?php echo $_SESSION["result"]; ?></br></br></br>
                                </strong>
                                <a href = "logout.php"><input style="background-color: transparent ;color: white;font-size: 1.2em;" type="button" value="LOGOUT"></href></a>
                            </h2>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="myfooter">
            © mymcqtest | by: <a href="#" style="color:#fff;" target="_blank">www.binarytheme.com</a>
        </div>
    

    </body>
</html>
