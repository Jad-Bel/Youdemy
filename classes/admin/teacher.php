<?php
// require_once '../classes/user.php';

class Teacher extends User
{
    public function __construct($username, $email, $password, $role, $status)
    {
        parent::__construct($username, $email, $password, $role, $status);
    }

    public function viewStatistics()
    {
        $sql = "SELECT c.id, c.title, COUNT(e.student_id) AS student_count
                FROM courses c
                LEFT JOIN enrollments e ON c.id = e.course_id
                WHERE c.teacher_id = :teacher_id
                GROUP BY c.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['teacher_id' => $this->getId()]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
