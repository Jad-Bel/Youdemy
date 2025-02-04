<?php

namespace App\Controllers;

use App\Modal\CourseService\CourseService;
use App\Modal\Course\ConcreteCourse;
use App\Modal\Category\Category;

class HomeController
{
    protected $courseService;
    protected $categoryModel;

    public function __construct()
    {
        $this->courseService = new CourseService(new ConcreteCourse(), new Category());
        $this->categoryModel = new Category();
    }

    public function index()
    {
        $courses = $this->courseService->getAllApprovedCourses();
        $categories = $this->categoryModel->getPopularCategories();

        require_once __DIR__ . '/../../views/home.php';
    }
}