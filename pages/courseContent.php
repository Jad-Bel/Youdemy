<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Structures & Algorithms</title>
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
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />
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
    <link rel="stylesheet" type="text/css" href="../assets/css/assets.css">

    <!-- TYPOGRAPHY ============================================= -->
    <link rel="stylesheet" type="text/css" href="../assets/css/typography.css">

    <!-- SHORTCODES ============================================= -->
    <link rel="stylesheet" type="text/css" href="../assets/css/shortcodes/shortcodes.css">

    <!-- STYLESHEETS ============================================= -->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link class="skin" rel="stylesheet" type="text/css" href="../assets/css/color/color-1.css">
    <style>
        .course-sidebar {
            background: #f8f9fa;
            height: 100vh;
            overflow-y: auto;
        }

        .video-container {
            background: #f7b205;
            aspect-ratio: 16/9;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .section-title {
            padding: 15px;
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            cursor: pointer;
        }

        .section-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .section-content.show {
            max-height: 1000px;
        }

        .lecture-item {
            padding: 10px 15px 10px 30px;
            cursor: pointer;
            border-bottom: 1px solid #e9ecef;
            transition: background-color 0.2s;
        }

        .lecture-item:hover {
            background-color: #e9ecef;
        }

        .course-tabs {
            border-bottom: 1px solid #dee2e6;
        }

        .tab-button {
            padding: 15px 20px;
            border: none;
            background: none;
            color: #6c757d;
            position: relative;
        }

        .tab-button.active {
            color: #000;
            font-weight: 500;
        }

        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: #7952b3;
        }
    </style>
</head>

<body>
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
                            <li><a href="login.php">Login</a></li>
                            <li><a href="register.php">Register</a></li>
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
                        <a href="index.html"><img src="../assets/images/logo.png" alt=""></a>
                    </div>
                    <!-- Mobile Nav Button ==== -->
                    <button class="navbar-toggler collapsed menuicon justify-content-end" type="button" data-toggle="collapse" data-target="#menuDropdown" aria-controls="menuDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <!-- Author Nav ==== -->
                    <div class="secondary-menu">
                        <div class="secondary-inner">
                            <ul>
                                <li><a href="javascript:;" class="btn-link"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="javascript:;" class="btn-link"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="javascript:;" class="btn-link"><i class="fa fa-linkedin"></i></a></li>
                                <!-- Search Button ==== -->
                                <li class="search-btn"><button id="quik-search-btn" type="button" class="btn-link"><i class="fa fa-search"></i></button></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Search Box ==== -->
                    <div class="nav-search-bar">
                        <form action="#">
                            <input name="search" value="" type="text" class="form-control" placeholder="Type to search">
                            <span><i class="ti-search"></i></span>
                        </form>
                        <span id="search-remove"><i class="ti-close"></i></span>
                    </div>
                    <!-- Navigation Menu ==== -->
                    <div class="menu-links navbar-collapse collapse justify-content-start" id="menuDropdown">
                        <div class="menu-logo">
                            <a href="index.html"><img src="../assets/images/logo.png" alt=""></a>
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
                            <li class="add-mega-menu"><a href="javascript:;">Our Courses <i class="fa fa-chevron-down"></i></a>
                                <ul class="sub-menu add-menu">
                                    <li class="add-menu-left">
                                        <h5 class="menu-adv-title">Our Courses</h5>
                                        <ul>
                                            <li><a href="courses.html">Courses </a></li>
                                            <li><a href="courses-details.html">Courses Details</a></li>
                                            <li><a href="profile.html">Instructor Profile</a></li>
                                            <li><a href="event.html">Upcoming Event</a></li>
                                            <li><a href="membership.html">Membership</a></li>
                                        </ul>
                                    </li>
                                    <li class="add-menu-right">
                                        <img src="../assets/images/adv/adv.jpg" alt="" />
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:;">Blog <i class="fa fa-chevron-down"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="blog-classic-grid.html">Blog Classic</a></li>
                                    <li><a href="blog-classic-sidebar.html">Blog Classic Sidebar</a></li>
                                    <li><a href="blog-list-sidebar.html">Blog List Sidebar</a></li>
                                    <li><a href="blog-standard-sidebar.html">Blog Standard Sidebar</a></li>
                                    <li><a href="blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li class="nav-dashboard"><a href="../javascript:;">Dashboard <i class="fa fa-chevron-down"></i></a>
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
    <div class="container-fluid">
        <div class="row">
            <!-- Main Content -->
            <div class="col-md-8 p-0">
                <!-- Video Player -->
                <div class="video-container">
                    <img src="api/placeholder/100/100" alt="Play Button" style="width: 80px; height: 80px;">
                </div>

                <!-- Course Navigation -->
                <div class="course-tabs d-flex">
                    <button class="tab-button active">Overview</button>
                    <button class="tab-button">Notes</button>
                    <button class="tab-button">Announcements</button>
                    <button class="tab-button">Reviews</button>
                    <button class="tab-button">Learning tools</button>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4 course-sidebar p-0">
                <div class="section-title" data-section="1">
                    <div class="d-flex justify-content-between">
                        <div>Section 3: Classes & Pointers</div>
                        <div class="text-muted">2/2 | 13min</div>
                    </div>
                </div>
                <div class="section-content" id="section1">
                    <div class="lecture-item">
                        <div class="d-flex justify-content-between">
                            <div>1. Introduction to Classes</div>
                            <div class="text-muted">6:30</div>
                        </div>
                    </div>
                    <div class="lecture-item">
                        <div class="d-flex justify-content-between">
                            <div>2. Working with Pointers</div>
                            <div class="text-muted">6:30</div>
                        </div>
                    </div>
                </div>

                <div class="section-title" data-section="2">
                    <div class="d-flex justify-content-between">
                        <div>Section 4: Linked Lists</div>
                        <div class="text-muted">17/17 | 1hr 19min</div>
                    </div>
                </div>
                <div class="section-content" id="section2">
                    <div class="lecture-item">
                        <div class="d-flex justify-content-between">
                            <div>1. Linked List Basics</div>
                            <div class="text-muted">7:15</div>
                        </div>
                    </div>
                    <div class="lecture-item">
                        <div class="d-flex justify-content-between">
                            <div>2. Implementing a Linked List</div>
                            <div class="text-muted">8:45</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                            <p class="text-capitalize m-b20">Weekly Breaking news analysis and cutting edge advices on job searching.</p>
                            <div class="subscribe-form m-b20">
                                <form class="subscription-form" action="http://educhamp.themetrades.com/demo/assets/script/mailchamp.php" method="post">
                                    <div class="ajax-message"></div>
                                    <div class="input-group">
                                        <input name="email" required="required" class="form-control" placeholder="Your Email Address" type="email">
                                        <span class="input-group-btn">
                                            <button name="submit" value="Submit" type="submit" class="btn"><i class="fa fa-arrow-right"></i></button>
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
                                        <li><a href="http://educhamp.themetrades.com/admin/index.html">Dashboard</a></li>
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
                                <li><a href="../assets/images/gallery/pic1.jpg" class="magnific-anchor"><img src="assets/images/gallery/pic1.jpg" alt=""></a></li>
                                <li><a href="../assets/images/gallery/pic2.jpg" class="magnific-anchor"><img src="assets/images/gallery/pic2.jpg" alt=""></a></li>
                                <li><a href="../assets/images/gallery/pic3.jpg" class="magnific-anchor"><img src="assets/images/gallery/pic3.jpg" alt=""></a></li>
                                <li><a href="../assets/images/gallery/pic4.jpg" class="magnific-anchor"><img src="assets/images/gallery/pic4.jpg" alt=""></a></li>
                                <li><a href="../assets/images/gallery/pic5.jpg" class="magnific-anchor"><img src="assets/images/gallery/pic5.jpg" alt=""></a></li>
                                <li><a href="../assets/images/gallery/pic6.jpg" class="magnific-anchor"><img src="assets/images/gallery/pic6.jpg" alt=""></a></li>
                                <li><a href="../assets/images/gallery/pic7.jpg" class="magnific-anchor"><img src="assets/images/gallery/pic7.jpg" alt=""></a></li>
                                <li><a href="../assets/images/gallery/pic8.jpg" class="magnific-anchor"><img src="assets/images/gallery/pic8.jpg" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center"> <a target="_blank" href="https://www.templateshub.net">Templates Hub</a></div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.section-title').forEach(title => {
            title.addEventListener('click', () => {
                const sectionId = title.dataset.section;
                const content = document.querySelector(`#section${sectionId}`);
                content.classList.toggle('show');
            });
        });

        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelectorAll('.tab-button').forEach(btn => {
                    btn.classList.remove('active');
                });
                button.classList.add('active');
            });
        });

        document.querySelectorAll('.lecture-item').forEach(item => {
            item.addEventListener('click', () => {
                console.log('Playing lecture:', item.querySelector('div').textContent);
            });
        });
    </script>
</body>

</html>