<?php 

namespace App\Controllers\Student;

use App\Model\CourseService\CourseService;
use App\Model\Course\ConcreteCourse;
use App\Model\Category\Category;
use App\Model\Student\Student;


class StudentController 
{
    private $courseService;
    private $categoryModel;

    public function __construct () 
    {
        require_once __DIR__ . '/../../Core/Includes/session_check.php';

        $this->courseService = new CourseService(new ConcreteCourse(), new Category());
        $this->categoryModel = new Category();
    }

    public function index()
    {
        print_r($_SESSION);
        $courses = $this->courseService->getAllApprovedCourses();
        $categories = $this->categoryModel->getPopularCategories();

        require_once __DIR__ . '/../../Views/studentIndex.php';
    }

}