<?php
require_once "Course.php";

class VideoCourse extends Course {
    public function __construct($title, $description, $content, $video_link, $teacher_id, $category_id) {
        parent::__construct($title, $description, $content, $video_link, $teacher_id, $category_id);
    }

    public function getVideoLink() {
        return $this->video_link;
    }

    public function setVideoLink($video_link) {
        $this->video_link = $video_link;
    }

    public function displayContent() {
        return "<iframe src='{$this->video_link}' width='560' height='315' frameborder='0' allowfullscreen></iframe>";
    }

    public function save() {
        parent::save();

        $sql = "UPDATE courses SET video_link = :video_link WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'video_link' => $this->video_link,
            'id' => $this->id
        ]);
        return true;
    }
}

// $videoCourse = new VideoCourse(
//     'Introduction to PHP', 
//     'Learn PHP basics',    
//     'This course covers PHP fundamentals.',
//     'https://www.youtube.com/embed/xyz123',
//     1,                     
//     1                      
// );

// if ($videoCourse->save()) {
//     echo "Course saved successfully! Course ID: " . $videoCourse->getId() . "<br>";
// } else {
//     echo "Failed to save course.<br>";
// }

// echo $videoCourse->displayContent();
?>