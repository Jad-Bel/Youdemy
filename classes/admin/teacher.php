<?php
// require_once '../classes/user.php';

class Teacher extends User {
    public function __construct($username, $email, $password, $status) {
        parent::__construct($username, $email, $password, 'teacher', $status);
    }

    public function viewStatistics() {
        $sql = "SELECT c.id, c.title, COUNT(e.student_id) AS student_count
                FROM courses c
                LEFT JOIN enrollments e ON c.id = e.course_id
                WHERE c.teacher_id = :teacher_id
                GROUP BY c.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['teacher_id' => $this->getId()]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function addTagsToCourse($course_id, $tags) {
        foreach ($tags as $tag_id) {
            $sql = "INSERT INTO course_tags (course_id, tag_id) VALUES (:course_id, :tag_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'course_id' => $course_id,
                'tag_id' => $tag_id
            ]);
        }
    }

    private function updateTagsForCourse($course_id, $tags) {
        $sql = "DELETE FROM course_tags WHERE course_id = :course_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['course_id' => $course_id]);

        $this->addTagsToCourse($course_id, $tags);
    }
}
?>