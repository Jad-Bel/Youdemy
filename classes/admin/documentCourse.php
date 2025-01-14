<?php
require_once 'Course.php';

class DocumentCourse extends Course {
    private $document_path;

    public function __construct($title, $description, $teacher_id, $category_id, $document_path) {
        parent::__construct($title, $description, $teacher_id, $category_id);
        $this->document_path = $document_path;
    }

    public function getDocumentPath() {
        return $this->document_path;
    }

    public function setDocumentPath($document_path) {
        $this->document_path = $document_path;
    }

    public function displayContent() {
        return "<a href='{$this->document_path}' download>Download Document</a>";
    }

    public function save() {
        parent::save();

        $sql = "UPDATE courses SET content = :content WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'content' => $this->document_path,
            'id' => $this->id
        ]);
    }
}
?>