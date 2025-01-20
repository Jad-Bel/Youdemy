<?php
require_once 'course.php';

class VideoCourse extends Course
{
    private $video_link;

    public function __construct($title, $description, $content, $video_link, $teacher_id, $category_id, $duration, $language, $skill_level, $course_bnr, $status = 'pending', $certification = null)
{
    parent::__construct($title, $description, $content, $video_link, $teacher_id, $category_id, $duration, $language, $skill_level, $course_bnr, $certification = null);
    $this->video_link = $video_link;
}
    public function getVideoLink()
    {
        return $this->video_link;
    }

    public function setVideoLink($video_link)
    {
        $this->video_link = $video_link;
    }

    public function save()
    {
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

    public function modify($course_id, $title, $description, $content, $video_link, $category_id)
    {
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
            'teacher_id' => $this->teacher_id
        ]);

        return $stmt->rowCount() > 0;
    }

    public function delete($course_id)
    {
        $sql = "DELETE FROM courses WHERE id = :course_id AND teacher_id = :teacher_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'course_id' => $course_id,
            'teacher_id' => $this->teacher_id
        ]);

        return $stmt->rowCount() > 0;
    }

    public function displayContent($id)
    {
        $sql = "SELECT * FROM courses WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}
