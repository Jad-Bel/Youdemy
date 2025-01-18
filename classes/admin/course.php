<?php

abstract class Course
{
    protected $id;
    protected $title;
    protected $description;
    protected $content;
    protected $teacher_id;
    protected $category_id;
    protected $created_at;
    protected $updated_at;
    protected $status; 
    protected $conn;

    public function __construct($title, $description, $content, $teacher_id, $category_id)
    {
        $db = new Database();
        $this->conn = $db->getConnection();

        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->teacher_id = $teacher_id;
        $this->category_id = $category_id;
        $this->status = 'pending'; 
    }

    // getters
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getTeacherId()
    {
        return $this->teacher_id;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    abstract public function save();

    abstract public function displayContent();
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
