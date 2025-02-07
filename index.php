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
// use App\Controllers\Admin\AdminController;

$router = new Router();

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$basePath = '/youdemy';
if (strpos($requestUri, $basePath) === 0) {
    $requestUri = substr($requestUri, strlen($basePath));
}

$router->add('/', 'App\Controllers\Home\HomeController@index');

$router->add('/courses', 'App\Controllers\Course\CourseController@index');
$router->add('/courses/id={id}', 'App\Controllers\Course\CourseController@show');
$router->add('/add_course', 'App\Controllers\Course\CourseController@add');

$router->add('/studentCourses', 'App\Controllers\Course\CourseController@index');
$router->add('/studentCourse/id={id}', 'App\Controllers\Course\CourseController@show');
$router->add('/studentCourse_details/id={id}', 'App\Controllers\Course\CourseController@display');

$router->add('/Teacher', 'App\Controllers\Teacher\TeacherController@index');
$router->add('/Student', 'App\Controllers\Student\StudentController@index');
$router->add('/admin', 'App\Controllers\Admin\AdminController@dashboard');

$router->add('/admin/handle-post', 'App\Controllers\Admin\AdminController@handlePostRequest');

$router->add('/login', 'App\Controllers\Auth\AuthController@handleLogin');
$router->add('/register', 'App\Controllers\Auth\AuthController@handleRegister');
$router->add('/logout', 'App\Controllers\Auth\AuthController@handleLogout');


// $adminController = new AdminController();

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $adminController->handlePostRequest();
// } else {
//     $adminController->dashboard();
// }
$router->dispatch($requestUri);

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

