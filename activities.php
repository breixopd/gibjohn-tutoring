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
?>

<!DOCTYPE html>
<html>

<head>

    <!-- Import all style sheets, fonts and other assets needed to run site as well as set the site width to be the width of the screen content is displayed on -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- Set the title for the page -->
    <title>Activities - GibJohn</title>
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

                <!-- Set all the items to be displyed in the navigation bar (links to pages and other functions) -->
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="fa fa-inbox"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="activities.php"><i class="fa fa-folder-open"></i><span>Activities</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="subjects.php"><i class="fa fa-paperclip"></i><span>Subjects</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="knowledgebase.php"><i class="fa fa-book"></i><span>Knowledgebase</span></a></li>
                </ul>

                <!-- Button to toggle sidebar -->
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <!-- Navbar is linked accross every page so it always looks the same -->

        <!-- Make modal to display questions (a modal is a pop up with content inside of it) -->
        <div class="modal fade" role="dialog" tabindex="-1" id="modal-1">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <!-- Load lesson file here and place in modal body, when "Next Question" is clicked chek what section youre in and show the next question from file until there are no more. For the purpose of this prototype there is only 1 question so the user can see what the end screen will look like -->
                    <div class="modal-header">

                        <!-- Activity name loaded from lesson file, for the purpose of the prototype it is hard-coded in -->
                        <h4 class="modal-title">Computer Science</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="user" method="POST" action="activities.php">
                        <div class="modal-body">

                            <!-- Question and answers dynamically loaded from lesson file, when "Next Question" is clicked the site looks at the next pat of the lesson file, if there is a question it is loaded and if there is no question, final screen is triggered, for the purpose of this prototype the questions have been hard coded in -->
                            <p style="color: rgb(0,0,0);">What is the purpose of the CPU?</p>
                            <div class="form-check"><input class="form-check-input" type="radio" id="formCheck-1" value="incorrect" name="answer"><label class="form-check-label" for="formCheck-1">To store data</label></div>
                            <div class="form-check"><input class="form-check-input" type="radio" id="formCheck-5" value="incorrect" name="answer"><label class="form-check-label" for="formCheck-5">To create data</label></div>
                            <div class="form-check"><input class="form-check-input" type="radio" id="formCheck-4" value="incorrect" name="answer"><label class="form-check-label" for="formCheck-4">Nothing</label></div>
                            <div class="form-check"><input class="form-check-input" type="radio" id="formCheck-3" value="correct" name="answer"><label class="form-check-label" for="formCheck-3">To process data</label></div>
                            <div class="form-check"><input class="form-check-input" type="radio" id="formCheck-2" value="incorrect" name="answer"><label class="form-check-label" for="formCheck-2">Alex</label></div>
                        </div>

                        <!-- Button to close modal or go to next question (will finish quiz if no more questions loaded)
                        This also submits the answer to the stats file which checks if answer is right or wrong and calculates score, it also adds 1 to the "Activities completed" field in the database if user is on last question of quiz -->
                        <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button name="submit_q" class="btn btn-primary" type="submit" data-bs-target="#modal-2" data-bs-toggle="modal" data-bs-dismiss="modal">Next Question</button></div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Make modal to display the result of the questions if there are no more questions (a modal is a pop up with content inside of it) -->
        <div class="modal fade" role="dialog" tabindex="-1" id="modal-2">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <!-- Final screen shown when user fully completes activity -->
                    <div class="modal-header">

                        <!-- Activity name loaded from lesson file, for the purpose of the prototype it is hard-coded in -->
                        <h4 class="modal-title">Computer Science</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p style="color: rgb(0,0,0);font-weight: bold;">Results</p>
                        <!-- Different messages depending on score, score is calculated in stats.php file and set as a session value so it can be grabbed to be put here -->
                        <p><?php echo $_SESSION['score']; ?> correct</p>
                        <!-- Score will be dynamically updated from how well the user is currently doing, it will then be sent to the database along with activity ID, user ID, etc -->
                        <p>Good job! if you want to revise more, click the red button below to be taken to a more fun interactive game!</p>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><a class="btn btn-danger" role="button" href="https://quizlet.com/636161795/learn" target="_blank">Revise more!</a></div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content" style="font-family: 'Open Sans', sans-serif;">

                <!-- Other navigation bar to display user name, profile picture and give access to settings and log out -->
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown no-arrow">

                                <!-- User name grabbed and processed by server.php file to generate profile picture and display name so user knows it is their dashboard and to make it more personalised -->
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown"><span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo filter_var($_SESSION['name'], FILTER_SANITIZE_STRING); ?></span><img class="border rounded-circle img-profile" src="https://robohash.org/<?php echo filter_var($_SESSION['name'], FILTER_SANITIZE_STRING); ?>">
                                    </a>

                                    <!-- Allows user to enter settings or sign out when clicked -->
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="settings.php"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="activities.php?logout='1'"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                </div>
                            </li>
                        </ul>
                        <!-- Navbar is linked accross every page so it always looks the same -->
                    </div>
                </nav>
                <div class="container-fluid">
                    <!-- Activities open a modal which loads the questions for that activity specifically, the ID of the activity will be used to find the questions needed. 
                    If an activity is below 90% score it will have a red cross displayed telling the user they can try again, for the purpose of this prototype this has not been implemented -->
                    <p style="margin-bottom: 5px;font-family: 'Open Sans', sans-serif;color: rgb(0,0,0);font-size: 18px;"><strong>Filter by: </strong><a href="#"><span style="text-decoration: underline;">Completed</span></a>&nbsp;| <a href="#"><span style="text-decoration: underline;">Uncompleted</span></a> | <a href="#"><span style="text-decoration: underline;">Score (High to Low)</span></a>&nbsp;|&nbsp;<a href="#"><span style="text-decoration: underline;">Score (Low to High)</span></a><br></p>
                    <div class="row" style="width: 100%;">
                        <div class="col" style="margin-bottom: 20px;"><a id="act" href="#" style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(40%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/600/300/200.jpg?hmac=PWexYteIqCRJi5CLmnhEtNKWYBMAC0g65O1e9EfaB1g">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;">Computer Science - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;">Example working activity.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col act" style="margin-bottom: 20px;"><a id="act-1" href="#" style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/185/300/200.jpg?hmac=NRgVq0nYX5DKDbKu2HwUPzwfwnkCObUj-JZdr_1CFmU">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;">Activity name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col act" style="margin-bottom: 20px;"><a id="act-2" href="#" style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/497/300/200.jpg?hmac=bstwBWFlLq7VhrORq4UIJTiO3vcXSOVJPDz7Hkct1P4">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;">Activity name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col act" style="margin-bottom: 20px;"><a id="act-3" href="#" style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-remove" style="transform: translateX(20%) translateY(35%);color: rgb(255,0,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/953/300/200.jpg?hmac=JaHWS3Co-YhKhuYQOqy9mRGl43qNvyitMzMgrG8cVcc">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;">Activity name - (87% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col act" style="margin-bottom: 20px;"><a id="act-4" href="#" style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/472/300/200.jpg?hmac=8mzEAFGSWoGJCAhPWWzIM9NE-6KPODlkk7Tb6rbcO_w">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;">Activity name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col act" style="margin-bottom: 20px;"><a id="act-5" href="#" style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/459/300/200.jpg?hmac=OXfJsmMw6GdbqdAjYVvHq0nzzlO3WQ0bWp2SJ5lZ9tU">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;">Activity name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col act" style="margin-bottom: 20px;"><a id="act-6" href="#" style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/1052/300/200.jpg?hmac=5wWMPKBLB9_I10HVh8H_7Ng-INVrgeeE3sGK1jfXDnY">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;">Activity name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                    </div>
                    <div class="row" style="width: 100%;">
                        <div class="col" style="margin-bottom: 20px;"><a id="act-7" href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/376/300/200.jpg?hmac=bOXzRoXwr6T77ZdJkDsUwzmNZDqgEqJ_BZWATS6JaNk">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;">Activity name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a id="act-8" href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/156/300/200.jpg?hmac=CjuzbXWDfESNYnRvGLZd_sQtE7vGlrMFXalknMvVDHU">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;">Activity name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a id="act-9" href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/694/300/200.jpg?hmac=wpryplBFEyOand7U4tYdSh5UHw5EcvQrNVWF_QRJF3g">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;">Activity name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a id="act-10" href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/219/300/200.jpg?hmac=j2ah6EBvyUkr43C0PPj5iDsA9NUbxQxWFx8uJIUazKc">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;">Activity name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a id="act-11" href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/1018/300/200.jpg?hmac=7zbk4w0X7mlStuBLB7ZOuCyvzKkZkcOOvpE353yHcwE">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;">Activity name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a id="act-12" href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/974/300/200.jpg?hmac=Z2fMh1o0gtg6D6DsgKK85wRjU1kd7pKitAm0pK13Tyo">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;">Activity name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a id="act-13" href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/622/300/200.jpg?hmac=TAU_hYYzfU2Ej1_aluejloMjuPbkdcZOHE4HQKHKAwA">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;">Activity name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                    </div>
                    <div class="row" style="width: 100%;">
                        <div class="col" style="margin-bottom: 20px;"><a id="act-14" href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/677/300/200.jpg?hmac=UxocKgdm2QpboJMxv-gL5iPfoOjMUfucjq1QbrgWASc">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;">Activity name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a id="act-15" href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/60/300/200.jpg?hmac=hbgqyqs6BsK-HwddRXZB-4roeVBOcL6eGbHHq_Mio5c">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;">Activity name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a id="act-16" href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/656/300/200.jpg?hmac=2hRtZE2fdl68yHO9qbGckT-gJqG8gCyEDqDzhEeSFC8">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;">Activity name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a id="act-17" href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/428/300/200.jpg?hmac=ikKOcamKDMicSZKD7eMbhzgMNNbyCucuLohsjaMt740">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;">Activity name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a id="act-18" href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/926/300/200.jpg?hmac=iIRDaWPlwjd-Baax-jLh-dwiOutfZYo5-skc-13pUIw">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;">Activity name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a id="act-19" href="#" style="text-decoration: none !important;color: rgb(133,135,150);">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/434/300/200.jpg?hmac=d_lsZvugLf5FBhJEHlA5W64vrusUmH_xFFt8zruga-E">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;">Activity name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a id="act-20" href="#" style="text-decoration: none !important;">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(35%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;margin-top: -15px;" src="https://i.picsum.photos/id/386/300/200.jpg?hmac=Vftz3u3poKlfIs-uGdO867oUeJn94HHed6zmHnjJfzk">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-size: 0.75vw;">Activity name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer" style="font-family: 'Open Sans', sans-serif;">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © GibJohn 2022 | <a href="privacy-policy.html">Privacy Policy</a> | <a href="code-of-conduct.html">Code of Conduct</a>&nbsp;| 07000000000 |&nbsp;<a href="mailto:support@email.com"><span style="text-decoration: underline;">support@email.com</span></a><br></span></div>
                </div>
                <!-- Footer is linked accross every page so it always looks the same -->
            </footer>
        </div>
    </div>

    <!-- Any other scripts needed for the site are loaded here -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>