<?php

namespace App\Controller\StudentCourse;

use App\Model\CourseService\CourseService;
use App\Model\Category\Category;
use App\Model\Course\ConcreteCourse;

class StudentCoursesController
{
    private $courseService;

    public function __construct()
    {
        $courseModel = new ConcreteCourse();
        $categoryModel = new Category();
        $this->courseService = new CourseService($courseModel, $categoryModel);
    }

    public function index()
    {
        require_once '../includes/session_check.php';

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 5;
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $categoryId = isset($_GET['id']) ? $_GET['id'] : null;

        $paginationData = $this->courseService->getPaginatedCourses($page, $perPage, $search, $categoryId);
        $courses = $paginationData['courses'];
        $totalPages = $paginationData['totalPages'];
        $currentPage = $paginationData['currentPage'];

        $categories = Category::getPopularCategories();

        $keywords = $_GET['keywords'] ?? '';
        if (!empty($keywords)) {
            header("Location: studentCourses.php?search=" . urlencode($keywords));
            exit();
        }

        $this->renderView([
            'courses' => $courses,
            'totalPages' => $totalPages,
            'currentPage' => $currentPage,
            'categories' => $categories,
            'search' => $search,
            'categoryId' => $categoryId,
        ]);
    }

    private function renderView($data)
    {
        extract($data);

        require_once '../path/to/your/view/studentCourses.php';
    }
}