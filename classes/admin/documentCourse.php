<?php
require_once 'course.php';

class DocumentCourse extends Course {
    private $document_link;

    public function __construct($title, $description, $content, $document_link, $teacher_id, $category_id) {
        parent::__construct($title, $description, $content, $teacher_id, $category_id);
        $this->document_link = $document_link;
    }

    public function getDocumentLink() {
        return $this->document_link;
    }

    public function setDocumentLink($document_link) {
        $this->document_link = $document_link;
    }

    public function save() {
        $sql = "INSERT INTO courses (title, description, content, document_link, teacher_id, category_id, created_at, updated_at)
                VALUES (:title, :description, :content, :document_link, :teacher_id, :category_id, NOW(), NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'document_link' => $this->document_link,
            'teacher_id' => $this->teacher_id,
            'category_id' => $this->category_id
        ]);

        $this->id = $this->conn->lastInsertId();
        return $this->id;
    }

    public function modify($course_id, $title, $description, $content, $document_link, $category_id) {
        $sql = "UPDATE courses
                SET title = :title,
                    description = :description,
                    content = :content,
                    document_link = :document_link,
                    category_id = :category_id,
                    updated_at = NOW()
                WHERE id = :course_id AND teacher_id = :teacher_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'title' => $title,
            'description' => $description,
            'content' => $content,
            'document_link' => $document_link,
            'category_id' => $category_id,
            'course_id' => $course_id,
            'teacher_id' => $this->teacher_id
        ]);

        return $stmt->rowCount() > 0; 
    }

    public function delete($course_id) {
        $sql = "DELETE FROM courses WHERE id = :course_id AND teacher_id = :teacher_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'course_id' => $course_id,
            'teacher_id' => $this->teacher_id
        ]);

        return $stmt->rowCount() > 0; 
    }

    public function displayContent($id) {
        $sql = "SELECT * FROM courses WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $this->id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>