<?php

namespace App\Controllers\Admin;

use App\Model\Admin\Admin;
use App\Model\User\User;
use App\Model\Category\Category;
use App\Model\Tag\Tag;
use App\Model\Course\ConcreteCourse;
use App\Model\CourseService\CourseService;

class AdminController
{
    private $currentUser;
    private $courseModal;
    private $courses;

    public function __construct()
    {
        $this->courseModal = new ConcreteCourse();
        $this->courses = new CourseService($this->courseModal, null);
        $this->currentUser = new Admin(null,null,null,null,null);
    }

    public function dashboard()
    {
        $statistics = $this->currentUser->getStatistics();
        $coursesCount = $statistics[0]->count;
        $popularCourse = $statistics[1]->count;

        $teacherData = User::getAllTeachers($this->currentUser);

        $userData = User::getAllUsers($this->currentUser);

        $courseModal = new ConcreteCourse(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $courses = new CourseService($courseModal, NULL);
        $allCourses = $courses->getAllCourses();

        $category = new Category();
        $categories = $category->getAllCategories();

        $tag = new Tag();
        $tags = $tag->getAllTags();

        require_once __DIR__ . '/../../Views/dashboard.php';
    }

    public function handlePostRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            switch ($_POST['action']) {
                case 'accept_teacher':
                    $teacherData = User::findByEmail($_POST['email']);
                    if ($teacherData) {
                        $this->currentUser->acceptTeacher($teacherData['id']);
                        echo "Teacher accepted successfully!";
                    } else {
                        throw new \Exception("Teacher not found.");
                    }
                    break;

                case 'refuse_teacher':
                    $teacherData = User::findByEmail($_POST['email']);
                    if ($teacherData) {
                        $this->currentUser->declineTeacher($teacherData['id']);
                        echo "Teacher declined successfully!";
                    } else {
                        throw new \Exception("Teacher not found.");
                    }
                    break;

                case 'ban_user':
                    $userData = User::findByEmail($_POST['email']);
                    if ($userData) {
                        $this->currentUser->banUser($userData['id']);
                        echo "User banned successfully!";
                    } else {
                        throw new \Exception("User not found.");
                    }
                    break;

                case 'unban_user':
                    $userData = User::findByEmail($_POST['email']);
                    if ($userData) {
                        $this->currentUser->unbanUser($userData['id']);
                        echo "User unbanned successfully!";
                    } else {
                        throw new \Exception("User not found.");
                    }
                    break;

                case 'approve_course':
                    $id = $_POST['id'];
                    $this->currentUser->approve($id);
                    break;

                case 'delete_user':
                    $userData = User::findByEmail($_POST['email']);
                    if ($userData) {
                        $this->currentUser->deleteUser($userData['email']);
                        echo "User deleted successfully!";
                    } else {
                        throw new \Exception("User not found.");
                    }
                    break;

                case 'decline_course':
                    $id = $_POST['id'];
                    $this->currentUser->decline($id);
                    break;

                case 'delete_course':
                    $id = $_POST['id'];
                    $this->currentUser->deleteCourse($id);
                    break;

                case 'add_category':
                    $categories = new Category();
                    $name = $_POST['name'];
                    $categories->createCategory($name);
                    break;

                case 'modify_category':
                    $categories = new Category();
                    $id = $_POST['id'];
                    $name = $_POST['name'];
                    $categories->updateCategory($id, $name);
                    break;

                case 'delete_category':
                    $id = $_POST['category_id'];
                    $categories = new Category();
                    $categories->deleteCategory($id);
                    break;

                case 'add_tags':
                    $tags = new Tag();
                    if (isset($_POST['tag_name']) && is_array($_POST['tag_name'])) {
                        foreach ($_POST['tag_name'] as $name) {
                            if (!empty($name)) {
                                $tagId = $tags->createTag($name);
                            }
                        }
                    } else {
                        echo "No tags provided.";
                    }
                    break;

                case 'modify_tag':
                    $tags = new Tag();
                    $id = $_POST['id'];
                    $name = $_POST['name'];
                    $tags->updateTag($id, $name);
                    break;

                case 'delete_tag':
                    $id = $_POST['tag_id'];
                    $tags = new Tag();
                    $tags->deleteTag($id);
                    break;

                default:
                    throw new \Exception("Invalid action.");
            }
        }
    }
}