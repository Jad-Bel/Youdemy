<?php

namespace App\Controllers;

use App\Modal\CourseService\CourseService;
use App\Modal\Category\Category;

class HomeController
{
    protected $courseService;
    protected $categoryModel;

    public function __construct(CourseService $courseService, Category $categoryModel)
    {
        $this->courseService = $courseService;
        $this->categoryModel = $categoryModel;
    }

    public function index()
    {
        $courses = $this->courseService->getAllApprovedCourses();
        $categories = $this->categoryModel->getPopularCategories();

        require_once __DIR__ . '/../../views/home.php';
    }
}