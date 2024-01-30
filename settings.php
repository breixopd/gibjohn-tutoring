<?php
    // Start session to be able to pull data from other scripts and tabs
    session_start(); 

    // If the session email is not set, redirects user to main page
    if (!isset($_SESSION['email'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    // If the logout button is pressed, destroy active session removing all session values and cookies and redirect to login page
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['email']);
        header("location: login.php");
    }
?>

<!DOCTYPE html>
<html>

<head>

    <!-- Import all style sheets, fonts and other assets needed to run site as well as set the site width to be the width of the screen content is displayed on -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- Set the title for the page -->
    <title>Settings - GibJohn</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bebas+Neue&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body id="page-top" style="font-family: 'Open Sans', sans-serif;">
    <div id="wrapper">

        <!-- Make navigation br so use can move around the site -->
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="font-family: 'Open Sans', sans-serif;">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="dashboard.html">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-graduation-cap"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>GibJohn</span></div>
                </a>
                <hr class="sidebar-divider my-0">

                <!-- Set all the items to be displyed in the navigation bar (links to pages and other functions) -->
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="dashboard.html"><i class="fa fa-inbox"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="activities.html"><i class="fa fa-folder-open"></i><span>Activities</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="subjects.html"><i class="fa fa-paperclip"></i><span>Subjects</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="knowledgebase.html"><i class="fa fa-book"></i><span>Knowledgebase</span></a></li>
                </ul>

                <!-- Button to toggle sidebar -->
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <!-- Navbar is linked accross every page so it always looks the same -->

        <div class="d-flex flex-column" id="content-wrapper" style="font-family: 'Open Sans', sans-serif;">
            <div id="content">

                <!-- Other navigation bar to display user name, profile picture and give access to settings and log out -->
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown no-arrow">

                                <!-- User name grabbed and processed by server.php file to generate profile picture and display name so user knows it is their dashboard and to make it more personalised -->
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown"><span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $_SESSION['name']; ?></span><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar3.jpeg">
                                    </a>

                                    <!-- Allows user to enter settings or sign out when clicked -->
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="settings.html"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="settings.php?logout='1'"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <!--Navbar is linked accross every page so it always looks the same-->
                    </div>
                </nav>

                <!-- Shows all the options for the user, none of these have been implemented yet for the purpose of this prototype -->
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Profile</h3>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="card shadow-none mb-3" style="border: none !important;">
                                <div class="card-body text-center shadow-none" style="border-style: none;"><img class="rounded-circle mb-3 mt-4" src="assets/img/dogs/rsz_image2.jpg" width="160" height="160">
                                    <div class="mb-3"><button class="btn btn-primary btn-sm" type="button">Change Photo</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="card shadow-none" style="border: none !important;">
                                                <div class="card-header py-3" style="padding: 16px;">
                                                    <p class="text-primary m-0 fw-bold">Change Email</p>
                                                </div>
                                                <div class="card-body">
                                                    <form>
                                                        <div class="mb-3"><label class="form-label" for="address"><strong>New email</strong></label><input class="form-control" type="email" id="emailinput" name="email" placeholder="email@mail.com"><label class="form-label" for="address"><strong>Password</strong></label><input class="form-control" type="password" id="passwordinput" name="password" placeholder="••••••••"></div>
                                                        <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit" style="width: 100%;">Save&nbsp;Settings</button></div>
                                                    </form>
                                                </div>
                                            </div>
                                            <hr style="background: rgb(0,0,0);">
                                            <div class="card shadow-none" style="border: none !important;">
                                                <div class="card-header py-3" style="padding: 16px;">
                                                    <p class="text-primary m-0 fw-bold">Change Password</p>
                                                </div>
                                                <div class="card-body">
                                                    <form>
                                                        <div class="mb-3"><label class="form-label" for="address"><strong>Current password</strong></label><input class="form-control" type="password" id="newpasscurrent-2" name="password" placeholder="••••••••"><label class="form-label" for="address"><strong>New password</strong></label><input class="form-control" type="password" id="newpasswordinput-3" name="password" placeholder="••••••••"><label class="form-label" for="address"><strong>Confirm new password</strong></label><input class="form-control" type="password" id="newpasswordinput-4" name="password" placeholder="••••••••"></div>
                                                        <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit" style="width: 100%;">Save&nbsp;Settings</button></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card shadow-none" style="border: none !important;">
                                                <div class="card-header py-3">
                                                    <p class="text-primary m-0 fw-bold">Delete Account</p>
                                                </div>
                                                <div class="card-body">
                                                    <form>
                                                        <div class="mb-3"><label class="form-label" for="address"><strong>Email</strong></label><input class="form-control" type="email" id="emailinput-1" name="email" placeholder="email@mail.com"><label class="form-label" for="address"><strong>Password</strong></label><input class="form-control" type="password" id="passwordinput-1" name="password" placeholder="••••••••"><label class="form-label" for="address"><strong>Please type "DELETE" to confirm</strong></label><input class="form-control" type="text" name="confirm" placeholder="DELETE">
                                                            <p style="font-size: 10px;">Once an account has been deleted it cannot be recovered, you will<br>no longer be able to access your information on this service, to use this<br>service in the future you will need to make a brand new account and start over.<br></p>
                                                        </div>
                                                        <div class="mb-3"><button class="btn btn-danger btn-sm" type="submit" style="width: 100%;">Delete Account</button></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer" style="font-family: 'Open Sans', sans-serif;">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © GibJohn 2022 | <a href="privacy-policy.html">Privacy Policy</a> | <a href="code-of-conduct.html">Code of Conduct</a>&nbsp;| 07000000000 |&nbsp;<a href="mailto:support@email.com"><span style="text-decoration: underline;">support@email.com</span></a><br></span></div>
                </div>
                <!--Footer is linked accross every page so it always looks the same-->
            </footer>
        </div>
    </div>

    <!-- Any other scripts needed for the site are loaded here -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>