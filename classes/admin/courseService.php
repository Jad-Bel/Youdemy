<?php
class CourseService extends Course {
    private $courseModel;
    private $categoryModel;

    public function __construct($courseModel, $categoryModel) {
        $this->courseModel = $courseModel;
        $this->categoryModel = $categoryModel;
    }

    public function save() {}
    public function displayContent() {}

    public static function getAllCourses () 
    {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "SELECT 
                c.id AS id,
                c.title AS title,
                c.description AS dsc,
                c.content AS cnt,
                c.document_link,
                c.video_link,
                c.status,
                c.created_at AS crs_created_at,
                c.updated_at AS course_updated_at,
                c.course_bnr AS banner,
                ctg.name AS ctg_name,
                c.teacher_id,
                u.username AS teacher_username,
                u.email AS teacher_email
            FROM 
                courses c
            JOIN 
                users u ON c.teacher_id = u.id
            JOIN 
                categories ctg ON c.category_id = ctg.id";            
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);   
    }

    public static function getAllApprovedCourses()
    {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "SELECT 
                c.id AS id,
                c.title AS title,
                c.description AS dsc,
                c.content AS cnt,
                c.document_link,
                c.video_link,
                c.status,
                c.created_at AS crs_created_at,
                c.updated_at AS course_updated_at,
                c.course_bnr AS banner,
                ctg.name AS ctg_name,
                c.teacher_id,
                u.username AS teacher_username,
                u.email AS teacher_email
            FROM 
                courses c
            JOIN 
                users u ON c.teacher_id = u.id
            JOIN 
                categories ctg ON c.category_id = ctg.id
            WHERE c.status = 'approved'";
            
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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