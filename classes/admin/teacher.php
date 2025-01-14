<?php
require_once 'User.php';

class Teacher extends User {
    public function __construct($username, $email, $password) {
        parent::__construct($username, $email, $password, 'teacher');
    }

    public function addCourse($title, $description, $content, $video_link, $category_id, $tags) {}
    public function editCourse($course_id, $title, $description, $content, $video_link, $category_id, $tags) {}
    public function deleteCourse($course_id) {}
    public function viewStatistics() {}
}
?>