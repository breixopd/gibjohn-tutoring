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
    <title>Knowledgebase - GibJohn</title>
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
                    <p style="color: rgb(0,0,0);font-size: 18px;"><strong>Content table:</strong></p>
                    <div class="row">
                        <!--Drop down lists with all the content a user may have questions about, this has been split into 2 sections so the user can find what they need more easily, more content can also easily be added in the future-->
                        <div class="col" style="width: 75%;">
                            <div class="row">
                                <div class="col" style="border-right-width: 1px;border-right-style: solid;">
                                    <div class="accordion" role="tablist" id="faq-accordion" style="width: 100%;height: 100%;color: #000000;font-size: 14px;">
                                        <div class="accordion-item" style="color: #000000;font-size: 14px;">
                                            <h2 class="accordion-header" role="tab" style="color: #000000;font-size: 16px;"><button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#faq-accordion .item-1" aria-expanded="true" aria-controls="faq-accordion .item-1" style="color: #000000;font-size: 16px;">FAQ</button></h2>
                                            <div class="accordion-collapse collapse show item-1" role="tabpanel" data-bs-parent="#faq-accordion" style="color: #000000;font-size: 14px;">
                                                <div class="accordion-body">
                                                    <p class="mb-0" style="color: #000000;font-size: 14px;">This FAQ is designed to help you with any general questions you may have, if you require additional support email <a href="mailto:support@gibjohntutors.com">here</a>.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item" style="color: #000000;font-size: 14px;">
                                            <h2 class="accordion-header" role="tab" style="color: #000000;font-size: 16px;"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-accordion .item-2" aria-expanded="false" aria-controls="faq-accordion .item-2" style="color: #000000;font-size: 16px;">Item 1</button></h2>
                                            <div class="accordion-collapse collapse item-2" role="tabpanel" data-bs-parent="#faq-accordion" style="color: #000000;font-size: 14px;">
                                                <div class="accordion-body">
                                                    <p class="mb-0" style="color: #000000;font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item" style="color: #000000;font-size: 14px;">
                                            <h2 class="accordion-header" role="tab" style="color: #000000;font-size: 16px;"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-accordion .item-3" aria-expanded="false" aria-controls="faq-accordion .item-3" style="color: #000000;font-size: 16px;">Item 2<br></button></h2>
                                            <div class="accordion-collapse collapse item-3" role="tabpanel" data-bs-parent="#faq-accordion" style="color: #000000;font-size: 14px;">
                                                <div class="accordion-body">
                                                    <p class="mb-0" style="color: #000000;font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item" style="color: #000000;font-size: 14px;">
                                            <h2 class="accordion-header" role="tab" style="color: #000000;font-size: 16px;"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-accordion .item-4" aria-expanded="false" aria-controls="faq-accordion .item-4" style="color: #000000;font-size: 16px;">Item 3</button></h2>
                                            <div class="accordion-collapse collapse item-4" role="tabpanel" data-bs-parent="#faq-accordion" style="color: #000000;font-size: 14px;">
                                                <div class="accordion-body">
                                                    <p class="mb-0" style="color: #000000;font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item" style="color: #000000;font-size: 14px;">
                                            <h2 class="accordion-header" role="tab" style="color: #000000;font-size: 16px;"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-accordion .item-5" aria-expanded="false" aria-controls="faq-accordion .item-5" style="color: #000000;font-size: 16px;">Item 4</button></h2>
                                            <div class="accordion-collapse collapse item-5" role="tabpanel" data-bs-parent="#faq-accordion" style="color: #000000;font-size: 14px;">
                                                <div class="accordion-body">
                                                    <p class="mb-0" style="color: #000000;font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item" style="color: #000000;font-size: 14px;">
                                            <h2 class="accordion-header" role="tab" style="color: #000000;font-size: 16px;"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-accordion .item-6" aria-expanded="false" aria-controls="faq-accordion .item-6" style="color: #000000;font-size: 16px;">Item 5</button></h2>
                                            <div class="accordion-collapse collapse item-6" role="tabpanel" data-bs-parent="#faq-accordion" style="color: #000000;font-size: 14px;">
                                                <div class="accordion-body">
                                                    <p class="mb-0" style="color: #000000;font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col" style="border-right-width: 1px;border-right-style: solid;">
                                    <div class="accordion" role="tablist" id="support-accordion" style="width: 100%;height: 100%;color: #000000;font-size: 14px;">
                                        <div class="accordion-item" style="color: #000000;font-size: 14px;">
                                            <h2 class="accordion-header" role="tab" style="color: #000000;font-size: 16px;"><button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#support-accordion .item-1" aria-expanded="true" aria-controls="support-accordion .item-1" style="color: #000000;font-size: 16px;">Student Support</button></h2>
                                            <div class="accordion-collapse collapse show item-1" role="tabpanel" data-bs-parent="#support-accordion" style="color: #000000;font-size: 14px;">
                                                <div class="accordion-body">
                                                    <p class="mb-0" style="color: #000000;font-size: 14px;">This section was made to help students who are feeling stressed, worried, anxiety or anything else to get help.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item" style="color: #000000;font-size: 14px;">
                                            <h2 class="accordion-header" role="tab" style="color: #000000;font-size: 16px;"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#support-accordion .item-2" aria-expanded="false" aria-controls="support-accordion .item-2" style="color: #000000;font-size: 16px;">Item 1</button></h2>
                                            <div class="accordion-collapse collapse item-2" role="tabpanel" data-bs-parent="#support-accordion" style="color: #000000;font-size: 14px;">
                                                <div class="accordion-body">
                                                    <p class="mb-0" style="color: #000000;font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item" style="color: #000000;font-size: 14px;">
                                            <h2 class="accordion-header" role="tab" style="color: #000000;font-size: 16px;"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#support-accordion .item-3" aria-expanded="false" aria-controls="support-accordion .item-3" style="color: #000000;font-size: 16px;">Item 2<br></button></h2>
                                            <div class="accordion-collapse collapse item-3" role="tabpanel" data-bs-parent="#support-accordion" style="color: #000000;font-size: 14px;">
                                                <div class="accordion-body">
                                                    <p class="mb-0" style="color: #000000;font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item" style="color: #000000;font-size: 14px;">
                                            <h2 class="accordion-header" role="tab" style="color: #000000;font-size: 16px;"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#support-accordion .item-4" aria-expanded="false" aria-controls="support-accordion .item-4" style="color: #000000;font-size: 16px;">Item 3</button></h2>
                                            <div class="accordion-collapse collapse item-4" role="tabpanel" data-bs-parent="#support-accordion" style="color: #000000;font-size: 14px;">
                                                <div class="accordion-body">
                                                    <p class="mb-0" style="color: #000000;font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item" style="color: #000000;font-size: 14px;">
                                            <h2 class="accordion-header" role="tab" style="color: #000000;font-size: 16px;"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#support-accordion .item-5" aria-expanded="false" aria-controls="support-accordion .item-5" style="color: #000000;font-size: 16px;">Item 4</button></h2>
                                            <div class="accordion-collapse collapse item-5" role="tabpanel" data-bs-parent="#support-accordion" style="color: #000000;font-size: 14px;">
                                                <div class="accordion-body">
                                                    <p class="mb-0" style="color: #000000;font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item" style="color: #000000;font-size: 14px;">
                                            <h2 class="accordion-header" role="tab" style="color: #000000;font-size: 16px;"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#support-accordion .item-6" aria-expanded="false" aria-controls="support-accordion .item-6" style="color: #000000;font-size: 16px;">Item 5</button></h2>
                                            <div class="accordion-collapse collapse item-6" role="tabpanel" data-bs-parent="#support-accordion" style="color: #000000;font-size: 14px;">
                                                <div class="accordion-body">
                                                    <p class="mb-0" style="color: #000000;font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <p style="color: rgb(0,0,0);">How To Upload Lessons</p>
                                    <p style="color: rgb(0,0,0);font-size: 14px;">Import a lesson.json file in the <a href="teach_db.php"><span style="text-decoration: underline;">teacher dashboard</span></a>, to create a lesson.json file, follow <a href="#lesson"><span style="text-decoration: underline;">this</span></a>&nbsp;guide. An example file can be downloaded from <a href="example_lesson.json"><span style="text-decoration: underline;">here</span></a>.<br></p>
                                </div>
                            </div>
                        </div>
                        <!--Pictures to help motivate and reinforce the student encouraging them to keep learning and working-->
                        <div class="col"><img src="https://images.unsplash.com/photo-1605514449459-5a9cfa0b9955" style="width: 100%;object-fit: cover;">
                            <div class="row" style="margin-left: 0px;margin-right: 0px;">
                                <div class="col" style="padding-right: 0px;padding-left: 0px;width: 100%;height: 100%;"><img src="https://images.unsplash.com/photo-1617251137884-f135eccf6942" style="object-fit: cover;width: 100%;height: 240px;"></div>
                                <div class="col" style="padding-right: 0px;padding-left: 0px;width: 100%;height: 100%;"><img src="https://images.unsplash.com/photo-1576665665113-e262f19a3fa7" style="object-fit: cover;width: 100%;height: 240px;"></div>
                                <div class="col" style="padding-right: 0px;padding-left: 0px;width: 100%;height: 100%;"><img src="https://images.unsplash.com/photo-1528716321680-815a8cdb8cbe" style="object-fit: cover;width: 100%;height: 240px;"></div>
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
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>