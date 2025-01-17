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

    public function approve()
    {
        if ($this->id) {
            $sql = "UPDATE courses SET status = 'approved' WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            return $stmt->execute();
        }
        return false;
    }

    public function decline()
    {
        if ($this->id) {
            $sql = "UPDATE courses SET status = 'declined' WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            return $stmt->execute();
        }
        return false;
    }

    public static function getAllCourses()
    {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "SELECT 
                c.id AS id,
                c.title AS title,
                c.description AS dsc,
                c.content AS cnt,
                c.document_link,
                c.video_link,
                c.status,
                c.created_at AS crs_created_at,
                c.updated_at AS course_updated_at,
                c.course_bnr AS banner,
                ctg.name AS ctg_name,
                c.teacher_id,
                u.username AS teacher_username,
                u.email AS teacher_email
            FROM 
                courses c
            JOIN 
                users u ON c.teacher_id = u.id
            JOIN 
                categories ctg ON c.category_id = ctg.id";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
