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

$documentCourse = new DocumentCourse(
    'Advanced PHP Programming', // title
    'Learn advanced PHP concepts and techniques', // description
    'This course covers advanced PHP topics.', // content (can be a placeholder)
    '', // video_link (can be empty if not applicable)
    2, // teacher_id (ID of the teacher)
    3, // category_id (ID of the category)
    'https://docs.google.com/document/d/1Ps_RuUKLSOc4RjTnnMI4Xu17lKBA1koeykYuob76jeE/edit?tab=t.0#heading=h.olaiqff762pw' // document_link (link to the document)
);

// Save the course to the database
if ($documentCourse->save()) {
    echo "Course saved successfully! Course ID: " . $documentCourse->getId() . "<br>";
} else {
    echo "Failed to save course.<br>";
}

// Display the course content (download link for the document)
echo $documentCourse->displayContent();
?>