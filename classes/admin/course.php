<?php
require_once "../../config/database.php";

abstract class Course {
    protected $id;
    protected $title;
    protected $description;
    protected $content;
    protected $video_link;
    protected $teacher_id;
    protected $category_id;
    protected $created_at;
    protected $updated_at;
    protected $conn;

    public function __construct($title, $description, $content, $video_link, $teacher_id, $category_id) {
        $database = new Database();
        $this->conn = $database->getConnection();

        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->video_link = $video_link;
        $this->teacher_id = $teacher_id;
        $this->category_id = $category_id;
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDescription() {
        return $this->description;
    }
    
    public function setVideo($video_link) {
        $this->video_link = $video_link;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getVideo() {
        return $this->video_link;
    }

    public function setTeacherId($teacher_id) {
        $this->teacher_id = $teacher_id;
    }

    public function getTeacherId() {
        return $this->teacher_id;
    }

    public function setCategoryId($category_id) {
        $this->category_id = $category_id;
    }

    public function getCategoryId() {
        return $this->category_id;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

    abstract public function displayContent($title, $description, $content, $video_link, $category_id, $tags);

    abstract public function addCourse();

    abstract public function editCourse($course_id, $title, $description, $content, $video_link, $category_id, $tags);

    abstract public function deleteCourse($course_id);

    public function viewStatistics() {

    
    
    public function save() {
        $sql = "INSERT INTO courses (title, description, content, video_link, teacher_id, category_id, created_at, updated_at)
                VALUES (:title, :description, :content, :video_link, :teacher_id, :category_id, :created_at, :updated_at)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'video_link' => $this->video_link,
            'teacher_id' => $this->teacher_id,
            'category_id' => $this->category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ]);
    
        $this->id = $this->conn->lastInsertId();
        return true;
    }
}

// class Course1 extends course {
//     protected $conn;
//     protected $document_path;

//     public function __construct($title, $description, $teacher_id, $category_id)
//     {
//         parent::__construct($title, $description, $teacher_id, $category_id);
//     }

//     public function displayContent() {
//         return "<a href='{$this->document_path}' download>Download Document</a>";
//     }
// }
?>