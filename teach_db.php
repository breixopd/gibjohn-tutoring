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

    // If a teacher code is not set redirect user to student dashboard
    if (is_null($_SESSION['code'])) {
        header("location: dashboard.php");
    }
?>

<!DOCTYPE html>
<html>

<head>

    <!-- Import all style sheets, fonts and other assets needed to run site as well as set the site width to be the width of the screen content is displayed on -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- Set the title for the page -->
    <title>Teacher Dashboard - GibJohn</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bebas+Neue&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body id="page-top">
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
                    <li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="fa fa-inbox"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="activities.php"><i class="fa fa-folder-open"></i><span>Activities</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="subjects.php"><i class="fa fa-paperclip"></i><span>Subjects</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="knowledgebase.php"><i class="fa fa-book"></i><span>Knowledgebase</span></a></li>
                </ul>

                <!-- Button to toggle sidebar -->
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>

        <!-- Pop up modal for management of students and classes (a modal is a pop up with content inside of it) -->
        <div class="modal fade" role="dialog" tabindex="-1" id="modal-1">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Management</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Student section of modal -->
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <p style="width: 100%;font-family: 'Open Sans', sans-serif;color: rgb(0,0,0);font-weight: bold;">Students:</p>
                                    </div>
                                    <div class="col"><input type="search" style="width: 100%;font-family: 'Open Sans', sans-serif;" placeholder="Search" name="stu_search" autofocus=""></div>
                                </div>
                                <div class="row" id="student" style="margin-bottom: 12px;">
                                    <div class="col-auto" style="width: auto;height: 45px;padding-right: 0px;"><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg" style="width: 45px;"></div>
                                    <div class="col-auto" style="height: 45px;padding-left: 0px;width: auto;margin-left: 12px;">
                                        <p style="text-align: left;width: 169.5px;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Name - Class</p>
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Score %</p>
                                    </div>
                                    <div class="col-auto offset-2" style="height: 45px;width: auto;padding-right: 0px;">
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;height: 45px;margin-left: 14px;margin-right: 12px;"><a href="#">Remove&nbsp;from class</a>&nbsp;|&nbsp;<a href="#"><span style="text-decoration: underline;">Reset</span></a><br><br><br></p>
                                    </div>
                                </div>
                                <div class="row" id="student-1" style="margin-bottom: 12px;">
                                    <div class="col-auto" style="width: auto;height: 45px;padding-right: 0px;"><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg" style="width: 45px;"></div>
                                    <div class="col-auto" style="height: 45px;padding-left: 0px;width: auto;margin-left: 12px;">
                                        <p style="text-align: left;width: 169.5px;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Name - Class</p>
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Score %</p>
                                    </div>
                                    <div class="col-auto offset-2" style="height: 45px;width: auto;padding-right: 0px;">
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;height: 45px;margin-left: 14px;margin-right: 12px;"><a href="#">Remove&nbsp;from class</a>&nbsp;|&nbsp;<a href="#"><span style="text-decoration: underline;">Reset</span></a><br><br><br></p>
                                    </div>
                                </div>
                                <div class="row" id="student-2" style="margin-bottom: 12px;">
                                    <div class="col-auto" style="width: auto;height: 45px;padding-right: 0px;"><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg" style="width: 45px;"></div>
                                    <div class="col-auto" style="height: 45px;padding-left: 0px;width: auto;margin-left: 12px;">
                                        <p style="text-align: left;width: 169.5px;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Name - Class</p>
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Score %</p>
                                    </div>
                                    <div class="col-auto offset-2" style="height: 45px;width: auto;padding-right: 0px;">
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;height: 45px;margin-left: 14px;margin-right: 12px;"><a href="#">Remove&nbsp;from class</a>&nbsp;|&nbsp;<a href="#"><span style="text-decoration: underline;">Reset</span></a><br><br><br></p>
                                    </div>
                                </div>
                                <div class="row" id="student-3" style="margin-bottom: 12px;">
                                    <div class="col-auto" style="width: auto;height: 45px;padding-right: 0px;"><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg" style="width: 45px;"></div>
                                    <div class="col-auto" style="height: 45px;padding-left: 0px;width: auto;margin-left: 12px;">
                                        <p style="text-align: left;width: 169.5px;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Name - Class</p>
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Score %</p>
                                    </div>
                                    <div class="col-auto offset-2" style="height: 45px;width: auto;padding-right: 0px;">
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;height: 45px;margin-left: 14px;margin-right: 12px;"><a href="#">Remove&nbsp;from class</a>&nbsp;|&nbsp;<a href="#"><span style="text-decoration: underline;">Reset</span></a><br><br><br></p>
                                    </div>
                                </div>
                                <div class="row" id="student-4" style="margin-bottom: 12px;">
                                    <div class="col-auto" style="width: auto;height: 45px;padding-right: 0px;"><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg" style="width: 45px;"></div>
                                    <div class="col-auto" style="height: 45px;padding-left: 0px;width: auto;margin-left: 12px;">
                                        <p style="text-align: left;width: 169.5px;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Name - Class</p>
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Score %</p>
                                    </div>
                                    <div class="col-auto offset-2" style="height: 45px;width: auto;padding-right: 0px;">
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;height: 45px;margin-left: 14px;margin-right: 12px;"><a href="#">Remove&nbsp;from class</a>&nbsp;|&nbsp;<a href="#"><span style="text-decoration: underline;">Reset</span></a><br><br><br></p>
                                    </div>
                                </div>
                                <div class="row" id="student-5" style="margin-bottom: 12px;">
                                    <div class="col-auto" style="width: auto;height: 45px;padding-right: 0px;"><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg" style="width: 45px;"></div>
                                    <div class="col-auto" style="height: 45px;padding-left: 0px;width: auto;margin-left: 12px;">
                                        <p style="text-align: left;width: 169.5px;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Name - Class</p>
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Score %</p>
                                    </div>
                                    <div class="col-auto offset-2" style="height: 45px;width: auto;padding-right: 0px;">
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;height: 45px;margin-left: 14px;margin-right: 12px;"><a href="#">Remove&nbsp;from class</a>&nbsp;|&nbsp;<a href="#"><span style="text-decoration: underline;">Reset</span></a><br><br><br></p>
                                    </div>
                                </div>
                                <div class="row" id="student-6" style="margin-bottom: 12px;">
                                    <div class="col-auto" style="width: auto;height: 45px;padding-right: 0px;"><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg" style="width: 45px;"></div>
                                    <div class="col-auto" style="height: 45px;padding-left: 0px;width: auto;margin-left: 12px;">
                                        <p style="text-align: left;width: 169.5px;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Name - Class</p>
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Score %</p>
                                    </div>
                                    <div class="col-auto offset-2" style="height: 45px;width: auto;padding-right: 0px;">
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;height: 45px;margin-left: 14px;margin-right: 12px;"><a href="#">Remove&nbsp;from class</a>&nbsp;|&nbsp;<a href="#"><span style="text-decoration: underline;">Reset</span></a><br><br><br></p>
                                    </div>
                                </div>
                                <div class="row" id="student-7" style="margin-bottom: 12px;">
                                    <div class="col-auto" style="width: auto;height: 45px;padding-right: 0px;"><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg" style="width: 45px;"></div>
                                    <div class="col-auto" style="height: 45px;padding-left: 0px;width: auto;margin-left: 12px;">
                                        <p style="text-align: left;width: 169.5px;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Name - Class</p>
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Score %</p>
                                    </div>
                                    <div class="col-auto offset-2" style="height: 45px;width: auto;padding-right: 0px;">
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;height: 45px;margin-left: 14px;margin-right: 12px;"><a href="#">Remove&nbsp;from class</a>&nbsp;|&nbsp;<a href="#"><span style="text-decoration: underline;">Reset</span></a><br><br><br></p>
                                    </div>
                                </div>
                                <div class="row" id="student-8" style="margin-bottom: 12px;">
                                    <div class="col-auto" style="width: auto;height: 45px;padding-right: 0px;"><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg" style="width: 45px;"></div>
                                    <div class="col-auto" style="height: 45px;padding-left: 0px;width: auto;margin-left: 12px;">
                                        <p style="text-align: left;width: 169.5px;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Name - Class</p>
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Score %</p>
                                    </div>
                                    <div class="col-auto offset-2" style="height: 45px;width: auto;padding-right: 0px;">
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;height: 45px;margin-left: 14px;margin-right: 12px;"><a href="#">Remove&nbsp;from class</a>&nbsp;|&nbsp;<a href="#"><span style="text-decoration: underline;">Reset</span></a><br><br><br></p>
                                    </div>
                                </div>
                                <div class="row" id="student-9" style="margin-bottom: 12px;">
                                    <div class="col-auto" style="width: auto;height: 45px;padding-right: 0px;"><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg" style="width: 45px;"></div>
                                    <div class="col-auto" style="height: 45px;padding-left: 0px;width: auto;margin-left: 12px;">
                                        <p style="text-align: left;width: 169.5px;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Name - Class</p>
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Score %</p>
                                    </div>
                                    <div class="col-auto offset-2" style="height: 45px;width: auto;padding-right: 0px;">
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;height: 45px;margin-left: 14px;margin-right: 12px;"><a href="#">Remove&nbsp;from class</a>&nbsp;|&nbsp;<a href="#"><span style="text-decoration: underline;">Reset</span></a><br><br><br></p>
                                    </div>
                                </div>
                                <div class="row" id="student-10" style="margin-bottom: 12px;">
                                    <div class="col-auto" style="width: auto;height: 45px;padding-right: 0px;"><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg" style="width: 45px;"></div>
                                    <div class="col-auto" style="height: 45px;padding-left: 0px;width: auto;margin-left: 12px;">
                                        <p style="text-align: left;width: 169.5px;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Name - Class</p>
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Score %</p>
                                    </div>
                                    <div class="col-auto offset-2" style="height: 45px;width: auto;padding-right: 0px;">
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;height: 45px;margin-left: 14px;margin-right: 12px;"><a href="#">Remove&nbsp;from class</a>&nbsp;|&nbsp;<a href="#"><span style="text-decoration: underline;">Reset</span></a><br><br><br></p>
                                    </div>
                                </div>
                                <div class="row" id="student-11" style="margin-bottom: 12px;">
                                    <div class="col-auto" style="width: auto;height: 45px;padding-right: 0px;"><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg" style="width: 45px;"></div>
                                    <div class="col-auto" style="height: 45px;padding-left: 0px;width: auto;margin-left: 12px;">
                                        <p style="text-align: left;width: 169.5px;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Name - Class</p>
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Score %</p>
                                    </div>
                                    <div class="col-auto offset-2" style="height: 45px;width: auto;padding-right: 0px;">
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;height: 45px;margin-left: 14px;margin-right: 12px;"><a href="#">Remove&nbsp;from class</a>&nbsp;|&nbsp;<a href="#"><span style="text-decoration: underline;">Reset</span></a><br><br><br></p>
                                    </div>
                                </div>
                                <div class="row" id="student-12" style="margin-bottom: 12px;">
                                    <div class="col-auto" style="width: auto;height: 45px;padding-right: 0px;"><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg" style="width: 45px;"></div>
                                    <div class="col-auto" style="height: 45px;padding-left: 0px;width: auto;margin-left: 12px;">
                                        <p style="text-align: left;width: 169.5px;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Name - Class</p>
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Score %</p>
                                    </div>
                                    <div class="col-auto offset-2" style="height: 45px;width: auto;padding-right: 0px;">
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;height: 45px;margin-left: 14px;margin-right: 12px;"><a href="#">Remove&nbsp;from class</a>&nbsp;|&nbsp;<a href="#"><span style="text-decoration: underline;">Reset</span></a><br><br><br></p>
                                    </div>
                                </div>
                                <div class="row" id="student-13" style="margin-bottom: 12px;">
                                    <div class="col-auto" style="width: auto;height: 45px;padding-right: 0px;"><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg" style="width: 45px;"></div>
                                    <div class="col-auto" style="height: 45px;padding-left: 0px;width: auto;margin-left: 12px;">
                                        <p style="text-align: left;width: 169.5px;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Name - Class</p>
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Score %</p>
                                    </div>
                                    <div class="col-auto offset-2" style="height: 45px;width: auto;padding-right: 0px;">
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;height: 45px;margin-left: 14px;margin-right: 12px;"><a href="#">Remove&nbsp;from class</a>&nbsp;|&nbsp;<a href="#"><span style="text-decoration: underline;">Reset</span></a><br><br><br></p>
                                    </div>
                                </div>
                                <div class="row" id="student-14" style="margin-bottom: 12px;">
                                    <div class="col-auto" style="width: auto;height: 45px;padding-right: 0px;"><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg" style="width: 45px;"></div>
                                    <div class="col-auto" style="height: 45px;padding-left: 0px;width: auto;margin-left: 12px;">
                                        <p style="text-align: left;width: 169.5px;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Name - Class</p>
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Score %</p>
                                    </div>
                                    <div class="col-auto offset-2" style="height: 45px;width: auto;padding-right: 0px;">
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;height: 45px;margin-left: 14px;margin-right: 12px;"><a href="#">Remove&nbsp;from class</a>&nbsp;|&nbsp;<a href="#"><span style="text-decoration: underline;">Reset</span></a><br><br><br></p>
                                    </div>
                                </div>
                                <div class="row" id="student-15" style="margin-bottom: 12px;">
                                    <div class="col-auto" style="width: auto;height: 45px;padding-right: 0px;"><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg" style="width: 45px;"></div>
                                    <div class="col-auto" style="height: 45px;padding-left: 0px;width: auto;margin-left: 12px;">
                                        <p style="text-align: left;width: 169.5px;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Name - Class</p>
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Score %</p>
                                    </div>
                                    <div class="col-auto offset-2" style="height: 45px;width: auto;padding-right: 0px;">
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;height: 45px;margin-left: 14px;margin-right: 12px;"><a href="#">Remove&nbsp;from class</a>&nbsp;|&nbsp;<a href="#"><span style="text-decoration: underline;">Reset</span></a><br><br><br></p>
                                    </div>
                                </div>
                            </div>
                            <!--Class section of modal-->
                            <div class="col" style="border-left-width: 1px;border-left-style: solid;">
                                <p style="color: rgb(0,0,0);font-weight: bold;font-family: 'Open Sans', sans-serif;width: 100%;">Classes:</p>
                                <div class="row" id="class" style="margin-bottom: 12px;">
                                    <div class="col-auto" style="width: auto;height: 45px;padding-right: 0px;"><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar5.jpeg" style="width: 45px;"></div>
                                    <div class="col-auto" style="height: 45px;padding-left: 0px;width: auto;margin-left: 12px;">
                                        <p style="text-align: left;width: 169.5px;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Class Name</p>
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;"># of students</p>
                                    </div>
                                    <div class="col-auto offset-4" style="height: 45px;width: auto;padding-right: 12px;padding-left: 50px;">
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;height: 45px;margin-left: 22px;"><a href="#"><span style="text-decoration: underline;">Reset</span></a><br><br><br></p>
                                    </div>
                                </div>
                                <div class="row" id="class-1" style="margin-bottom: 12px;">
                                    <div class="col-auto" style="width: auto;height: 45px;padding-right: 0px;"><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar5.jpeg" style="width: 45px;"></div>
                                    <div class="col-auto" style="height: 45px;padding-left: 0px;width: auto;margin-left: 12px;">
                                        <p style="text-align: left;width: 169.5px;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Class Name</p>
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;"># of students</p>
                                    </div>
                                    <div class="col-auto offset-4" style="height: 45px;width: auto;padding-right: 12px;padding-left: 50px;">
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;height: 45px;margin-left: 22px;"><a href="#"><span style="text-decoration: underline;">Reset</span></a><br><br><br></p>
                                    </div>
                                </div>
                                <div class="row" id="class-2" style="margin-bottom: 12px;">
                                    <div class="col-auto" style="width: auto;height: 45px;padding-right: 0px;"><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar5.jpeg" style="width: 45px;"></div>
                                    <div class="col-auto" style="height: 45px;padding-left: 0px;width: auto;margin-left: 12px;">
                                        <p style="text-align: left;width: 169.5px;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Class Name</p>
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;"># of students</p>
                                    </div>
                                    <div class="col-auto offset-4" style="height: 45px;width: auto;padding-right: 12px;padding-left: 50px;">
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;height: 45px;margin-left: 22px;"><a href="#"><span style="text-decoration: underline;">Reset</span></a><br><br><br></p>
                                    </div>
                                </div>
                                <div class="row" id="class-3" style="margin-bottom: 12px;">
                                    <div class="col-auto" style="width: auto;height: 45px;padding-right: 0px;"><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar5.jpeg" style="width: 45px;"></div>
                                    <div class="col-auto" style="height: 45px;padding-left: 0px;width: auto;margin-left: 12px;">
                                        <p style="text-align: left;width: 169.5px;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;">Class Name</p>
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;"># of students</p>
                                    </div>
                                    <div class="col-auto offset-4" style="height: 45px;width: auto;padding-right: 12px;padding-left: 50px;">
                                        <p style="text-align: left;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 14px;margin-bottom: 0px;height: 45px;margin-left: 22px;"><a href="#"><span style="text-decoration: underline;">Reset</span></a><br><br><br></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button></div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown no-arrow">

                                <!-- User name grabbed and processed by server.php file to generate profile picture and display name so user knows it is their dashboard and to make it more personalised -->
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown"><span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $_SESSION['name']; ?></span><img class="border rounded-circle img-profile" src="https://robohash.org/<?php echo filter_var($_SESSION['name'], FILTER_SANITIZE_STRING); ?>">
                                    </a>

                                    <!-- Allows user to enter settings or sign out when clicked -->
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="settings.php"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="teach_db.php?logout='1'"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <!--Navbar is linked accross every page so it always looks the same-->
                    </div>
                </nav>
                <div class="container-fluid">
                    <!--Stats will be actively pulled from the database and calculated,
- "Average %" will be calculated by obtaining all the scores of every activity done by the user and dividing by how many activities have been done
- "Activities completed" will be calculating by adding all the activities the user has completed from the database
- "Most studied topic" will be calculating how many activities have been done for each topic, in the future it could also check if the names of other topics match and then make it into 1 category (e.g. "Maths: Algebra" and "Maths: Quadratic equations" both have "Maths" and could be combined into the "Maths" topic)
- "Time spent on site" will be calculated using google analytics or special libraries like TimeMe.js (https://github.com/jasonzissman/TimeMe.js/), this will be added to a field in a database where it is then displayed in the stats-->
                    <p style="margin-bottom: 5px;font-family: 'Open Sans', sans-serif;color: rgb(0,0,0);font-size: 18px;"><strong>Overall Stats:</strong></p>
                    <div class="row" style="font-family: 'Open Sans', sans-serif;margin-bottom: 20px;">

                        <!-- Gets total number of activities completed from session variable set by stats.php file -->
                        <div class="col-md-3" style="border-right-width: 1px;border-right-style: solid;height: 100%;">
                            <p style="color: rgb(0,0,0);margin-bottom: 0px;">Activities completed:</p>
                            <p style="color: rgb(0,0,0);"><strong><?php  echo $_SESSION['totalactivities']; ?></strong></p>
                        </div>
                        <div class="col-md-3" style="border-right-width: 1px;border-right-style: solid;height: 100%;">
                            <p style="color: rgb(0,0,0);margin-bottom: 0px;">Average %:</p>
                            <p style="color: rgb(0,0,0);"><strong>90%</strong></p>
                        </div>
                        <div class="col-md-3" style="border-right-width: 1px;border-right-style: solid;height: 100%;">
                            <p style="color: rgb(0,0,0);margin-bottom: 0px;">Most studied topic:</p>
                            <p style="color: rgb(0,0,0);"><strong>Maths</strong></p>
                        </div>
                        <div class="col-md-3" style="height: 100%;">
                            <p style="color: rgb(0,0,0);margin-bottom: 0px;">Time spent on site:</p>
                            <p style="color: rgb(0,0,0);"><strong>13d 10h 7m</strong></p>
                        </div>
                    </div>
                    <p style="margin-bottom: 5px;font-family: 'Open Sans', sans-serif;color: rgb(0,0,0);font-size: 18px;"><strong>Top Student:</strong></p>
                    <div class="row" style="font-family: 'Open Sans', sans-serif;margin-bottom: 20px;">
                        <div class="col-md-3" style="border-right-width: 1px;border-right-style: solid;height: 100%;">
                            <p style="color: rgb(0,0,0);margin-bottom: 0px;">Name:</p>
                            <p style="color: rgb(0,0,0);"><strong>Alex Harrison</strong></p>
                        </div>
                        <div class="col-md-3" style="border-right-width: 1px;border-right-style: solid;height: 100%;">
                            <p style="color: rgb(0,0,0);margin-bottom: 0px;">Average %:</p>
                            <p style="color: rgb(0,0,0);"><strong>98%</strong></p>
                        </div>
                        <div class="col-md-3" style="border-right-width: 1px;border-right-style: solid;height: 100%;">
                            <p style="color: rgb(0,0,0);margin-bottom: 0px;">Most studied topic:</p>
                            <p style="color: rgb(0,0,0);"><strong>Criminology</strong></p>
                        </div>
                        <div class="col-md-3" style="height: 100%;">
                            <p style="color: rgb(0,0,0);margin-bottom: 0px;">Time spent on site:</p>
                            <p style="color: rgb(0,0,0);"><strong>1d 13h 2m</strong></p>
                        </div>
                    </div>
                    <div class="row" style="font-family: 'Open Sans', sans-serif;margin-bottom: 20px;border-top-width: 1px;border-top-style: solid;width: 100%;">
                        <div class="col-md-3">
                            <div style="width: 100%;"><canvas data-bss-chart="{&quot;type&quot;:&quot;bar&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Class 1&quot;,&quot;Class 2&quot;,&quot;Class 3&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Average %&quot;,&quot;backgroundColor&quot;:&quot;rgb(0,56,255)&quot;,&quot;data&quot;:[&quot;98&quot;,&quot;94&quot;,&quot;87&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:true,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;,&quot;fontFamily&quot;:&quot;'Open Sans', sans-serif&quot;}},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;bold&quot;,&quot;display&quot;:true,&quot;text&quot;:&quot;Average Score (%)&quot;},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;ticks&quot;:{&quot;fontFamily&quot;:&quot;'Open Sans', sans-serif&quot;,&quot;fontStyle&quot;:&quot;normal&quot;}}],&quot;yAxes&quot;:[{&quot;ticks&quot;:{&quot;fontFamily&quot;:&quot;'Open Sans', sans-serif&quot;,&quot;fontStyle&quot;:&quot;normal&quot;}}]}}}"></canvas></div>
                        </div>
                        <div class="col-md-3">
                            <div style="width: 100%;"><canvas data-bss-chart="{&quot;type&quot;:&quot;line&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;1st Quarter&quot;,&quot;2nd Quarter&quot;,&quot;3rd Quarter&quot;,&quot;4th Quarter&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Class 1&quot;,&quot;fill&quot;:true,&quot;data&quot;:[&quot;22&quot;,&quot;26&quot;,&quot;24&quot;,&quot;20&quot;],&quot;backgroundColor&quot;:&quot;rgba(255,255,255,0)&quot;,&quot;borderColor&quot;:&quot;rgb(5,0,255)&quot;,&quot;borderWidth&quot;:&quot;2&quot;},{&quot;label&quot;:&quot;Class 2&quot;,&quot;fill&quot;:true,&quot;data&quot;:[&quot;19&quot;,&quot;19&quot;,&quot;25&quot;,&quot;23&quot;],&quot;backgroundColor&quot;:&quot;rgba(255,255,255,0)&quot;,&quot;borderColor&quot;:&quot;rgb(255,92,0)&quot;,&quot;borderWidth&quot;:&quot;2&quot;},{&quot;label&quot;:&quot;Class 3&quot;,&quot;fill&quot;:true,&quot;data&quot;:[&quot;30&quot;,&quot;25&quot;,&quot;27&quot;,&quot;23&quot;],&quot;borderWidth&quot;:&quot;2&quot;,&quot;backgroundColor&quot;:&quot;rgba(255,255,255,0)&quot;,&quot;borderColor&quot;:&quot;rgb(61,61,61)&quot;}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:true,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;,&quot;fontFamily&quot;:&quot;'Open Sans', sans-serif&quot;}},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;bold&quot;,&quot;display&quot;:true,&quot;text&quot;:&quot;Time Spent Per Class (h)&quot;,&quot;fontFamily&quot;:&quot;'Open Sans', sans-serif&quot;},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;ticks&quot;:{&quot;fontFamily&quot;:&quot;'Open Sans', sans-serif&quot;,&quot;fontStyle&quot;:&quot;normal&quot;}}],&quot;yAxes&quot;:[{&quot;ticks&quot;:{&quot;fontFamily&quot;:&quot;'Open Sans', sans-serif&quot;,&quot;fontStyle&quot;:&quot;normal&quot;}}]}}}"></canvas></div>
                        </div>
                        <div class="col-auto col-md-3" style="margin-left: 10%;">
                            <div class="row d-xxl-flex" style="margin-top: 12px;margin-bottom: 12px;border-bottom-width: 1px;border-bottom-style: solid;">
                                <div class="col d-xxl-flex justify-content-xxl-center"><button class="btn btn-primary" type="button" data-bs-target="#modal-1" data-bs-toggle="modal" style="margin-bottom: 12px;width: 100%;">Manage Students</button></div>
                            </div>
                            <div class="row">
                                <div class="col d-xxl-flex justify-content-xxl-center" style="width: 100%;"><input type="file" style="width: 100%;"></div>
                            </div>
                            <div class="row" style="margin-top: 12px;">
                                <div class="col">
                                    <p style="color: rgb(0,0,0);margin-bottom: 0px;">Topic name</p><input type="text" placeholder="GCSE French">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 12px;">
                                <div class="col"><button class="btn btn-success" type="submit" style="margin-bottom: 12px;width: 100%;background: rgb(52,200,28);" data-bs-toggle="modal">Submit</button></div>
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
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>