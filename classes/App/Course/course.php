<?php

namespace Youco\Youdemy\App\Course;

use Youco\Youdemy\App\Database\Database;

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
        $db = new database();
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