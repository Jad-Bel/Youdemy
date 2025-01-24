<?php

use App\user\user;

class Student extends User {
    public function __construct($username, $email, $password, $role, $status)
    {
        parent::__construct(null, $username, $email, $password, $role, $status);
    }

    public function enroll($id, $course_id) {
        $sql = "INSERT INTO enrollments (id, course_id, enrolled_at)
                VALUES (:id, :course_id, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'course_id' => $course_id
        ]);
        return $stmt->rowCount() > 0;
    }

    public function isEnrolled($student_id, $course_id) {
        $sql = "SELECT * FROM enrollments WHERE id = :student_id AND course_id = :course_id";
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
}
?>