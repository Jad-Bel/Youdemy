<?php

namespace App\Model\CourseService;
use App\Core\Database\Database;
use App\Model\Course\ConcreteCourse;
use App\Model\Category\Category;

class CourseService
{
    private $courseModel;
    private $categoryModel;

    public function __construct(ConcreteCourse $courseModel, Category $categoryModel)
    {
        $this->courseModel = $courseModel;
        $this->categoryModel = $categoryModel;
    }


    public function save() {}
    public function displayContent() {}

    public function getCourseById($id)
    {
        $db = new database();
        $conn = $db->getConnection();

        $sql = "SELECT 
                c.id AS id,
                c.category_id AS ctg_id,
                c.title AS title,
                c.description AS dsc,
                c.content AS cntt,
                c.document_link,
                c.video_link,
                c.status,
                c.type as `type`,
                c.created_at AS crs_created_at,
                c.updated_at AS course_updated_at,
                c.course_bnr AS banner,
                c.certification AS crtf,
                c.skill_level AS lvl,
                c.language AS lng,
                c.duration AS duration,
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
            WHERE
                c.id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getAllCourses()
    {
        $db = new database();
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
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAllApprovedCourses()
    {
        $db = new database();
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
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAllCoursesForTeacher($user_id)
{
    $db = new Database();
    $conn = $db->getConnection();

    $query = "
        SELECT 
            c.id AS id,
            c.title AS title,
            c.language AS language,
            ctg.name AS ctg_name,
            c.teacher_id,
            c.status,
            u.username AS teacher_username,
            u.email AS teacher_email
        FROM 
            courses c
        JOIN 
            users u ON c.teacher_id = u.id
        JOIN 
            categories ctg ON c.category_id = ctg.id
        WHERE
            c.teacher_id = :user_id
    ";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(":user_id", $user_id, \PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_OBJ);
}

    public function getPaginatedCourses($page, $perPage, $search = '', $categoryId = null)
    {
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

    public function getAllCategories()
    {
        return $this->categoryModel->getAllCategories();
    }

}