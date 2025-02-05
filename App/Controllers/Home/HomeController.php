<?php

namespace App\Controllers\Home;

use App\Model\CourseService\CourseService;
use App\Model\Category\Category;
use App\Model\Course\ConcreteCourse;


class HomeController
{
    protected $courseService;
    protected $categoryModel;

    public function __construct()
    {
        // echo "<br> Checking if CourseService class exists...";
        // if (!class_exists('App\Modal\CourseService\CourseService')) {
        //     throw new \Exception("<br> CourseService class not found.");
        // }
    
        // echo "<br> Instantiating CourseService...<br>";
        $this->courseService = new CourseService(new ConcreteCourse(), new Category());
        $this->categoryModel = new Category();
    }

    public function index()
    {
        $courses = $this->courseService->getAllApprovedCourses();
        $categories = $this->categoryModel->getPopularCategories();

        require_once __DIR__ . '/../../Views/home.php';
    }
}
