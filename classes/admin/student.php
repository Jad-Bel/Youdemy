<?php
require_once 'User.php';

class Student extends User {
    public function __construct($username, $email, $password) {
        parent::__construct($username, $email, $password, 'student');
    }

    public function enroll($course_id) {}
    public function viewCourses() {}
    public function searchCourses($keyword) {}
}
?>