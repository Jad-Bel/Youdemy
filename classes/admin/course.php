<?php 

abstract class course 
{
    protected $id;
    protected $title;
    protected $description;
    protected $teacher_id;
    protected $category_id;
    protected $created_id;

    public function __construct($title, $description, $teacher_id, $category_id)
    {
        
    }

    public function setId ($id) {
        return $this->id = $id;
    }

    public function getId () {
        $this->id;
    }

}