<?php


namespace App\Model\Course;

class VideoCourse extends course
{
    private $video_link;

    public function __construct(
        $title,
        $description,
        $content,
        $video_link,
        $teacher_id,
        $category_id,
        $duration,
        $language,
        $skill_level,
        $course_bnr,
        $status,
        $certification
    )
    {
        parent::__construct(
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
        );
        $this->video_link = $video_link;
    }

    public function getVideoLink()
    {
        return $this->video_link;
    }

    public function setVideoLink($video_link)
    {
        $this->video_link = $video_link;
    }

    public function save()
    {
        $sql = "INSERT INTO courses (
                    title, 
                    description, 
                    content, 
                    video_link, 
                    teacher_id, 
                    category_id, 
                    duration, 
                    language, 
                    skill_level, 
                    course_bnr, 
                    status, 
                    certification, 
                    created_at, 
                    updated_at
                ) VALUES (
                    :title, 
                    :description, 
                    :content, 
                    :video_link, 
                    :teacher_id, 
                    :category_id, 
                    :duration, 
                    :language, 
                    :skill_level, 
                    :course_bnr, 
                    :status, 
                    :certification, 
                    NOW(), 
                    NOW()
                )";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'video_link' => $this->video_link,
            'teacher_id' => $this->teacher_id,
            'category_id' => $this->category_id,
            'duration' => $this->duration,
            'language' => $this->language,
            'skill_level' => $this->skill_level,
            'course_bnr' => $this->course_bnr,
            'status' => $this->status,
            'certification' => $this->certification
        ]);

        $this->id = $this->conn->lastInsertId();
        return $this->id;
    }


    public function modify($course_id, $title, $description, $content, $video_link, $category_id, $duration, $language, $skill_level, $course_bnr, $status, $certification)
    {
        $allowedStatuses = ['pending', 'approved', 'rejected'];
        if (!in_array($status, $allowedStatuses)) {
            throw new \Exception("Invalid status: $status");
        }

        $sql = "UPDATE courses
                SET title = :title,
                    description = :description,
                    content = :content,
                    'video_link' => $video_link,
                    category_id = :category_id,
                    duration = :duration,
                    language = :language,
                    skill_level = :skill_level,
                    course_bnr = :course_bnr,
                    status = :status,
                    certification = :certification,
                    updated_at = NOW()
                WHERE id = :course_id AND teacher_id = :teacher_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'title' => $title,
            'description' => $description,
            'content' => $content,
            'video_link' => $video_link,
            'category_id' => $category_id,
            'duration' => $duration,
            'language' => $language,
            'skill_level' => $skill_level,
            'course_bnr' => $course_bnr,
            'status' => $status,
            'certification' => $certification,
            'course_id' => $course_id,
            'teacher_id' => $this->teacher_id
        ]);

        return $stmt->rowCount() > 0;
    }

    public function displayContent($id)
    {
        $sql = "SELECT * FROM courses WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }
}