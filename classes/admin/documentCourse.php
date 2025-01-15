<?php
require_once 'course.php';

class DocumentCourse extends Course {
    private $document_link;

    public function __construct($title, $description, $content, $video_link, $teacher_id, $category_id, $document_link) {
        parent::__construct($title, $description, $content, $video_link, $teacher_id, $category_id);
        $this->document_link = $document_link;
    }

    public function getDocumentLink() {
        return $this->document_link;
    }

    public function setDocumentLink($document_link) {
        $this->document_link = $document_link;
    }

    public function displayContent() {
        return "<a href='{$this->document_link}' download>Download Document</a>";
    }

    public function save() {
        parent::save();

        $sql = "UPDATE courses SET content = :content WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'content' => $this->document_link,
            'id' => $this->id
        ]);
        return true;
    }
}

// $documentCourse = new DocumentCourse(
//     'Advanced PHP Programming', 
//     'Learn advanced PHP concepts and techniques',
//     'This course covers advanced PHP topics.',
//     '',
//     2,
//     3,
//     'https://docs.google.com/document/d/1Ps_RuUKLSOc4RjTnnMI4Xu17lKBA1koeykYuob76jeE/edit?tab=t.0#heading=h.olaiqff762pw' // document_link (link to the document)
// );

// if ($documentCourse->save()) {
//     echo "Course saved successfully! Course ID: " . $documentCourse->getId() . "<br>";
// } else {
//     echo "Failed to save course.<br>";
// }

// echo $documentCourse->displayContent();
?>