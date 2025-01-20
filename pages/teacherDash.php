<?php
require_once '../config/database.php';
require_once '../includes/session_check.php';
require_once '../classes/user.php';
require_once '../classes/admin/teacher.php';
require_once '../classes/admin/course.php';
require_once '../classes/admin/courseService.php';

$courseModal = new ConcreteCourse(null, null, null, null, null, null, null, null, null, null, null);
$courses = new CourseService($courseModal, null);

$teacher_id = $_SESSION['user_id'];

if (!empty($teacher_id)) {
    $coursesForTeacher = $courses->getAllCoursesForTeacher($teacher_id);
} else {
    print_r($teacher_id);
    echo 1;
    die;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $course_id = $_POST['id'];

    if (isset($_POST['action']) && $_POST['action'] == 'delete_course') {
        $courseModal->delete($course_id);
    }
}

$teacher = new Teacher(null, null, null, null, null);
$statistics = $teacher->getStatistics($teacher_id);


$enrolledStudentsCount = $statistics[0]->count;
$coursesCount = $statistics[1]->count;
$activeCoursesCount = $statistics[2]->count;
// $studentsEnrolledCount = $statistics[3]->count;
?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from educhamp.themetrades.com/demo/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:08:15 GMT -->

<head>

    <!-- META ============================================= -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />

    <!-- DESCRIPTION -->
    <meta name="description" content="EduChamp : Education HTML Template" />

    <!-- OG -->
    <meta property="og:title" content="EduChamp : Education HTML Template" />
    <meta property="og:description" content="EduChamp : Education HTML Template" />
    <meta property="og:image" content="" />
    <meta name="format-detection" content="telephone=no">

    <!-- FAVICONS ICON ============================================= -->
    <link rel="icon" href="../error-404.html" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />

    <!-- PAGE TITLE HERE ============================================= -->
    <title>EduChamp : Education HTML Template </title>

    <!-- MOBILE SPECIFIC ============================================= -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--[if lt IE 9]>
	<script src="assets/js/html5shiv.min.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->

    <!-- All PLUGINS CSS ============================================= -->
    <link rel="stylesheet" type="text/css" href="../assets/assets/css/assets.css">
    <link rel="stylesheet" type="text/css" href="../assets/assets/vendors/calendar/fullcalendar.css">

    <!-- TYPOGRAPHY ============================================= -->
    <link rel="stylesheet" type="text/css" href="../assets/assets/css/typography.css">

    <!-- SHORTCODES ============================================= -->
    <link rel="stylesheet" type="text/css" href="../assets/assets/css/shortcodes/shortcodes.css">

    <!-- STYLESHEETS ============================================= -->
    <link rel="stylesheet" type="text/css" href="../assets/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../assets/assets/css/dashboard.css">
    <link class="skin" rel="stylesheet" type="text/css" href="../assets/assets/css/color/color-1.css">

</head>

<body class="ttr-opened-sidebar ttr-pinned-sidebar">

    <!-- header start -->
    <header class="ttr-header">
        <div class="ttr-header-wrapper">
            <!--sidebar menu toggler start -->
            <div class="ttr-toggle-sidebar ttr-material-button">
                <i class="ti-close ttr-open-icon"></i>
                <i class="ti-menu ttr-close-icon"></i>
            </div>
            <!--sidebar menu toggler end -->
            <!--logo start -->
            <div class="ttr-logo-box">
                <div>
                    <a href="index.html" class="ttr-logo">
                        <img alt="" class="ttr-logo-mobile" src="../assets/assets/images/logo-mobile.png" width="30" height="30">
                        <img alt="" class="ttr-logo-desktop" src="../assets/assets/images/logo-white.png" width="160" height="27">
                    </a>
                </div>
            </div>
            <!--logo end -->
            <div class="ttr-header-right ttr-with-seperator">
                <!-- header right menu start -->
                <ul class="ttr-header-navigation">
                    <li>
                        <a href="#" class="ttr-material-button ttr-search-toggle"><i class="fa fa-search"></i></a>
                        <a href="#" class="ttr-material-button ttr-search-toggle"><i class="fa fa-search"></i></a>
                    </li>
                    <li>
                        <a href="#" class="ttr-material-button ttr-submenu-toggle"><span class="ttr-user-avatar"><img alt="" src="../assets/assets/images/testimonials/pic3.jpg" width="32" height="32"></span></a>
                        <div class="ttr-header-submenu">
                            <ul>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <!-- header right menu end -->
            </div>
            <!--header search panel start -->
            <div class="ttr-search-bar">
                <form class="ttr-search-form">
                    <div class="ttr-search-input-wrapper">
                        <input type="text" name="qq" placeholder="search something..." class="ttr-search-input">
                        <button type="submit" name="search" class="ttr-search-submit"><i class="ti-arrow-right"></i></button>
                    </div>
                    <span class="ttr-search-close ttr-search-toggle">
                        <i class="ti-close"></i>
                    </span>
                </form>
            </div>
            <!--header search panel end -->
        </div>
    </header>
    <!-- header end -->
    <!-- Left sidebar menu start -->
    <div class="ttr-sidebar">
        <div class="ttr-sidebar-wrapper content-scroll">
            <!-- side menu logo start -->
            <div class="ttr-sidebar-logo">
                <a href="#"><img alt="" src="../assets/assets/images/logo.png" width="122" height="27"></a>
                <!-- <div class="ttr-sidebar-pin-button" title="Pin/Unpin Menu">
					<i class="material-icons ttr-fixed-icon">gps_fixed</i>
					<i class="material-icons ttr-not-fixed-icon">gps_not_fixed</i>
				</div> -->
                <div class="ttr-sidebar-toggle-button">
                    <i class="ti-arrow-left"></i>
                </div>
            </div>
            <!-- side menu logo end -->
            <!-- sidebar menu start -->
            <nav class="ttr-sidebar-navi">
                <ul>
                    <li>
                        <a href="teacherDash.php" class="ttr-material-button">
                            <span class="ttr-icon"><i class="ti-home"></i></span>
                            <span class="ttr-label">Dashborad</span>
                        </a>
                    </li>
                    <li>
                        <a href="add_course.php" class="ttr-material-button">
                            <span class="ttr-icon"><i class="ti-layout-accordion-list"></i></span>
                            <span class="ttr-label">Add listing</span>
                        </a>
                    </li>
                    <li class="ttr-seperate"></li>
                </ul>
                <!-- sidebar menu end -->
            </nav>
            <!-- sidebar menu end -->
        </div>
    </div>
    <!-- Left sidebar menu end -->

    <!--Main container start -->
    <main class="ttr-wrapper">
        <div class="container-fluid">
            <div class="db-breadcrumb">
                <h4 class="breadcrumb-title">Dashboard</h4>
                <ul class="db-breadcrumb-list">
                    <li><a href="#"><i class="fa fa-home"></i>Home</a></li>
                    <li>Dashboard</li>
                </ul>
            </div>
            <!-- Card -->
            <div class="row">
                <div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
                    <div class="widget-card widget-bg1">
                        <div class="wc-item">
                            <h4 class="wc-title">
                                Enrolled Student
                            </h4>
                            <span class="wc-des">
                                Total Number of Students
                            </span>
                            <span class="wc-stats">
                                <span class="counter"><?= $enrolledStudentsCount ?></span>
                            </span>
                            <div class="progress wc-progress">
                                <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
                    <div class="widget-card widget-bg2">
                        <div class="wc-item">
                            <h4 class="wc-title">
                                Total Courses
                            </h4>
                            <span class="wc-des">
                                Number of available Courses
                            </span>
                            <span class="wc-stats">
                                <span class="counter"><?= $coursesCount ?></span>
                            </span>
                            <!-- <span class="wc-stats counter">
                            </span> -->
                            <div class="progress wc-progress">
                                <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
                    <div class="widget-card widget-bg3">
                        <div class="wc-item">
                            <h4 class="wc-title">
                                Active Courses
                            </h4>
                            <span class="wc-des">
                                Courses You Are Teaching
                            </span>
                            <span class="wc-stats counter">
                                <?= $activeCoursesCount ?>
                            </span>
                            <div class="progress wc-progress">
                                <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
                    <div class="widget-card widget-bg4">
                        <div class="wc-item">
                            <h4 class="wc-title">
                                
                            </h4>
                            <span class="wc-des">
                                Joined New User
                            </span>
                            <span class="wc-stats counter">
                                350
                            </span>
                            <div class="progress wc-progress">
                                <div class="progress-bar" role="progressbar" style="width: 90%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="wc-progress-bx">
                                <span class="wc-change">
                                    Change
                                </span>
                                <span class="wc-number ml-auto">
                                    90%
                                </span>
                            </span>
                        </div>
                    </div>
                </div> -->
            </div>
            <!-- Card END -->
            <div class="row">
                <div class="col-lg-6 m-b30">
                    <div class="widget-box">
                        <div class="wc-title">
                            <h4>Your Courses</h4>
                        </div>
                        <div class="widget-inner">
                            <div class="new-user-list">
                                <ul>
                                    <?php
                                    $coursesForTeacher = $courses->getAllCoursesForTeacher($teacher_id);
                                    foreach ($coursesForTeacher as $course):
                                    ?>
                                        <li>
                                            <span class="new-users-pic">
                                                <img src="" alt="" />
                                            </span>
                                            <span class="new-users-text">
                                                <a href="#" class="new-users-name"><?= $course['title'] ?></a>
                                                <span class="new-users-info">categorie: <?= $course['ctg_name'] ?></span>
                                                <br>
                                                <a href="#" class="new-users-info">status: <?= $course['status'] ?></a>
                                            </span>
                                            <span class="new-users-btn">
                                                <a href="mod_course.php?course_id=<?= $course['id'] ?>" class="btn button-sm green">Modify</a>
                                            </span>
                                            <form action="" method="POST">
                                                <input type="hidden" name="action" value="delete_course">
                                                <input type="hidden" name="id" value="<?= $course['id'] ?>">
                                                <button type="submit" class="btn button-sm red m-1">Delete</button>
                                            </form>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 m-b30">
                    <div class="widget-box">
                        <div class="wc-title">
                            <h4>Users enrolled</h4>
                        </div>
                        <div class="widget-inner">
                            <div class="orders-list">
                                <ul class="list-unstyled">
                                    <?php
                                    $teacherModal = new Teacher(null, null, null, null, null);
                                    $enrolledUsers = $teacherModal->displayEnrolledUsers($teacher_id);
                                    if (!empty($enrolledUsers)) {
                                        foreach ($enrolledUsers as $user):
                                    ?>
                                            <li class="border-bottom py-3">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-grow-1">
                                                        <h5 class="mb-1">User Name: <?= htmlspecialchars($user->getUsername()) ?></h5>
                                                        <div class="text-muted small">
                                                            <span class="me-3">Email: <?= htmlspecialchars($user->getEmail()) ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                    <?php
                                        endforeach;
                                    } else {
                                        echo '<li class="py-3">No users enrolled in your courses.</li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="ttr-overlay"></div>

    <!-- External JavaScripts -->
    <script src="../assets/assets/js/jquery.min.js"></script>
    <script src="../assets/assets/vendors/bootstrap/js/popper.min.js"></script>
    <script src="../assets/assets/vendors/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="../assets/assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
    <script src="../assets/assets/vendors/magnific-popup/magnific-popup.js"></script>
    <script src="../assets/assets/vendors/counter/waypoints-min.js"></script>
    <script src="../assets/assets/vendors/counter/counterup.min.js"></script>
    <script src="../assets/assets/vendors/imagesloaded/imagesloaded.js"></script>
    <script src="../assets/assets/vendors/masonry/masonry.js"></script>
    <script src="../assets/assets/vendors/masonry/filter.js"></script>
    <script src="../assets/assets/vendors/owl-carousel/owl.carousel.js"></script>
    <script src='../assets/assets/vendors/scroll/scrollbar.min.js'></script>
    <script src="../assets/assets/js/functions.js"></script>
    <script src="../assets/assets/vendors/chart/chart.min.js"></script>
    <script src="../assets/assets/js/admin.js"></script>
    <script src='../assets/assets/vendors/calendar/moment.min.js'></script>
    <script src='../assets/assets/vendors/calendar/fullcalendar.js'></script>
    <script src='../assets/assets/vendors/switcher/switcher.js'></script>
    <script>
        $(document).ready(function() {

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listWeek'
                },
                defaultDate: '2019-03-12',
                navLinks: true, // can click day/week names to navigate views

                weekNumbers: true,
                weekNumbersWithinDays: true,
                weekNumberCalculation: 'ISO',

                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: [{
                        title: 'All Day Event',
                        start: '2019-03-01'
                    },
                    {
                        title: 'Long Event',
                        start: '2019-03-07',
                        end: '2019-03-10'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: '2019-03-09T16:00:00'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: '2019-03-16T16:00:00'
                    },
                    {
                        title: 'Conference',
                        start: '2019-03-11',
                        end: '2019-03-13'
                    },
                    {
                        title: 'Meeting',
                        start: '2019-03-12T10:30:00',
                        end: '2019-03-12T12:30:00'
                    },
                    {
                        title: 'Lunch',
                        start: '2019-03-12T12:00:00'
                    },
                    {
                        title: 'Meeting',
                        start: '2019-03-12T14:30:00'
                    },
                    {
                        title: 'Happy Hour',
                        start: '2019-03-12T17:30:00'
                    },
                    {
                        title: 'Dinner',
                        start: '2019-03-12T20:00:00'
                    },
                    {
                        title: 'Birthday Party',
                        start: '2019-03-13T07:00:00'
                    },
                    {
                        title: 'Click for Google',
                        url: 'http://google.com/',
                        start: '2019-03-28'
                    }
                ]
            });

        });
    </script>
</body>

<!-- Mirrored from educhamp.themetrades.com/demo/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:09:05 GMT -->

</html>