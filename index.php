<?php
require __DIR__ . '/vendor/autoload.php';


use Youco\Youdemy\App\Course\ConcreteCourse;
use Youco\Youdemy\App\CourseService\CourseService;

$courseModal = new concreteCourse(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
$courseService = new courseService($courseModal, null);

$keywords = $_GET['keywords'] ?? '';

if (!empty($keywords)) {
	header("Location: courses.php?search=" . urlencode($keywords));
	exit();
}

