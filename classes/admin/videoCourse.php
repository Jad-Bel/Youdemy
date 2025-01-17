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

    public function addCourse($title, $teacher_id, $description, $content, $document_link, $video_link, $category_id, $tags) {
        $sql = "INSERT INTO courses (title, description, content, document_link, video_link, teacher_id, category_id, created_at, updated_at)
                VALUES (:title, :description, :content, :video_link, :teacher_id, :category_id, NOW(), NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'title' => $title,
            'description' => $description,
            'content' => $content,
            'document_link' => $document_link,
            'video_link' => $video_link,
            // 'teacher_id' => $this->getId(),
            'teacher_id' => $teacher_id,
            'category_id' => $category_id
        ]);

        $course_id = $this->conn->lastInsertId();

        // $this->addTagsToCourse($course_id, $tags);

        return $course_id;
    }

    public function editCourse($course_id, $title, $description, $content, $document_link, $video_link, $category_id, $tags) {
        $sql = "UPDATE courses
                SET title = :title,
                    description = :description,
                    content = :content,
                    document_linkt = :document_link,
                    video_link = :video_link,
                    category_id = :category_id,
                    updated_at = NOW()
                WHERE id = :course_id AND teacher_id = :teacher_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'title' => $title,
            'description' => $description,
            'content' => $content,
            'document_link' => $document_link,
            'video_link' => $video_link,
            'category_id' => $category_id,
            'course_id' => $course_id,
            'teacher_id' => $this->getId()
        ]);

        // $this->updateTagsForCourse($course_id, $tags);

        return $stmt->rowCount() > 0;
    }

    public function deleteCourse($course_id) {
        $sql = "DELETE FROM courses WHERE id = :course_id AND teacher_id = :teacher_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'course_id' => $course_id,
            'teacher_id' => $this->getId()
        ]);

        return $stmt->rowCount() > 0;
    }

    public function displayContent() {
        $sql  = "SELECT * FROM courses WHERE document_link = null";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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