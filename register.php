<?php 
    // Import server.php file to process register requests
    include('server.php') 
?>

<!DOCTYPE html>
<html>
<head>

    <!-- Import all style sheets, fonts and other assets needed to run site as well as set the site width to be the width of the screen content is displayed on -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- Set the title for the page -->
    <title>Register - GibJohn</title>
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
<body class="d-xxl-flex bg-gradient-primary" style="overflow: hidden;background: linear-gradient(-45deg, #0019ff, #00f0ff, #23a6d5);background-size: 400% 400%;animation: gradient 30s ease infinite;">
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

                                        <!-- Set hyperlink to login page so user can quickly log in if needed -->
                                        <h4 class="text-dark d-xxl-flex mb-4" style="color: rgba(62,62,68,0.79) !important;font-family: 'Open Sans', sans-serif;">Sign Up |&nbsp;<a href="login.php">Log In</a></h4>
                                    </div>
                                </div>
                            </div>

                            <!-- Form to collect registration details to register in user, all fields are validated with RegEX to make sure user inputs correct data where needed -->
                            <form class="user" method="POST" action="register.php">

                                <!-- Import errors.php file to process and display errors to user -->
                                <?php include('errors.php'); ?>
                                <div class="mb-3">
                                    <input class="form-control form-control-user" type="text" id="inputName" placeholder="Name" name="name" style="font-family: 'Open Sans', sans-serif;" autofocus="" minlength="3" maxlength="45" pattern="^[a-zA-Z\-\s]*$" oninvalid="this.setCustomValidity('Name can only have uppercase and lowercase letters as well as spaces and hyphons!')">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control form-control-user" type="email" id="InputEmail" aria-describedby="emailHelp" placeholder="Email Address" name="email" style="font-family: 'Open Sans', sans-serif;" required="" minlength="6" maxlength="45"></div>
                                <div class="row mb-3">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input class="form-control form-control-user" type="password" id="examplePasswordInput" placeholder="Password" name="password" style="font-family: 'Open Sans', sans-serif;" required="" pattern="^(?=.*\d)(?=.*[a-zA-Z]).{8,}$" oninvalid="this.setCustomValidity('Password needs to be 8-45 characters long with 1 number!')">
                                    </div>
                                    <div class="col-sm-6">
                                        <input class="form-control form-control-user" type="password" id="password_repeat" placeholder="Repeat Password" name="password_repeat" style="font-family: 'Open Sans', sans-serif;" required="">
                                    </div>
                                </div>
                                <div class="form-check">

                                    <!-- Check box user needs to tick in order to state they have read the TOS and privacy policy -->
                                    <input class="form-check-input" type="checkbox" id="formCheck-1" required="" name="tos_agree">
                                    <label class="form-check-label" for="formCheck-1" style="font-family: 'Open Sans', sans-serif;font-size: 12px;">By signing up you agree to our&nbsp;<a href="tos.html">Terms of Service</a>&nbsp;and our&nbsp;<a href="privacy.html">Privacy Policy</a>
                                        <br>
                                    </label>
                                </div>
                                <button class="btn btn-primary d-block btn-user" type="submit" name="reg_user" style="font-family: 'Open Sans', sans-serif;width: 100%;border-radius: 0.25rem !important;border-style: none;">Sign Up</button>
                                <div class="mb-3" style="margin-top: 3%;">
                                    <input class="form-control form-control-user" type="text" id="InputCode" aria-describedby="codeHelp" placeholder="Teacher Code (AABBCC1)" name="code" style="font-family: 'Open Sans', sans-serif;" minlength="7" maxlength="7" pattern="[a-zA-Z]+[0-9]+">
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