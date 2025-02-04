<?php 

namespace App\Model\Course;

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
            $stmt->bindValue(':category_id', $categoryId, \PDO::PARAM_INT);
        }
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
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
            $stmt->bindValue(':category_id', $categoryId, \PDO::PARAM_INT);
        }
        $stmt->bindValue(':limit', $perPage, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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

    public function searchCoursesByKeywords($keywords)
    {
        $keywordsArray = explode(' ', $keywords);

        $sql = "SELECT * FROM courses WHERE ";
        $conditions = [];

        foreach ($keywordsArray as $keyword) {
            $conditions[] = "(title LIKE :keyword OR description LIKE :keyword)";
        }

        $sql .= implode(' OR ', $conditions);

        $stmt = $this->conn->prepare($sql);

        foreach ($keywordsArray as $index => $keyword) {
            $stmt->bindValue(':keyword', '%' . $keyword . '%', \PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }
}