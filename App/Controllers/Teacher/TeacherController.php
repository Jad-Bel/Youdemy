<?php

namespace App\Controllers\Teacher;

use App\Model\Course\ConcreteCourse;
use App\Model\CourseService\CourseService;
use App\Model\Teacher\Teacher;

class TeacherController
{
    private $courseModal;
    private $courses;
    private $teacher;

    public function __construct()
    {
        require_once __DIR__ . '/../../Core/Includes/session_check.php';
        
        $this->courseModal = new ConcreteCourse();
        $this->courses = new CourseService($this->courseModal, null);
        $this->teacher = new Teacher(null, null, null, null, null, null);
    }

    public function index()
    {
        $teacher_id = $_SESSION['user_id'];

        if (empty($teacher_id)) {
            die("Teacher ID not found in session.");
        }

        $coursesForTeacher = $this->courses->getAllCoursesForTeacher($teacher_id);

        // $statistics = $this->teacher->getStatistics($teacher_id);

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

        $enrolledUsers = $this->teacher->displayEnrolledUsers($teacher_id);

        require_once __DIR__ . '/../../Views/teacherDash.php';
    }
}