<?php
require_once '../includes/session_check.php';
require_once '../config/database.php';
require_once '../classes/admin/courseService.php';
require_once '../classes/admin/course.php';
require_once '../classes/admin/auth.php';

if (isset($_GET['id'])) {
	$courseId = intval($_GET['id']);
} else {
	die("Course ID is missing.");
}
$courseModal = new ConcreteCourse($courseId, NULL, NULL, NULL, NULL, NULL);
$courseService = new CourseService(NULL, NULL);
$course = $courseService->getCourseById($courseId);

if (isset($_POST['id'])) {
    $course_id = $_POST['id'];
    $student_id = $_SESSION['id'];

    $student = new Student(null, null, null, null, null);

    $enrolled = $student->enroll($student_id, $course_id);

    if ($enrolled) {
        $_SESSION['enrollment_success'] = true;
    } else {
        $_SESSION['enrollment_error'] = "Enrollment failed. Please try again.";
    }

    header("Location: course-details.php?course_id=" . $course_id);
    exit();
} else {
    $_SESSION['enrollment_error'] = "Course is missing.";
    // header("Location: studentourse.php");
    // exit();
}    

if (isset($_SESSION['enrollment_success']) && $_SESSION['enrollment_success']) {
    echo '
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            title: "Success!",
            text: "You have been enrolled successfully.",
            icon: "success",
            confirmButtonText: "OK"
        });
    });
    </script>
    ';
    unset($_SESSION['enrollment_success']);
}

if (isset($_SESSION['enrollment_error'])) {
    echo '
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            title: "Error!",
            text: "' . $_SESSION['enrollment_error'] . '",
            icon: "error",
            confirmButtonText: "OK"
        });
    });
    </script>
    ';
    unset($_SESSION['enrollment_error']);
}

// if (!$course) {
// 	die("Course not found.");
// }
// function dd(...$var) {
//     foreach ($var as $elem) {
//         echo '<pre class="codespan">';
//         echo '<code>';
//         !$elem || $elem == '' ? var_dump($elem) : print_r($elem);
//         echo '</code>';
//         echo '</pre>';
//     }

//     die();
// }
// dd($course);
?>

<!DOCTYPE html>
<html lang="en">

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
	<link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon.png" />

	<!-- PAGE TITLE HERE ============================================= -->
	<title>EduChamp : Education HTML Template </title>

	<!-- MOBILE SPECIFIC ============================================= -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.min.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->

	<!-- All PLUGINS CSS ============================================= -->
	<link rel="stylesheet" type="text/css" href="../assets/css/assets.css">

	<!-- TYPOGRAPHY ============================================= -->
	<link rel="stylesheet" type="text/css" href="../assets/css/typography.css">

	<!-- SHORTCODES ============================================= -->
	<link rel="stylesheet" type="text/css" href="../assets/css/shortcodes/shortcodes.css">

	<!-- STYLESHEETS ============================================= -->
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<link class="skin" rel="stylesheet" type="text/css" href="assets/css/color/color-1.css">

</head>

<body id="bg">
	<div class="page-wraper">
		<div id="loading-icon-bx"></div>
		<!-- Header Top ==== -->
		<header class="header rs-nav">
			<div class="top-bar">
				<div class="container">
					<div class="row d-flex justify-content-between">
						<div class="topbar-left">
							<ul>
								<li><a href="faq-1.html"><i class="fa fa-question-circle"></i>Ask a Question</a></li>
								<li><a href="javascript:;"><i class="fa fa-envelope-o"></i>Support@website.com</a></li>
							</ul>
						</div>
						<div class="topbar-right">
							<ul>
								<li><a href="logout.php">log-out</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="sticky-header navbar-expand-lg">
				<div class="menu-bar clearfix">
					<div class="container clearfix">
						<!-- Header Logo ==== -->
						<div class="menu-logo">
							<a href="index.html"><img src="assets/images/logo.png" alt=""></a>
						</div>
						<!-- Mobile Nav Button ==== -->
						<button class="navbar-toggler collapsed menuicon justify-content-end" type="button"
							data-toggle="collapse" data-target="#menuDropdown" aria-controls="menuDropdown"
							aria-expanded="false" aria-label="Toggle navigation">
							<span></span>
							<span></span>
							<span></span>
						</button>
						<!-- Author Nav ==== -->
						<div class="secondary-menu">
							<div class="secondary-inner">
								<ul>
									<li><a href="javascript:;" class="btn-link"><i class="fa fa-facebook"></i></a></li>
									<li><a href="javascript:;" class="btn-link"><i class="fa fa-google-plus"></i></a>
									</li>
									<li><a href="javascript:;" class="btn-link"><i class="fa fa-linkedin"></i></a></li>
									<!-- Search Button ==== -->
									<li class="search-btn"><button id="quik-search-btn" type="button"
											class="btn-link"><i class="fa fa-search"></i></button></li>
								</ul>
							</div>
						</div>
						<!-- Search Box ==== -->
						<div class="nav-search-bar">
							<form action="#">
								<input name="search" value="" type="text" class="form-control"
									placeholder="Type to search">
								<span><i class="ti-search"></i></span>
							</form>
							<span id="search-remove"><i class="ti-close"></i></span>
						</div>
						<!-- Navigation Menu ==== -->
						<div class="menu-links navbar-collapse collapse justify-content-start" id="menuDropdown">
							<div class="menu-logo">
								<a href="index.html"><img src="assets/images/logo.png" alt=""></a>
							</div>
							<ul class="nav navbar-nav">
								<li class="active"><a href="javascript:;">Home <i class="fa fa-chevron-down"></i></a>
									<ul class="sub-menu">
										<li><a href="index.html">Home 1</a></li>
										<li><a href="index-2.html">Home 2</a></li>
									</ul>
								</li>
								<li><a href="javascript:;">Pages <i class="fa fa-chevron-down"></i></a>
									<ul class="sub-menu">
										<li><a href="javascript:;">About<i class="fa fa-angle-right"></i></a>
											<ul class="sub-menu">
												<li><a href="about-1.html">About 1</a></li>
												<li><a href="about-2.html">About 2</a></li>
											</ul>
										</li>
										<li><a href="javascript:;">Event<i class="fa fa-angle-right"></i></a>
											<ul class="sub-menu">
												<li><a href="event.html">Event</a></li>
												<li><a href="events-details.html">Events Details</a></li>
											</ul>
										</li>
										<li><a href="javascript:;">FAQ's<i class="fa fa-angle-right"></i></a>
											<ul class="sub-menu">
												<li><a href="faq-1.html">FAQ's 1</a></li>
												<li><a href="faq-2.html">FAQ's 2</a></li>
											</ul>
										</li>
										<li><a href="javascript:;">Contact Us<i class="fa fa-angle-right"></i></a>
											<ul class="sub-menu">
												<li><a href="contact-1.html">Contact Us 1</a></li>
												<li><a href="contact-2.html">Contact Us 2</a></li>
											</ul>
										</li>
										<li><a href="portfolio.html">Portfolio</a></li>
										<li><a href="profile.html">Profile</a></li>
										<li><a href="membership.html">Membership</a></li>
										<li><a href="error-404.html">404 Page</a></li>
									</ul>
								</li>
								<li class="add-mega-menu"><a href="javascript:;">Our Courses <i
											class="fa fa-chevron-down"></i></a>
									<ul class="sub-menu add-menu">
										<li class="add-menu-left">
											<h5 class="menu-adv-title">Our Courses</h5>
											<ul>
												<li><a href="courses.php">Courses </a></li>
											</ul>
										</li>
										<li class="add-menu-right">
											<img src="assets/images/adv/adv.jpg" alt="" />
										</li>
									</ul>
								</li>
								<!-- <li><a href="javascript:;">Blog <i class="fa fa-chevron-down"></i></a>
									<ul class="sub-menu">
										<li><a href="blog-classic-grid.html">Blog Classic</a></li>
										<li><a href="blog-classic-sidebar.html">Blog Classic Sidebar</a></li>
										<li><a href="blog-list-sidebar.html">Blog List Sidebar</a></li>
										<li><a href="blog-standard-sidebar.html">Blog Standard Sidebar</a></li>
										<li><a href="blog-details.html">Blog Details</a></li>
									</ul>
								</li> -->
								<li class="nav-dashboard"><a href="javascript:;">Dashboard <i
											class="fa fa-chevron-down"></i></a>
									<ul class="sub-menu">
										<li><a href="admin/index.html">Dashboard</a></li>
										<li><a href="admin/add-listing.html">Add Listing</a></li>
										<li><a href="admin/bookmark.html">Bookmark</a></li>
										<li><a href="admin/courses.html">Courses</a></li>
										<li><a href="admin/review.html">Review</a></li>
										<li><a href="admin/teacher-profile.html">Teacher Profile</a></li>
										<li><a href="admin/user-profile.html">User Profile</a></li>
										<li><a href="javascript:;">Calendar<i class="fa fa-angle-right"></i></a>
											<ul class="sub-menu">
												<li><a href="admin/basic-calendar.html">Basic Calendar</a></li>
												<li><a href="admin/list-view-calendar.html">List View Calendar</a></li>
											</ul>
										</li>
										<li><a href="javascript:;">Mailbox<i class="fa fa-angle-right"></i></a>
											<ul class="sub-menu">
												<li><a href="admin/mailbox.html">Mailbox</a></li>
												<li><a href="admin/mailbox-compose.html">Compose</a></li>
												<li><a href="admin/mailbox-read.html">Mail Read</a></li>
											</ul>
										</li>
									</ul>
								</li>
							</ul>
							<div class="nav-social-link">
								<a href="javascript:;"><i class="fa fa-facebook"></i></a>
								<a href="javascript:;"><i class="fa fa-google-plus"></i></a>
								<a href="javascript:;"><i class="fa fa-linkedin"></i></a>
							</div>
						</div>
						<!-- Navigation Menu END ==== -->
					</div>
				</div>
			</div>
		</header>
		<!-- header END ==== -->
		<!-- Content -->
		<div class="page-content bg-white">
			<!-- inner page banner -->
			<div class="page-banner ovbl-dark" style="background-image:url(../assets/images/banner/banner2.jpg);">
				<div class="container">
					<div class="page-banner-entry">
						<h1 class="text-white">Courses Details</h1>
					</div>
				</div>
			</div>
			<!-- Breadcrumb row -->
			<div class="breadcrumb-row">
				<div class="container">
					<ul class="list-inline">
						<li><a href="#">Home</a></li>
						<li>Courses Details</li>
					</ul>
				</div>
			</div>
			<!-- Breadcrumb row END -->
			<!-- inner page banner END -->
			<div class="content-block">
				<!-- About Us -->
				<div class="section-area section-sp1">
					<div class="container">
						<div class="row d-flex flex-row-reverse">
							<div class="col-lg-3 col-md-4 col-sm-12 m-b30">
								<div class="course-detail-bx">
									<div class="course-price">
										<del>$190</del>
										<h4 class="price">FREE</h4>
									</div>
									<div class="course-buy-now text-center">
										<form action="" method="POST">
											<input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
											<button type="submit" name="enroll" class="btn radius-xl text-uppercase">Enroll To This Course</button>
										</form>
									</div>
									<div class="teacher-bx">
										<div class="teacher-info">
											<div class="teacher-thumb">
												<img src="assets/images/testimonials/pic1.jpg" alt="" />
											</div>
											<div class="teacher-name">
												<h5><?= $course['teacher_username'] ?></h5>
												<span>Science Teacher</span>
											</div>
										</div>
									</div>
									<div class="cours-more-info">
										<div class="review">
											<span style="font-size: 17px">Created at:</span>
											<span style="font-weight: bold;"><?= $course['crs_created_at'] ?></span>
										</div>
										<div class="price categories">
											<span style="font-size: 17px">Category:</span>
											<h5 class="text-primary"><?= $course['ctg_name'] ?></h5>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-9 col-md-8 col-sm-12">
								<div class="courses-post">
									<div class="ttr-post-media media-effect">
										<a href="#"><img src="assets/images/blog/default/thum1.jpg" alt=""></a>
									</div>
									<div class="ttr-post-info">
										<div class="ttr-post-title ">
											<h2 class="post-title"><?= $course['title'] ?></h2>
										</div>
										<div class="ttr-post-text">
											<p><?= $course['cnt'] ?></p>
										</div>
									</div>
								</div>
								<div class="courese-overview" id="overview">
									<h4>Overview</h4>
									<div class="row">
										<div class="col-md-12 col-lg-4">
											<ul class="course-features">
												<li><i class="ti-time"></i> <span class="label">Duration</span> <span
														class="value"><?= $course['duration'] ?> hours</span></li>
												<li><i class="ti-stats-up"></i> <span class="label">Skill level</span>
													<span class="value"><?= $course['level'] ?></span>
												</li>
												<li><i class="ti-smallcap"></i> <span class="label">Language</span>
													<span class="value"><?= $course['language'] ?></span>
												</li>
											</ul>
										</div>
										<div class="col-md-12 col-lg-8">
											<h5 class="m-b5">Course Description</h5>
											<p><?= $course['dsc'] ?>.</p>
											<h5 class="m-b5">Certification</h5>
											<p><?= $course['certification'] ?>.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- contact area END -->

			</div>
			<!-- Content END-->
			<!-- Footer ==== -->
			<footer>
				<div class="footer-top">
					<div class="pt-exebar">
						<div class="container">
							<div class="d-flex align-items-stretch">
								<div class="pt-logo mr-auto">
									<a href="index.html"><img src="assets/images/logo-white.png" alt="" /></a>
								</div>
								<div class="pt-social-link">
									<ul class="list-inline m-a0">
										<li><a href="#" class="btn-link"><i class="fa fa-facebook"></i></a></li>
										<li><a href="#" class="btn-link"><i class="fa fa-twitter"></i></a></li>
										<li><a href="#" class="btn-link"><i class="fa fa-linkedin"></i></a></li>
										<li><a href="#" class="btn-link"><i class="fa fa-google-plus"></i></a></li>
									</ul>
								</div>
								<div class="pt-btn-join">
									<a href="#" class="btn ">Join Now</a>
								</div>
							</div>
						</div>
					</div>
					<div class="container">
						<div class="row">
							<div class="col-lg-4 col-md-12 col-sm-12 footer-col-4">
								<div class="widget">
									<h5 class="footer-title">Sign Up For A Newsletter</h5>
									<p class="text-capitalize m-b20">Weekly Breaking news analysis and cutting edge advices
										on job searching.</p>
									<div class="subscribe-form m-b20">
										<form class="subscription-form"
											action="http://educhamp.themetrades.com/demo/assets/script/mailchamp.php"
											method="post">
											<div class="ajax-message"></div>
											<div class="input-group">
												<input name="email" required="required" class="form-control"
													placeholder="Your Email Address" type="email">
												<span class="input-group-btn">
													<button name="submit" value="Submit" type="submit" class="btn"><i
															class="fa fa-arrow-right"></i></button>
												</span>
											</div>
										</form>
									</div>
								</div>
							</div>
							<div class="col-12 col-lg-5 col-md-7 col-sm-12">
								<div class="row">
									<div class="col-4 col-lg-4 col-md-4 col-sm-4">
										<div class="widget footer_widget">
											<h5 class="footer-title">Company</h5>
											<ul>
												<li><a href="index.html">Home</a></li>
												<li><a href="about-1.html">About</a></li>
												<li><a href="faq-1.html">FAQs</a></li>
												<li><a href="contact-1.html">Contact</a></li>
											</ul>
										</div>
									</div>
									<div class="col-4 col-lg-4 col-md-4 col-sm-4">
										<div class="widget footer_widget">
											<h5 class="footer-title">Get In Touch</h5>
											<ul>
												<li><a href="http://educhamp.themetrades.com/admin/index.html">Dashboard</a>
												</li>
												<li><a href="blog-classic-grid.html">Blog</a></li>
												<li><a href="portfolio.html">Portfolio</a></li>
												<li><a href="event.html">Event</a></li>
											</ul>
										</div>
									</div>
									<div class="col-4 col-lg-4 col-md-4 col-sm-4">
										<div class="widget footer_widget">
											<h5 class="footer-title">Courses</h5>
											<ul>
												<li><a href="courses.html">Courses</a></li>
												<li><a href="courses-details.html">Details</a></li>
												<li><a href="membership.html">Membership</a></li>
												<li><a href="profile.html">Profile</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="col-12 col-lg-3 col-md-5 col-sm-12 footer-col-4">
								<div class="widget widget_gallery gallery-grid-4">
									<h5 class="footer-title">Our Gallery</h5>
									<ul class="magnific-image">
										<li><a href="../assets/images/gallery/pic1.jpg" class="magnific-anchor"><img
													src="../assets/images/gallery/pic1.jpg" alt=""></a></li>
										<li><a href="../assets/images/gallery/pic2.jpg" class="magnific-anchor"><img
													src="../assets/images/gallery/pic2.jpg" alt=""></a></li>
										<li><a href="assets/images/gallery/pic3.jpg" class="magnific-anchor"><img
													src="../assets/images/gallery/pic3.jpg" alt=""></a></li>
										<li><a href="../assets/images/gallery/pic4.jpg" class="magnific-anchor"><img
													src="../assets/images/gallery/pic4.jpg" alt=""></a></li>
										<li><a href="../assets/images/gallery/pic5.jpg" class="magnific-anchor"><img
													src="../assets/images/gallery/pic5.jpg" alt=""></a></li>
										<li><a href="../assets/images/gallery/pic6.jpg" class="magnific-anchor"><img
													src="../assets/images/gallery/pic6.jpg" alt=""></a></li>
										<li><a href="../assets/images/gallery/pic7.jpg" class="magnific-anchor"><img
													src="../assets/images/gallery/pic7.jpg" alt=""></a></li>
										<li><a href="../assets/images/gallery/pic8.jpg" class="magnific-anchor"><img
													src="../assets/images/gallery/pic8.jpg" alt=""></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="footer-bottom">
					<div class="container">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 text-center"><a target="_blank"
									href="https://www.templateshub.net">Templates Hub</a></div>
						</div>
					</div>
				</div>
			</footer>
			<!-- Footer END ==== -->
			<button class="back-to-top fa fa-chevron-up"></button>
		</div>
		<!-- External JavaScripts -->
		<script src="../assets/js/jquery.min.js"></script>
		<script src="../assets/vendors/bootstrap/js/popper.min.js"></script>
		<script src="../assets/vendors/bootstrap/js/bootstrap.min.js"></script>
		<script src="../assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="../assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
		<script src="../assets/vendors/magnific-popup/magnific-popup.js"></script>
		<script src="../assets/vendors/counter/waypoints-min.js"></script>
		<script src="../assets/vendors/counter/counterup.min.js"></script>
		<script src="../assets/vendors/imagesloaded/imagesloaded.js"></script>
		<script src="../assets/vendors/masonry/masonry.js"></script>
		<script src="../assets/vendors/masonry/filter.js"></script>
		<script src="../assets/vendors/owl-carousel/owl.carousel.js"></script>
		<script src="../assets/js/jquery.scroller.js"></script>
		<script src="../assets/js/functions.js"></script>
		<script src="../assets/js/contact.js"></script>
		<script src="../assets/vendors/switcher/switcher.js"></script>
</body>

</html>