<?php
require __DIR__ . '/vendor/autoload.php';

// require_once __DIR__ . '/App/Core/Router/Router.php';

use App\Core\Router\Router;
use App\Controller\Course\CourseController;
use App\Modal\CourseService\CourseService;
use App\Modal\Category\Category;
echo "Router class exists: " . (class_exists(Router::class) ? 'Yes' : 'No');

$routes = [
	'courses' => ['controller' => 'Controllers\\Course\\CourseController', 'method' => 'index']
];

Router::add('courses', 'CourseController', 'index');

$url = $_GET['url'] ?? 'home';

Router::dispatch($url);

// use Youco\Youdemy\App\Course\ConcreteCourse;
// use Youco\Youdemy\App\CourseService\CourseService;

// $courseModal = new concreteCourse(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
// $courseService = new courseService($courseModal, null);

// $keywords = $_GET['keywords'] ?? '';

// if (!empty($keywords)) {
// 	header("Location: courses.php?search=" . urlencode($keywords));
// 	exit();
// }

