<?php
class Teacher extends User
{
    public function __construct($id, $username, $email, $password, $role, $status)
    {
        parent::__construct($id, $username, $email, $password, $role, $status);
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

    public function getApprovedCoursesCount($teacher_id)
    {
        $sql = "SELECT COUNT(*) AS approved_courses_count 
            FROM courses 
            WHERE teacher_id = :teacher_id AND status = 'approved'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':teacher_id', $teacher_id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getAverageStudentsPerCourse($teacher_id)
    {
        $sql = "SELECT COUNT(e.id) / COUNT(DISTINCT c.id) AS average_students_per_course
                FROM courses c
                JOIN enrollments e ON c.id = e.course_id
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
        $approvedCoursesCount = $this->getApprovedCoursesCount($teacher_id);
        $averageStudentPerCourse = $this->getAverageStudentsPerCourse($teacher_id);

        return [
            (object) ['statistic' => 'Enrolled Students', 'count' => $enrolledStudentsCount->enrolled_students_count],
            (object) ['statistic' => 'Total Courses', 'count' => $coursesCount->courses_count],
            (object) ['statistic' => 'Approved Courses', 'count' => $approvedCoursesCount->approved_courses_count],
            (object) ['statistic' => 'Average Students per Course', 'count' => $averageStudentPerCourse->average_students_per_course]
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
                u.password,       
                u.role,           
                u.status,         
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
                $row['email']          
            );
        }

        return $enrolledUsers;
    }
}
