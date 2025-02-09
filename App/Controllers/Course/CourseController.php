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
    private $courseModel;
    private $videoCourse;
    private $documentCourse;
    public function __construct()
    {
        $this->courseModel = new ConcreteCourse(null, null, null, null, null, null, null, null, null, null, null);
        $this->categoryModel = new Category();
        $this->courseService = new CourseService($this->courseModel, new Category());
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
        $courses = isset($paginationData['courses']) && is_array($paginationData['courses']) ? $paginationData['courses'] : [];
        $totalPages = $paginationData['totalPages'];
        $currentPage = $paginationData['currentPage'];
        // echo "<pre>";
        // print_r($paginationData);
        // echo "</pre>";
        // print_r($courses);
        // echo "<pre>";
        // // print_r($paginationData);
        // // echo "</pre>";

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

        require_once __DIR__ . '/../../Views/courses.php';
    }

    private function renderContent($data)
    {
        extract($data);

        require_once __DIR__ . '/../../Views/courseContent.php';
    }

    public function show($id)
    {
        $id = intval($id);
        $course_id = $id;
        if (!isset($id) || empty($id)) {
            die("Course ID is missing.");
        }

        $course = $this->courseService->getCourseById($course_id);

        if (!$course) {
            header("HTTP/1.0 404 Not Found");
            echo "Course not found";
            return;
        }

        require_once __DIR__ . '/../../views/course_details.php';
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

    public function add()
    {
        require_once __DIR__ . '/../../Core/Includes/session_check.php';

        $categories = new Category();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $content = $_POST['content'];
            $teacher_id = $_SESSION['user_id'];
            $category_id = $_POST['category_id'];
            $type = $_POST['type'];
            $duration = $_POST['duration'];
            $language = $_POST['language'];
            $skill_level = $_POST['skill_level'];
            $course_bnr = $_POST['course_bnr'];
            $certification = $_POST['certification'];

            if ($type === 'Video') {
                $video_link = $_POST['video_link'];
                $course = new VideoCourse(
                    $title,
                    $description,
                    $content,
                    $video_link,
                    $teacher_id,
                    $category_id,
                    $duration,
                    $language,
                    $skill_level,
                    $course_bnr,
                    'pending',
                    $certification
                );
            } else {
                $document_link = $_POST['document_link'];
                $course = new DocumentCourse(
                    $title,
                    $description,
                    $content,
                    $document_link,
                    $teacher_id,
                    $category_id,
                    $duration,
                    $language,
                    $skill_level,
                    $course_bnr,
                    'pending',
                    $certification
                );
            }

            $courseId = $course->save();

            if (!empty($courseId)) {
                $_SESSION['course_success'] = true;
            } else {
                $_SESSION['course_error'] = "Course Insertion failed. Please try again.";
            }

            header("Location: add_course");
            exit();
        }

        if (isset($_SESSION['course_success']) && $_SESSION['course_success']) {
            echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Success!",
                    text: "Course has been added successfully.",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            });
            </script>
            ';
            unset($_SESSION['course_success']);
        }

        if (isset($_SESSION['course_error'])) {
            echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Error!",
                    text: "' . $_SESSION['course_error'] . '",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            });
            </script>
            ';
            unset($_SESSION['course_error']);
        }
        require_once __DIR__ . '/../../Views/add_course.php';
    }

    public function mod($id)
    {
        $id = intval($id);
        $course_id = $id;
        if ($course_id) {
            $course = $this->courseService;
            $courseData = $course->getCourseById($course_id);
        }

        require_once __DIR__ . '/../../Core/Includes/session_check.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $content = $_POST['content'];
            $teacher_id = $_SESSION['user_id'];
            $category_id = $_POST['category_id'];
            $type = $_POST['type'];
            $duration = $_POST['duration'];
            $language = $_POST['language'];
            $skill_level = $_POST['skill_level'];
            $course_bnr = $_POST['course_bnr'];
            $certification = $_POST['certification'];
            $stauts = $_POST['status'];

            if ($type === 'Video') {
                $video_link = $_POST['video_link'];
                $course = new VideoCourse(
                    $title,
                    $description,
                    $content,
                    $video_link,
                    $teacher_id,
                    $category_id,
                    $duration,
                    $language,
                    $skill_level,
                    $course_bnr,
                    $status,
                    $certification
                );
                $courseId = $course->modify(
                    $course_id,
                    $title,
                    $description,
                    $content,
                    $video_link,
                    $teacher_id,
                    $category_id,
                    $duration,
                    $language,
                    $skill_level,
                    $course_bnr,
                    $status,
                    $certification
                );

                if (!empty($courseId)) {
                    $_SESSION['course_success'] = true;
                } else {
                    $_SESSION['course_error'] = "Course Insertion failed. Please try again.";
                }

                header("Location: teacher");
                exit();
            } else {
                $document_link = $_POST['document_link'];
                $course = new DocumentCourse(
                    $title,
                    $description,
                    $content,
                    $document_link,
                    $teacher_id,
                    $category_id,
                    $duration,
                    $language,
                    $skill_level,
                    $status,
                    $course_bnr,
                    $certification
                );
                $courseId = $course->modify(
                    $course_id,
                    $title,
                    $description,
                    $content,
                    $document_link,
                    $teacher_id,
                    $category_id,
                    $duration,
                    $language,
                    $skill_level,
                    $status,
                    $course_bnr,
                    $certification
                );

                if (!empty($courseId)) {
                    $_SESSION['course_success'] = true;
                } else {
                    $_SESSION['course_error'] = "Course Insertion failed. Please try again.";
                }

                header("Location: teacher");
                exit();
            }
        }

        if (isset($_SESSION['course_success']) && $_SESSION['course_success']) {
            echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Success!",
                    text: "Course has been added successfully.",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            });
            </script>
            ';
            unset($_SESSION['course_success']);
        }

        if (isset($_SESSION['course_error'])) {
            echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Error!",
                    text: "' . $_SESSION['course_error'] . '",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            });
            </script>
            ';
            unset($_SESSION['course_error']);
        }
        require_once __DIR__ . '/../../Views/add_course.php';
    }

    public function content($id)
    {   
        $id = intval($id);
        $course_id = $id;
        
        if ($course_id <= 0) {
            die("ID de cours invalide !");
        }

        $videoCourse = $this->videoCourse;
        $documentCourse = $this->documentCourse;
        
        $courseContent = $videoCourse->displayContent($course_id);

        if (!$courseContent) {
            $courseContent = $documentCourse->displayContent($course_id);
        }

        $videoLink = $courseContent['video_link'] ?? null;
        $documentLink = $courseContent['document_link'] ?? null;


        $this->renderContent([
            'course_id' => $course_id,
            'videoLink' => $videoLink,
            'documentLink' => $documentLink,
        ]);
    }
}
