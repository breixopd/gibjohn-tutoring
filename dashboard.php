<?php 
    
    // Import stats file to process all the stats and scores
    include('stats.php');

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

    // If there is a teacher code set redirects user to teacher dashboard
    if (!is_null($_SESSION['code'])) {
        header("location: teach_db.php");
    }
?>

<!DOCTYPE html>
<html>

<head>

    <!-- Import all style sheets, fonts and other assets needed to run site as well as set the site width to be the width of the screen content is displayed on -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- Set the title for the page -->
    <title>Dashboard - GibJohn</title>
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

        <!-- Make navigation bar so users can move around the site -->
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="font-family: 'Open Sans', sans-serif;">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="dashboard.php">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-graduation-cap"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>GibJohn</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">

                    <!-- Set all the items to be displyed in the navigation bar (links to pages and other functions) -->
                    <li class="nav-item"><a class="nav-link active" href="dashboard.php"><i class="fa fa-inbox"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="activities.php"><i class="fa fa-folder-open"></i><span>Activities</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="subjects.php"><i class="fa fa-paperclip"></i><span>Subjects</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="knowledgebase.php"><i class="fa fa-book"></i><span>Knowledgebase</span></a></li>
                </ul>

                <!-- Button to toggle sidebar -->
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper" style="font-family: 'Open Sans', sans-serif;">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown no-arrow">

                                <!-- User name grabbed and processed by server.php file to generate profile picture and display name so user knows it is their dashboard and to make it more personalised -->
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown"><span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo filter_var($_SESSION['name'], FILTER_SANITIZE_STRING); ?></span><img class="border rounded-circle img-profile" src="https://robohash.org/<?php echo filter_var($_SESSION['name'], FILTER_SANITIZE_STRING); ?>">
                                    </a>

                                    <!-- Allows user to enter settings or sign out when clicked -->
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="settings.php"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="dashboard.php?logout='1'"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- Navbar is linked accross every page so it always looks the same -->

                <div class="container-fluid">
                    <p style="margin-bottom: 5px;color: rgb(0,0,0);font-size: 18px;"><strong>To do:</strong></p>
                    <!--"To do" section will be automatically made of tasks the user hasnt done but are available, this will be done by getting the completed tasks by the user and compared against the activities available -->
                    <div class="row" style="width: 100%;">
                        <div class="col" style="margin-bottom: 20px;"><a href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body"><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/104/300/200.jpg?hmac=W7FcJLpY_QWuoWs8MS3CTSWd_fiE9bsAGM9FQRK373U">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body"><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/466/300/200.jpg?hmac=ynZ9L9zmxdc_vQ-UM_FDRX4tUF-5Ogg8apdMbX1_8sU">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body"><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/844/300/200.jpg?hmac=nScDnrvjcq1VjYNAh6OKIR_tQdDSITIWW578WbADLgc">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body"><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/703/300/200.jpg?hmac=jdCUHJtpFBAuDGLUfIqBkFFLY7_TtkSYfMDN_ml2Fpo">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body"><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/560/300/200.jpg?hmac=z0gPXG_basgSW3XdseUDpCXZZQubCdFuqcqyli43QhY">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body"><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/680/300/200.jpg?hmac=zPw9u1Uc5w_uI_iC01hxZpvHLNgMioBafTU5Cab8f28">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body"><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/521/300/200.jpg?hmac=7afxWeC46WTzLykjvp38m6TXkqbJLvK8Hl_xYFYH7Hc">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                    </div>
                    <p style="margin-bottom: 5px;color: rgb(0,0,0);font-size: 18px;"><strong>Completed:</strong></p>
                    <!--"Completed" section will be made by getting all the activities the user has done from the database and displaying them-->
                    <div class="row" style="width: 100%;">
                        <div class="col" style="margin-bottom: 20px;"><a href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/103/300/200.jpg?hmac=dUtthaBv_rM-z3sY5gWcELrBMKq05_UxucDQN3ng444">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/776/300/200.jpg?hmac=6g5n1tXwsLmWNSCchQ5Gy0j2UAAYkj5jdBebXaxYr84">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body"><i class="fa fa-remove" style="transform: translateX(20%) translateY(35%);color: rgb(255,15,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/780/300/200.jpg?hmac=qdomdN6fLXXaqFaTPUFovUhzlpfYKS_MjUthi5dCWWw">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject name - (86% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/823/300/200.jpg?hmac=l_jdJLoJQeErmRXETXjqQt0DHWa8Wt14UteSSnnDgTI">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/842/300/200.jpg?hmac=5yb9XWe2hjQEfdjL3CuTO1rDtQX_71rphRl3PjQZm14">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/402/300/200.jpg?hmac=VW9a1Qd0oG_sb8K6HTz_VkysOHUvd75vrcg-Ko38AQ4">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/588/300/200.jpg?hmac=dAr3GdGi6T9EqDodwOpFe4pLVi1bk5Zhl1ZoHsepMOE">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;padding-top: 1px;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                    </div>
                    <p style="margin-bottom: 5px;color: rgb(0,0,0);font-size: 18px;"><strong>Stats:</strong></p>
                    <!--Stats will be actively pulled from the database and calculated,
- "Average %" will be calculated by obtaining all the scores of every activity done by the user and dividing by how many activities have been done
- "Activities completed" will be calculating by adding all the activities the user has completed from the database
- "Most studied topic" will be calculating how many activities have been done for each topic, in the future it could also check if the names of other topics match and then make it into 1 category (e.g. "Maths: Algebra" and "Maths: Quadratic equations" both have "Maths" and could be combined into the "Maths" topic)
- "Time spent on site" will be calculated using google analytics or special libraries like TimeMe.js (https://github.com/jasonzissman/TimeMe.js/), this will be added to a field in a database where it is then displayed in the stats-->
                    <div class="row" style="margin-bottom: 20px;">

                        <!-- Gets number of activities completed from session variable set by stats.php file -->
                        <div class="col-md-3" style="border-right-width: 1px;border-right-style: solid;height: 100%;">
                            <p style="color: rgb(0,0,0);margin-bottom: 0px;">Activities completed:</p>
                            <p style="color: rgb(0,0,0);"><strong><?php  echo $_SESSION['activities']?></strong></p>
                        </div>

                        <!-- This stat has not been implemented as this is only a prototype -->
                        <div class="col-md-3" style="border-right-width: 1px;border-right-style: solid;height: 100%;">
                            <p style="color: rgb(0,0,0);margin-bottom: 0px;">Average %:</p>
                            <p style="color: rgb(0,0,0);"><strong>95%</strong></p>
                        </div>

                        <!-- This stat has not been implemented as this is only a prototype -->
                        <div class="col-md-3" style="border-right-width: 1px;border-right-style: solid;height: 100%;">
                            <p style="color: rgb(0,0,0);margin-bottom: 0px;">Most studied topic:</p>
                            <p style="color: rgb(0,0,0);"><strong>Maths</strong></p>
                        </div>

                        <!-- This stat has not been implemented as this is only a prototype -->
                        <div class="col-md-3" style="height: 100%;">
                            <p style="color: rgb(0,0,0);margin-bottom: 0px;">Time spent on site:</p>
                            <p style="color: rgb(0,0,0);"><strong>1d 10h 7m</strong></p>
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