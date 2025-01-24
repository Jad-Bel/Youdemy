<?php
require_once '../config/database.php';

use App\Database\Database;

// Create a database connection
$database = new Database();
$conn = $database->getConnection();
// Insert sample users
$users = [
    ['john_doe', 'john@example.com', password_hash('password123', PASSWORD_BCRYPT), 'student'],
    ['jane_doe', 'jane@example.com', password_hash('password123', PASSWORD_BCRYPT), 'teacher'],
    ['admin', 'admin@example.com', password_hash('admin123', PASSWORD_BCRYPT), 'admin']
];

foreach ($users as $user) {
    $sql = "INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'username' => $user[0],
        'email' => $user[1],
        'password' => $user[2],
        'role' => $user[3]
    ]);
}

// Insert sample categories
$categories = ['Programming', 'Design', 'Business'];

foreach ($categories as $category) {
    $sql = "INSERT INTO categories (name) VALUES (:name)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['name' => $category]);
}

// Insert sample tags
$tags = ['PHP', 'JavaScript', 'Python', 'Web Development'];

foreach ($tags as $tag) {
    $sql = "INSERT INTO tags (name) VALUES (:name)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['name' => $tag]);
}

echo "Database populated with test data!<br>";
?>