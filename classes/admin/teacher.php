<?php
require_once '../user.php';

class Teacher extends User {
    public function __construct($username, $email, $password) {
        parent::__construct($username, $email, $password, 'teacher');
    }

    public function addCourse($title, $teacher_id, $description, $content, $video_link, $category_id, $tags) {
        $sql = "INSERT INTO courses (title, description, content, video_link, teacher_id, category_id, created_at, updated_at)
                VALUES (:title, :description, :content, :video_link, :teacher_id, :category_id, NOW(), NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'title' => $title,
            'description' => $description,
            'content' => $content,
            'video_link' => $video_link,
            // 'teacher_id' => $this->getId(),
            'teacher_id' => $teacher_id,
            'category_id' => $category_id
        ]);

        $course_id = $this->conn->lastInsertId();

        $this->addTagsToCourse($course_id, $tags);

        return $course_id;
    }

    public function editCourse($course_id, $title, $description, $content, $video_link, $category_id, $tags) {
        $sql = "UPDATE courses
                SET title = :title,
                    description = :description,
                    content = :content,
                    video_link = :video_link,
                    category_id = :category_id,
                    updated_at = NOW()
                WHERE id = :course_id AND teacher_id = :teacher_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'title' => $title,
            'description' => $description,
            'content' => $content,
            'video_link' => $video_link,
            'category_id' => $category_id,
            'course_id' => $course_id,
            'teacher_id' => $this->getId()
        ]);

        $this->updateTagsForCourse($course_id, $tags);

        return $stmt->rowCount() > 0;
    }

    public function deleteCourse($course_id) {
        $sql = "DELETE FROM courses WHERE id = :course_id AND teacher_id = :teacher_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'course_id' => $course_id,
            'teacher_id' => $this->getId()
        ]);

        return $stmt->rowCount() > 0;
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

// $teacher = new Teacher('john_doe', 'john@example.com', 'password123');

// $courseId = $teacher->addCourse(
//     'Introduction to PHP',
//     1,
//     'Learn PHP basics',
//     null, 
//     'https://example.com/video',
//     1,
//     [1, 2]
// );
// if ($courseId) {
//     echo "Course added successfully! Course ID: " . $courseId . "<br>";
// } else {
//     echo "Failed to add course.<br>";
// }

// $statistics = $teacher->viewStatistics();
// if (!empty($statistics)) {
//     echo "Statistics fetched successfully!<br>";
//     print_r($statistics);
// } else {
//     echo "Failed to fetch statistics.<br>";
// }
?>