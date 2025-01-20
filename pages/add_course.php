<?php
require_once '../config/database.php';
require_once '../classes/admin/course.php';
require_once '../classes/admin/documentCourse.php';
require_once '../classes/admin/videoCourse.php';
require_once '../classes/admin/category.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$title = $_POST['title'];
	$description = $_POST['description'];
	$content = $_POST['content'];
	$teacher_id = $_SESSION['user_id'];
	$category_id = $_POST['category_id'];
	$type = $_POST['type'];

	if ($type === 'Video') {
		$video_link = $_POST['video_link'];
		$course = new VideoCourse($title, $description, $content, $video_link, $teacher_id, $category_id, $duration, $language, $skill_level, $course_bnr, $certification = null);
	} else {
		$document_link = $_POST['document_link'];
		$course = new DocumentCourse($title, $description, $content, $document_link, $teacher_id, $category_id);
	}

	$courseId = $course->save();
	if ($courseId) {
		echo "Course saved successfully with ID: $courseId";
	} else {
		echo "Failed to save course.";
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from educhamp.themetrades.com/demo/admin/add-listing.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:09:05 GMT -->

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
				<h4 class="breadcrumb-title">Add listing</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
					<li>Add listing</li>
				</ul>
			</div>
			<div class="row">
				<!-- Your Profile Views Chart -->
				<div class="col-lg-12 m-b30">
					<div class="widget-box">
						<div class="wc-title">
							<h4>Add Listing</h4>
						</div>
						<div class="widget-inner">
							<form class="edit-profile m-b30" method="POST">
								<div class="row">
									<div class="col-12">
										<div class="ml-auto">
											<h3>Basic Info</h3>
										</div>
									</div>
									<div class="form-group col-6">
										<label class="col-form-label">Course Title</label>
										<div>
											<input class="form-control" type="text" name="title" value="">
										</div>
									</div>
									<div class="form-group col-6">
										<label class="col-form-label">Course Banner</label>
										<div>
											<input class="form-control" type="text" name="course_bnr" value="">
										</div>
									</div>
									<div class="form-group col-6">
										<label class="col-form-label">Skill Level</label>
										<div>
											<select class="form-control" name="skill_level">
												<option value="beginner">Beginner</option>
												<option value="intermediate">Intermediate</option>
												<option value="advanced">Advanced</option>
											</select>
										</div>
									</div>
									<div class="form-group col-6">
										<label class="col-form-label">Category</label>
										<div>
											<select class="form-control" name="category_id">
												<?php
												$categories = new Category();
												$selectedCtgs = $categories->getAllCategories();
												foreach ($selectedCtgs as $ctg):
												?>
													<option value="<?= $ctg['id'] ?>"><?= $ctg['name'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group col-6">
										<label class="col-form-label">Language</label>
										<div>
											<input class="form-control" type="text" name="language" value="">
										</div>
									</div>
									<div class="form-group col-6">
										<label class="col-form-label">Duration</label>
										<div>
											<input class="form-control" type="time" name="duration" value="">
										</div>
									</div>
									<div class="form-group col-6">
										<label class="col-form-label">Type</label>
										<div>
											<select class="form-control" name="type">
												<option value="Video">Video</option>
												<option value="document">Document</option>
											</select>
										</div>
									</div>
									<div class="form-group col-6">
										<label class="col-form-label">Certification</label>
										<div>
											<input class="form-control" type="text" name="certification" value="">
										</div>
									</div>
									<div class="seperator"></div>

									<div class="col-12 m-t20">
										<div class="ml-auto m-b5">
											<h3>Description</h3>
										</div>
									</div>
									<div class="form-group col-12">
										<label class="col-form-label">Course Description</label>
										<div>
											<textarea class="form-control" name="description"></textarea>
										</div>
									</div>
									<div class="form-group col-12">
										<label class="col-form-label">Content</label>
										<div>
											<textarea class="form-control" name="content"></textarea>
										</div>
									</div>
									<div class="form-group col-12">
										<label class="col-form-label">Document Link</label>
										<div>
											<input class="form-control" type="text" name="document_link" value="">
										</div>
									</div>
									<div class="form-group col-12">
										<label class="col-form-label">Video Link</label>
										<div>
											<input class="form-control" type="text" name="video_link" value="">
										</div>
									</div>
									<div class="col-12">
										<button type="submit" class="btn">Add Course</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- Your Profile Views Chart END-->
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
	<script src='../assets/assets/vendors/switcher/switcher.js'></script>
</body>

<!-- Mirrored from educhamp.themetrades.com/demo/admin/add-listing.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:09:05 GMT -->

</html>