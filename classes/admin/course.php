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
    protected $duration;
    protected $language;
    protected $skill_level;
    protected $course_bnr;
    protected $certification;
    protected $conn;

    public function __construct(
        $title,
        $description,
        $content,
        $teacher_id,
        $category_id,
        $duration,
        $language,
        $skill_level,
        $course_bnr,
        $status,
        $certification
    ) {
        $db = new Database();
        $this->conn = $db->getConnection();

        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->teacher_id = $teacher_id;
        $this->category_id = $category_id;
        $this->duration = $duration;
        $this->language = $language;
        $this->skill_level = $skill_level;
        $this->course_bnr = $course_bnr;
        $this->status = $status;
        $this->certification = $certification;
    }

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
    public function getDuration()
    {
        return $this->duration;
    }
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }
    public function getLanguage()
    {
        return $this->language;
    }
    public function setLanguage($language)
    {
        $this->language = $language;
    }
    public function getSkillLevel()
    {
        return $this->skill_level;
    }
    public function setSkillLevel($skill_level)
    {
        $this->skill_level = $skill_level;
    }
    public function getCourseBnr()
    {
        return $this->course_bnr;
    }
    public function setCourseBnr($course_bnr)
    {
        $this->course_bnr = $course_bnr;
    }
    public function getCertification()
    {
        return $this->certification;
    }
    public function setCertification($certification)
    {
        $this->certification = $certification;
    }
    abstract public function save();

    abstract public function displayContent($id);
}

class ConcreteCourse extends Course
{
    public function save() {}
    public function displayContent($id) {}

    public function countCourses($search = '', $categoryId = null)
    {
        $query = "SELECT COUNT(*) as total FROM courses WHERE status = 'approved'";
        if ($search) {
            $query .= " AND (title LIKE :search OR description LIKE :search)";
        }
        if ($categoryId) {
            $query .= " AND category_id = :category_id";
        }

        $stmt = $this->conn->prepare($query);
        if ($search) {
            $stmt->bindValue(':search', "%$search%");
        }
        if ($categoryId) {
            $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        }
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$result['total'];
    }

    public function getCoursesByPage($perPage, $offset, $search = '', $categoryId = null)
    {
        $query = "SELECT 
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
                        categories ctg ON c.category_id = ctg.id
                    WHERE c.status = 'approved'";

        if ($search) {
            $query .= " AND (c.title LIKE :search OR c.description LIKE :search)";
        }
        if ($categoryId) {
            $query .= " AND c.category_id = :category_id";
        }

        $query .= " LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);
        if ($search) {
            $stmt->bindValue(':search', "%$search%");
        }
        if ($categoryId) {
            $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        }
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($course_id)
    {
        $sql = "DELETE FROM courses WHERE id = :course_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'course_id' => $course_id,
        ]);

        return $stmt->rowCount() > 0;
    }
}