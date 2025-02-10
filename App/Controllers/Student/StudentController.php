<?php

namespace App\Controllers\Student;

use App\Model\CourseService\CourseService;
use App\Model\Category\Category;
use App\Model\Course\ConcreteCourse;


class StudentController
{
    private $courseService;
    private $student;

    public function __construct()
    {
        $courseModel = new ConcreteCourse();
        $categoryModel = new Category();
        $this->courseService = new CourseService($courseModel, $categoryModel);
    }

    public function index()
    {
        require_once __DIR__ . '/../../Core/Includes/session_check.php';

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
            header("Location: Student/search=" . urlencode($keywords));
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

        require_once __DIR__ . '/../../Views/studentCourses.php';
    }

    public function renderDetailsView($data) 
        {
            extract($data);

            require_once __DIR__ . '/../../Views/studentCourse_details.php';
        }

    public function showCourseDetails($id)
    {
        require_once __DIR__ . '/../../Core/Includes/session_check.php';

        $id = intval($id);
        $course_id = $id;
        $student_id = $_SESSION['user_id'] ?? null;

        $is_enrolled = $this->student->isEnrolled($student_id, $course_id);

        if (isset($_POST['course_id'])) {
            $course_id = $_POST['course_id'];
            $student_id = $_SESSION['user_id'];

            $enrolled = $this->student->enroll($student_id, $course_id);

            if ($enrolled) {
                $_SESSION['enrollment_success'] = true;
            } else {
                $_SESSION['enrollment_error'] = "Enrollment failed. Please try again.";
            }

            header("Location: courseContent.php?course_id=" . $course_id);
            exit();
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

        $course = $this->courseService->getCourseById($course_id);

        $keywords = $_GET['keywords'] ?? '';
        if (!empty($keywords)) {
            header("Location: studentCourses.php?search=" . urlencode($keywords));
            exit();
        }

        

        $this->renderDetailsView([
            'course' => $course,
            'is_enrolled' => $is_enrolled,
            'course_id' => $course_id,
        ]);
    }

}
