<?php

namespace App\Model\Admin;
use App\Model\User\User;

class Admin extends User
{
    public function __construct($username, $email, $password, $role = 'admin', $id = null)
    {
        parent::__construct($username, $email, $password, 'admin', $id);
    }

    private function updateUserStatus($id, $status)
    {
        $sql = "UPDATE users SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['status' => $status, 'id' => $id]);
    }

    public function banUser($id)
    {
        $this->updateUserStatus($id, 'suspended');
    }

    public function unbanUser($id)
    {
        $this->updateUserStatus($id, 'active');
    }

    public function deleteUser($email)
    {
        if ($this->email == $email) {
            throw new \Exception('Admin cannot delete themselves');
        }
        $query = "DELETE FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['email' => $email]);
    }

    public function acceptTeacher($id)
    {
        $this->updateUserStatus($id, 'active');
    }

    public function declineTeacher($id)
    {
        $this->updateUserStatus($id, 'suspended');
    }

    public function approve($id)
    {
        if ($id) {
            $sql = "UPDATE courses SET status = 'approved' WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            return $stmt->execute();
        }
        return false;
    }

    public function decline($id)
    {
        if ($id) {
            $sql = "UPDATE courses SET status = 'declined' WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            return $stmt->execute();
        }
    }

    public function deleteCourse($id)
    {
        if ($id) {
            $sql = "DELETE FROM courses WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            return $stmt->execute();
        }
    }

    public function CoursesCount()
    {
        $sql = "SELECT COUNT(*) AS courses_count FROM courses";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function getMostEnrolledCourse()
    {
        $sql = "
        SELECT 
            c.id AS course_id,
            c.title AS course_title,
            COUNT(e.id) AS enrolled_students_count
        FROM 
            courses c
        JOIN 
            enrollments e ON c.id = e.course_id
        GROUP BY 
            c.id
        ORDER BY 
            enrolled_students_count DESC
        LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function getStatistics()
    {
        $coursesCount = $this->CoursesCount();
        $popularCourse = $this->getMostEnrolledCourse();
        return [
            (object) ['statistic' => 'Total Courses', 'count' => $coursesCount->courses_count],
            (object) ['statistic' => 'Most Enrolled Course', 'count' => $popularCourse->enrolled_students_count],
        ];
    }
}