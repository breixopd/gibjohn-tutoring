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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Subjects - GibJohn</title>
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
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="font-family: 'Open Sans', sans-serif;">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="dashboard.php">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-graduation-cap"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>GibJohn</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="fa fa-inbox"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="activities.php"><i class="fa fa-folder-open"></i><span>Activities</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="subjects.php"><i class="fa fa-paperclip"></i><span>Subjects</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="knowledgebase.php"><i class="fa fa-book"></i><span>Knowledgebase</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="modal fade" role="dialog" tabindex="-1" id="modal-1">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Subject Name</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p style="color: rgb(0,0,0);">Activities in subject:</p>
                        <p style="margin-bottom: 12px;"><a href="activities.php#act">Activity 1</a></p>
                        <p style="margin-bottom: 12px;"><a href="activities.php#act-1">Activity 2</a></p>
                        <p style="margin-bottom: 12px;"><a href="activities.php#act-2">Activity 3</a></p>
                        <p style="margin-bottom: 12px;"><a href="activities.php#act-3">Activity 4</a></p>
                        <p style="margin-bottom: 12px;"><a href="activities.php#act-4">Activity 5</a></p>
                        <p style="margin-bottom: 12px;"><a href="activities.php#act-5">Activity 6</a></p>
                        <p style="margin-bottom: 12px;"><a href="activities.php#act-6">Activity 7</a></p>
                        <p style="margin-bottom: 12px;"><a href="activities.php#act-7">Activity 8</a></p>
                        <p style="margin-bottom: 12px;"><a href="activities.php#act-8">Activity 9</a></p>
                        <p style="margin-bottom: 12px;"><a href="activities.php#act-9">Activity 10</a></p>
                        <p style="margin-bottom: 12px;"><a href="activities.php#act-10">Activity 11</a></p>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button></div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column" id="content-wrapper" style="font-family: 'Open Sans', sans-serif;">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown"><span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $_SESSION['name']; ?></span><img class="border rounded-circle img-profile" src="https://robohash.org/<?php echo filter_var($_SESSION['name'], FILTER_SANITIZE_STRING); ?>">
                                        <!--Allows user to enter settings or sign out when clicked-->
                                    </a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="settings.php"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="dashboard.php?logout='1'"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <!--Navbar is linked accross every page so it always looks the same-->
                    </div>
                </nav>
                <div class="container-fluid">
                    <p style="margin-bottom: 5px;color: rgb(0,0,0);font-size: 18px;"><strong>Filter by: </strong><a href="#"><span style="text-decoration: underline;">Completed</span></a>&nbsp;| <a href="#"><span style="text-decoration: underline;">Uncompleted</span></a> | <a href="#"><span style="text-decoration: underline;">Score (High to Low)</span></a>&nbsp;|&nbsp;<a href="#"><span style="text-decoration: underline;">Score (Low to High)</span></a><br></p>
                    <div class="row" style="width: 100%;">
                        <div class="col" style="margin-bottom: 20px;"><a style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(120%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/1003/300/200.jpg?hmac=oYEL3IP681vTZtrJIPtCEBR8VmWNII0bP_FUZ6jcbb8">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(120%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/348/300/200.jpg?hmac=yzm-mkbJxBZX4-skk2K7k9Cp1V99tKTABxjLtUs2nC0">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(120%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/469/300/200.jpg?hmac=hW0n8pKywvLwjAgOSK4DtnKIemz9A5GsFp8X2Gp-Vqg">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-remove" style="transform: translateX(20%) translateY(120%);color: rgb(255,0,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/742/300/200.jpg?hmac=gn-CxjKp2XyhburXPC-z7d9YYHB4d09rRYDoEm7L6Hw">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject name - (89% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(120%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/563/300/200.jpg?hmac=2zX8b2Akr3vClB4c0Bx6LAWb84LX0QuFxjzdkYezFlU">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(120%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/846/300/200.jpg?hmac=6r8o1I6t8lwnAIKIKrcjBMLdig9RQCno8P8iYSwL4I4">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(120%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/959/300/200.jpg?hmac=5NQIVU0R5sewvq5G4K3InNWPdNuc85DTdDbM3JKkW8c">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                    </div>
                    <div class="row" style="width: 100%;">
                        <div class="col" style="margin-bottom: 20px;"><a style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(120%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/879/300/200.jpg?hmac=uKqw_Pd7VHSeTqYP3g9TBZKuSUt9B0ka1q96THI9vAk">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(120%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/390/300/200.jpg?hmac=cymHwDXwfD0DVw-OlfJQqwaRiDgJFlaGi-_j-KPH2L8">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(120%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/858/300/200.jpg?hmac=1xjIg6-ebnZazwR6A6R2PsLXCKY6954oVv6-0Z9SIrw">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(120%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/1004/300/200.jpg?hmac=7-TY6gJOo8Sol1s-R4oKfxsFL7nzfuuZKhyNAnqc98k">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(120%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/342/300/200.jpg?hmac=feSfiZQe6nvV7YANCmcGnmmuPePxQMzr-iCNcm3zpWo">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(120%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/464/300/200.jpg?hmac=c3tWTbxJUSWSbMYqDyp0Ugteuv4v94-RcMYSj6I1SuU">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(120%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/596/300/200.jpg?hmac=5zSkfdzvZ3KYjXu2bTkyBlzFf669dQbWlMHyDS2NE5M">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                    </div>
                    <div class="row" style="width: 100%;">
                        <div class="col" style="margin-bottom: 20px;"><a style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(120%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/222/300/200.jpg?hmac=gB9uVfgHqVVQA1ULZfrdgK5z11xzGCKRfkmT-VlZvc8">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(120%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/317/300/200.jpg?hmac=QsUTPCAF1qpGLg6_aT7jXVxRjpdnGST8pI8nn0SxJQs">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(120%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/868/300/200.jpg?hmac=Y3h8_rEYYq79dZTei1gxs81Btur1kyNtPoB0F2o4D4I">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(120%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/914/300/200.jpg?hmac=0IqDw_a086y2GU84NYW3wG-H9WeTc0oGoQZt40LDY_0">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(120%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/465/300/200.jpg?hmac=wuEFdLMQetfdFjgfRj-29__8dqdpB3IlwoF86SAvwcM">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(120%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/718/300/200.jpg?hmac=2AXNXV_A7Vmp-rOv8sWOWmRkGUZUJmc8pP3Gvsmu-PE">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject description.</p>
                                    </div>
                                </div>
                            </a></div>
                        <div class="col" style="margin-bottom: 20px;"><a style="text-decoration: none !important;color: rgb(133,135,150);" data-bs-target="#modal-1" data-bs-toggle="modal">
                                <div class="card grow" style="margin-right: 5px;text-decoration: none !important;">
                                    <div class="card-body" style="padding-top: 1px;"><i class="fa fa-check" style="transform: translateX(20%) translateY(120%);color: rgb(22,160,0);width: 10%;height: 10%;font-size: 1.25vw;"></i><img style="width: 100%;height: 100%;margin-bottom: 10px;" src="https://i.picsum.photos/id/278/300/200.jpg?hmac=_bvuVjmZYS0KMKQjXFCXJ2RXAtEiBqXN2-kOInuMxcY">
                                        <h6 class="text-muted card-subtitle mb-2" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject name - (95% correct)</h6>
                                        <p class="card-text" style="color: rgb(133,135,150);font-family: 'Open Sans', sans-serif;font-size: 0.75vw;">Subject description.</p>
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
                <!--Footer is linked accross every page so it always looks the same-->
            </footer>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>