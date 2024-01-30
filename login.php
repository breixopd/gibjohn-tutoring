<?php 
    // Import server.php file to process login requests
    include('server.php') 
?>

<!DOCTYPE html>
<html>

<head>

    <!-- Import all style sheets, fonts and other assets needed to run site as well as set the site width to be the width of the screen content is displayed on -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- Set the title for the page -->
    <title>Log In - GibJohn</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bebas+Neue&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<!-- Set animated gradient as background to look good -->
<body class="d-xxl-flex bg-gradient-primary" style="overflow: hidden;background: linear-gradient(-45deg, #0019ff, #00f0ff, #23a6d5);background-size: 400% 400%;animation: gradient 15s ease infinite;">
    <div class="container d-xxl-flex">
        <div class="card shadow-lg o-hidden border-0 my-5" style="width: 100%;height: 100%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important;">
            <div class="card-body p-0" style="height: 100%;">
                <div class="row" style="width: 100%;height: 100%;">
                    <div class="col-lg-5 d-none d-lg-flex">

                        <!-- Get a random dog image from an API every time page loads to cheer up users -->
                        <div class="flex-grow-1 bg-register-image" style="background-image: url(&quot;https://place.dog/1000/1500&quot;);"></div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <div class="row">
                                    <div class="col d-xxl-flex justify-content-xxl-center">

                                        <!-- Set hyperlink to register page so user can quickly register in if needed -->
                                        <h4 class="text-dark mb-4" style="color: rgba(62,62,68,0.79) !important;font-family: 'Open Sans', sans-serif;"><a href="register.php">Sign Up</a> | Log In</h4>
                                    </div>
                                </div>
                            </div>

                            <!-- Form to collect login details to log in user -->
                            <form class="user" method="post" action="login.php">

                                <!-- Import errors.php file to process and display errors to user -->
                                <?php include('errors.php'); ?>
                                <div class="mb-3"><input class="form-control form-control-user" type="email" id="InputEmail" aria-describedby="emailHelp" placeholder="Email Address" name="email" style="font-family: 'Open Sans', sans-serif;" required="" minlength="6" maxlength="45"></div>
                                <div class="mb-3"><input class="form-control form-control-user" type="password" id="examplePasswordInput" placeholder="Password" name="password" style="font-family: 'Open Sans', sans-serif;" required=""></div>
                                <div class="btn-group border rounded-pill" role="group" style="width: 100%;height: 45.1875px;"><button class="btn btn-primary d-block d-xxl-flex justify-content-xxl-center align-items-xxl-center btn-user" type="submit" style="font-family: 'Open Sans', sans-serif;width: 150%;font-size: 12.8px;border-style: none;" name="log_user">Log In</button>

                                    <!-- Forgot password button runs a separate function in server.php to send user email in case they forgot password -->
                                    <button class="btn btn-secondary d-block d-xxl-flex justify-content-xxl-center align-items-xxl-center btn-user" type="submit" name="forg_pass" style="font-family: 'Open Sans', sans-serif;background: rgb(210,76,76);width: 100%;margin-left: 0px;font-size: 12.8px;border-style: none;">Forgot Password?</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Any other scripts needed for the site are loaded here -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>