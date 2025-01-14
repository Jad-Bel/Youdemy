<?php 
    require_once "../../config/database.php";

    abstract class Course {
        protected $id;
        protected $title;
        protected $description;
        protected $teacher_id;
        protected $category_id;
        protected $created_at;
        protected $updated_at;
        protected $conn;

        public function __construct($title, $description, $teacher_id, $category_id) {
            
        }

        public function setId ($id) {
            $this->id = $id;
        }

        public function getId () {
            return $this->id;
        }

        public function settitle ($title) {
            $this->title = $title;
        }

        public function gettitle () {
            return $this->title;
        }

        public function setdescription ($description) {
            $this->description = $description;
        }

        public function getdescription () {
            return $this->description;
        }

        public function setteacher ($teacher_id) {
            $this->teacher_id = $teacher_id;
        }

        public function getteacher () {
            return $this->teacher_id;
        }

        public function setcategory ($category_id) {
            $this->category_id = $category_id;
        }

        public function getcategory () {
            return $this->category_id;
        }

        public function setcreated ($created_id) {
            $this->created_at = $created_id;
        }

        public function getcreated () {
            return $this->created_at;
        }

        abstract public function displayContent ();

        public function save() 
        {
            
        }

    }
