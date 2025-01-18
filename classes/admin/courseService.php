<?php
class CourseService {
    private $courseModel;
    private $categoryModel;

    public function __construct($courseModel, $categoryModel) {
        $this->courseModel = $courseModel;
        $this->categoryModel = $categoryModel;
    }

    public function getPaginatedCourses($page, $perPage, $search = '', $categoryId = null) {
        $totalCourses = $this->courseModel->countCourses($search, $categoryId);
        $totalPages = $totalCourses > 0 ? ceil($totalCourses / $perPage) : 1;

        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;

        $courses = $this->courseModel->getCoursesByPage($perPage, $offset, $search, $categoryId);

        return [
            'courses' => $courses,
            'totalPages' => $totalPages,
            'currentPage' => $page,
        ];
    }

    public function getAllCategories() {
        return $this->categoryModel->getAllCategories();
    }
}
?>