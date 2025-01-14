<?php
require_once "Course.php";

class VideoCourse extends Course {
    private $video_link;

    public function __construct($title, $description, $teacher_id, $category_id, $video_link) {
        parent::__construct($title, $description, $teacher_id, $category_id);
        $this->video_link = $video_link;
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
    }
}
?>