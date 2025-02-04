<?php

namespace Youco\Youdemy\App\Controllers\Course;

use Youco\Youdemy\App\Modal\CourseService\CourseService;
use Youco\Youdemy\App\Modal\Category\Category;

class CourseController
{
    protected $courseService;
    protected $categoryModel;

    public function __construct(CourseService $courseService,Category $categoryModel)
    {
        $this->courseService = $courseService;
        $this->categoryModel = $categoryModel;
    }

    public function index()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 5;
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $categoryId = isset($_GET['id']) ? $_GET['id'] : null;

        $paginationData = $this->courseService->getPaginatedCourses($page, $perPage, $search, $categoryId);
        $courses = $paginationData['courses'];
        $totalPages = $paginationData['totalPages'];
        $currentPage = $paginationData['currentPage'];

        $categories = $this->categoryModel->getPopularCategories();

        require_once '../views/courses/index.php';
    }

    public function show($id)
    {
        $course = $this->courseService->getCourseById($id);

        if (!$course) {
            header("HTTP/1.0 404 Not Found");
            echo "Course not found";
            return;
        }

        require_once '../views/courses/show.php';
    }

    public function create()
    {
        require_once '../views/courses/create.php';
    }

    public function store()
    {
        $data = $_POST;
        $this->courseService->createCourse($data);

        header("Location: /courses");
    }

    public function edit($id)
    {
        $course = $this->courseService->getCourseById($id);

        if (!$course) {
            header("HTTP/1.0 404 Not Found");
            echo "Course not found";
            return;
        }

        require_once '../views/courses/edit.php';
    }

    public function update($id)
    {
        $data = $_POST;
        $this->courseService->updateCourse($id, $data);

        header("Location: /courses");
    }

    public function delete($id)
    {
        $this->courseService->deleteCourse($id);

        header("Location: /courses");
    }
}