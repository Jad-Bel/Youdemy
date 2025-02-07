<?php

namespace App\Controllers\Teacher;

use App\Model\Course\ConcreteCourse;
use App\Model\CourseService\CourseService;
use App\Model\Category\Category;
use App\Model\Teacher\Teacher;

class TeacherController
{
    private $courseModal;
    private $courses;
    private $categoryModal;
    private $teacherModal;

    public function __construct()
    {
        require_once __DIR__ . '/../../Core/Includes/session_check.php';

        $this->courseModal = new ConcreteCourse();
        $this->categoryModal = new Category();
        $this->courses = new CourseService($this->courseModal, $this->categoryModal);
        $this->teacherModal = new Teacher($_SESSION['user_id'], $_SESSION['username'], $_SESSION['email'], null, $_SESSION['role'], $_SESSION['status']);

    }

    public function index()
    {
        $teacher_id = $_SESSION['user_id'];

        if (empty($teacher_id)) {
            die("Teacher ID not found in session.");
        }

        $coursesForTeacher = $this->courses->getAllCoursesForTeacher($teacher_id);

        // $statistics = $this->teacherModal->getStatistics($teacher_id);

        // $enrolledStudentsCount = $statistics[0]->count;
        // $coursesCount = $statistics[1]->count;
        // $approvedCoursesCount = $statistics[2]->count;
        // $averageStudentPerCourse = $statistics[3]->count;

        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['action']) && $_POST['action'] == 'delete_course') {
            $course_id = $_POST['id'];
            $this->courseModal->delete($course_id);
            header("Location: Teacher");
            exit();
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $id = $_SESSION['id'] ?? null;
            $username = $_SESSION['username'] ?? null;
            $email = $_SESSION['email'] ?? null;
            $password = null;
            $role = $_SESSION['role'] ?? null;
            $status = $_SESSION['status'] ?? null;
            
            $enrolledUsers = $this->teacherModal->displayEnrolledUsers($teacher_id);
        }


        require_once __DIR__ . '/../../Views/teacherDash.php';
    }
}
