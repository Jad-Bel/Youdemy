<?php

namespace App\Controllers\Course;

use App\Model\CourseService\CourseService;
use App\Model\Course\ConcreteCourse;
use App\Model\Course\DocumentCourse;
use App\Model\Course\VideoCourse;
use App\Model\Category\Category;

class CourseController
{
    private $courseService;
    private $categoryModel;
    private $videoCourse;
    private $documentCourse;
    public function __construct()
    {
        $this->courseService = new CourseService(new ConcreteCourse(), new Category());
        $this->categoryModel = new Category();
        $this->videoCourse = new VideoCourse(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL,  NULL, NULL,  NULL);
        $this->documentCourse = new DocumentCourse(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL,);
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

        require_once __DIR__ . '/../../views/courses.php';
    }

    public function show($id)
    {
        if (isset($_GET['id'])) {
            $courseId = intval($_GET['id']);
        } else {
            die("Course ID is missing.");
        }

        $course = $this->courseService->getCourseById($courseId);



        if (!$course) {
            header("HTTP/1.0 404 Not Found");
            echo "Course not found";
            return;
        }

        require_once __DIR__ . '/../../views/course-details.php';
    }

    public function display($id)
    {
        $course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : null;

        $courseContent = $this->videoCourse->displayContent($course_id);

        if (!$courseContent) {
            $courseContent = $this->documentCourse->displayContent($course_id);
        }

        if ($courseContent) {
            $videoLink = $courseContent['video_link'] ?? null;
            $documentLink = $courseContent['document_link'] ?? null;
        } else {
            $videoLink = null;
            $documentLink = null;
        }

        require_once __DIR__ . '/../../Views/course_details.php';
    }
}
