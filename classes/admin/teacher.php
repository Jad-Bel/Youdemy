<?php
// require_once '../classes/user.php';

class Teacher extends User
{
    public function __construct($username, $email, $password, $role, $status)
    {
        parent::__construct($username, $email, $password, $role, $status);
    }

    public function getCoursesCount($teacher_id)
    {
        $sql = "SELECT COUNT(*) AS courses_count FROM courses WHERE teacher_id = :teacher_id";
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

    public function getActiveCoursesCount($teacher_id)
    {
        $sql = "SELECT COUNT(*) AS active_courses_count 
            FROM courses 
            WHERE teacher_id = :teacher_id AND status = 'active'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':teacher_id', $teacher_id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getStudentsEnrolledInTeacherCourses($teacher_id)
    {
        $sql = "SELECT COUNT(DISTINCT e.id) AS students_enrolled_count
            FROM enrollments e
            JOIN courses c ON e.course_id = c.id
            WHERE c.teacher_id = :teacher_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':teacher_id', $teacher_id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getStatistics($teacher_id)
    {
        $enrolledStudentsCount = $this->getEnrolledStudentsCount();
        $coursesCount = $this->getCoursesCount($teacher_id);
        $activeCoursesCount = $this->getActiveCoursesCount($teacher_id);
        $studentsEnrolledCount = $this->getStudentsEnrolledInTeacherCourses($teacher_id);


        return [
            (object) [$enrolledStudentsCount->enrolled_students_count],
            (object) [$coursesCount->courses_count],
            (object) [$activeCoursesCount->active_courses_count],
            (object) [$studentsEnrolledCount->students_enrolled_count]

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
