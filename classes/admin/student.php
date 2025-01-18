<?php
// require_once '../classes/user.php';
// require_once '../../config/database.php';
// require_once '../user.php';

class Student extends User {
    public function __construct($username, $email, $password, $role, $status) {
        parent::__construct($username, $email, $password, 'student', $status);
    }

    public function enroll($student_id, $course_id) {
        $sql = "INSERT INTO enrollments (student_id, course_id, enrolled_at)
                VALUES (:student_id, :course_id, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'student_id' => $student_id,
            'course_id' => $course_id
        ]);
    
        return $stmt->rowCount() > 0;
    }

    public function viewCourses() {
        $sql = "SELECT c.id, c.title, c.description, c.content, c.video_link, c.teacher_id, c.category_id
                FROM courses c
                JOIN enrollments e ON c.id = e.course_id
                WHERE e.student_id = :student_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['student_id' => $this->getId()]);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchCourses($keyword) {
        $sql = "SELECT c.id, c.title, c.description, c.content, c.video_link, c.teacher_id, c.category_id
                FROM courses c
                WHERE c.title LIKE :keyword OR c.description LIKE :keyword";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['keyword' => "%$keyword%"]);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getPaginatedCourses($page, $perPage) {
        $db = new Database();
        $conn = $db->getConnection();
    
        $offset = ($page - 1) * $perPage;
    
        $sql = "SELECT 
                    c.id AS id,
                    c.title AS title,
                    c.description AS dsc,
                    c.content AS cnt,
                    c.document_link,
                    c.video_link,
                    c.created_at AS crs_created_at,
                    c.updated_at AS course_updated_at,
                    c.course_bnr AS banner,
                    ctg.name AS ctg_name,
                    u.username AS teacher_username,
                    u.email AS teacher_email
                FROM 
                    courses c
                JOIN 
                    users u ON c.teacher_id = u.id
                JOIN 
                    categories ctg ON c.category_id = ctg.id
                WHERE 
                    c.status = 'approved'
                LIMIT :limit OFFSET :offset";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $totalQuery = "SELECT COUNT(*) as total FROM courses WHERE status = 'approved'";
        $totalStmt = $conn->query($totalQuery);
        $total = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];
    
        $totalPages = ceil($total / $perPage);
    
        return [
            'courses' => $courses,
            'totalPages' => $totalPages,
            'currentPage' => $page,
        ];
    }
}

// $student = new Student('jane_doe', 'jane@example.com', 'password123', 'student', 1);
// $register = new user('jane_doe', 'jane@example.com', 'password123', 'student');
// $register->register();
// if ($student->enroll(1,1)) {
//     echo "Enrollment successful!<br>";
// } else {
//     echo "Failed to enroll in the course.<br>";
// }

// $courses = $student->viewCourses();
// if (!empty($courses)) {
//     echo "Enrolled courses fetched successfully!<br>";
//     print_r($courses);
// } else {
//     echo "No courses found.<br>";
// }

// $searchResults = $student->searchCourses('PHP');
// if (!empty($searchResults)) {
//     echo "Search results fetched successfully!<br>";
//     print_r($searchResults);
// } else {
//     echo "No courses found.<br>";
// }
?>