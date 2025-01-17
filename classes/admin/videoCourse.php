<?php
require_once 'course.php';

class VideoCourse extends Course {
    private $video_link;

    public function __construct($title, $description, $content, $video_link, $teacher_id, $category_id) {
        parent::__construct($title, $description, $content, $teacher_id, $category_id);
        $this->video_link = $video_link;
    }

    public function getVideoLink() {
        return $this->video_link;
    }

    public function setVideoLink($video_link) {
        $this->video_link = $video_link;
    }

    public function save() {
        $sql = "INSERT INTO courses (title, description, content, video_link, teacher_id, category_id, created_at, updated_at)
                VALUES (:title, :description, :content, :video_link, :teacher_id, :category_id, NOW(), NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'video_link' => $this->video_link,
            'teacher_id' => $this->teacher_id,
            'category_id' => $this->category_id
        ]);

        $this->id = $this->conn->lastInsertId();
        return $this->id;
    }

    public function displayContent() {
        $sql = "SELECT * FROM courses WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $this->id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>