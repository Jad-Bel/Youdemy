<?php
// require_once '../classes/user.php';

class Teacher extends User
{
    public function __construct($username, $email, $password, $role, $status)
    {
        parent::__construct($username, $email, $password, $role, $status);
    }

    public function getCoursesCount ($teacher_id) {
        $sql = "SELECT COUNT(*) FROM courses AS courses_count WHERE teacher_id = :teacher_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':teacher_id', $teacher_id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getEnrolledStudentsCount()
    {
        $sql = "SELECT COUNT(DISTINCT e.id) AS enrolled_students_count
                FROM enrollments e";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getStatistics()
    {
        $enrolledStudentsCount = $this->getEnrolledStudentsCount();
        $coursesCount = $this->getCoursesCount($teacher_id);

        return [
            (object) ['statistic' => 'Nombre d’étudiants inscrits', 'count' => $enrolledStudentsCount->enrolled_students_count],
            (object) ['statistic' => 'Nombre de cours', 'count' => $coursesCount->courses_count]
        ];
    }
    
    private function addTagsToCourse($course_id, $tags)
    {
        foreach ($tags as $tag_id) {
            $sql = "INSERT INTO course_tags (course_id, tag_id) VALUES (:course_id, :tag_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'course_id' => $course_id,
                'tag_id' => $tag_id
            ]);
        }
    }

    private function updateTagsForCourse($course_id, $tags)
    {
        $sql = "DELETE FROM course_tags WHERE course_id = :course_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['course_id' => $course_id]);

        $this->addTagsToCourse($course_id, $tags);
    }

    public function displayEnrolledUsers($teacher_id)
    {
        $sql = "
                SELECT 
                    u.id AS user_id,
                    u.username,
                    u.email,
                    c.id AS course_id,
                    c.title AS course_title
                FROM 
                    users u
                JOIN 
                    enrollments e ON u.id = e.id
                JOIN 
                    courses c ON e.course_id = c.id
                WHERE 
                    c.teacher_id = :teacher_id
                    ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $enrolledUsers = [];
        foreach ($results as $row) {
            $enrolledUsers[] = new User(
                $row['user_id'],
                $row['username'],
                $row['email'],
                $row['course_id'],
                $row['course_title']
            );
        }

        return $enrolledUsers;
    }
}
