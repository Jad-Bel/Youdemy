<?php 

// require_once '../user.php';

class Admin extends User {
    public function __construct($username, $email, $password, $role)
    {
        parent::__construct($username, $email, $password, 'admin');
    }

    private function updateUserStatus($id, $status) {
        $sql = "UPDATE users SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['status' => $status, 'id' => $id]);
    }

    public function banUser ($id) {
        $this->updateUserStatus($id, 'suspended');
    }

    public function unbanUser($id) {
        $this->updateUserStatus($id, 'active');
    }

    public function deleteUser($id) {
        if ($this->id == $id) {
            throw new Exception('Admin cannot delete themselves');
        }
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
    }

    public function acceptTeacher($id) {
        $this->updateUserStatus($id, 'active');
    }

    public function declineTeacher($id) {
        $this->updateUserStatus($id, 'declined');
    }
}