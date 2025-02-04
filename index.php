<?php
// require __DIR__ . '/vendor/autoload.php';

// use App\Core\Router\Router;

// $router = new Router();

// $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// $basePath = '/youdemy';
// if (strpos($requestUri, $basePath) === 0) {
//     $requestUri = substr($requestUri, strlen($basePath));
// }

// $router->dispatch($requestUri);

require __DIR__ . '/vendor/autoload.php';

use App\Core\Router\Router;

$router = new Router();

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$basePath = '/youdemy';
if (strpos($requestUri, $basePath) === 0) {
    $requestUri = substr($requestUri, strlen($basePath));
    var_dump($requestUri);
}

$router->add('/', 'App\Controllers\HomeController@index');
$router->add('/courses', 'App\Controllers\Course\CourseController@index');
$router->add('/courses/{id}', 'App\Controllers\Course\CourseController@show');
$router->add('/about', 'App\Controllers\PageController@about');

$router->dispatch($requestUri);

// use App\Controller\Course\CourseController;
// use App\Modal\CourseService\CourseService;
// use App\Modal\Category\Category;
// use Youco\Youdemy\App\Course\ConcreteCourse;
// use Youco\Youdemy\App\CourseService\CourseService;

// $courseModal = new concreteCourse(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
// $courseService = new courseService($courseModal, null);

// $keywords = $_GET['keywords'] ?? '';

// if (!empty($keywords)) {
// 	header("Location: courses.php?search=" . urlencode($keywords));
// 	exit();
// }

