<?php
require_once '../config/database.php';
require_once '../classes/user.php';
require_once '../classes/admin/student.php';
require_once '../classes/admin/teacher.php';
require_once '../classes/admin/admin.php';
require_once '../classes/admin/category.php';
require_once '../classes/admin/tag.php';




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin = new Admin('test', 'test@test.com', 'test', 'admin');

    switch ($_POST['action']) {
        case 'accept_teacher':
            $teacherData = User::findByEmail($_POST['email']);
            if ($teacherData) {
                $admin->acceptTeacher($teacherData['id']);
                echo "Teacher accepted successfully!";
            } else {
                throw new Exception("Teacher not found.");
            }
            break;

        case 'refuse_teacher':
            $teacherData = User::findByEmail($_POST['email']);
            if ($teacherData) {
                $admin->declineTeacher($teacherData['id']);
                echo "Teacher declined successfully!";
            } else {
                throw new Exception("Teacher not found.");
            }
            break;

        case 'ban_user':
            $userData = User::findByEmail($_POST['email']);
            if ($userData) {
                $admin->banUser($userData['id']);
                echo "User banned successfully!";
            } else {
                throw new Exception("User not found.");
            }
            break;

        case 'unban_user':
            $userData = User::findByEmail($_POST['email']);
            if ($userData) {
                $admin->unbanUser($userData['id']);
                echo "User unbanned successfully!";
            } else {
                throw new Exception("User not found.");
            }
            break;

        case 'delete_user':
            $userData = User::findByEmail($_POST['email']);
            if ($userData) {
                $admin->deleteUser($userData['email']);
                echo "User deleted successfully!";
            } else {
                throw new Exception("User not found.");
            }
            break;

        case 'add_course':
            break;
        case 'modify_course':
            break;
        case 'delete_course':
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
            $categories = new Category();
            $id = $_POST['id'];

            $categories->deleteCategory($id);
            break;

        case 'add_tags':
            $tags = new Tag();
            $name = $_POST['name'];

            $tags->createTag($name);
            break;
        case 'modify_tag':
            $tags = new Tag();
            $id = $_POST['id'];
            $name = $_POST['name'];

            $tags->updateTag($id, $name);
            break;
        case 'delete_tag':
            $tags = new Tag();
            $id = $_POST['id'];

            $tags->deleteTag($id);
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 56px;
            background-color: #f8f9fa;
            z-index: 100;
            width: 250px;
        }

        .main-content {
            margin-left: 250px;
            padding: 56px 20px 20px 20px;
        }

        .statistics-card {
            transition: transform 0.3s;
        }

        .statistics-card:hover {
            transform: scale(1.02);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="bi bi-box-arrow-right"></i> Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="position-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#teacher-validation">
                        <i class="bi bi-person-check"></i> Validation Enseignants
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#user-management">
                        <i class="bi bi-people"></i> Gestion Utilisateurs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#course-management">
                        <i class="bi bi-book"></i> Gestion Cours
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#category-management">
                        <i class="bi bi-folder"></i> Gestion Catégories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tag-management">
                        <i class="bi bi-tags"></i> Gestion Tags
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#global-stats">
                        <i class="bi bi-graph-up"></i> Statistiques Globales
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Global Stats Section -->
        <section id="global-stats" class="mb-4">
            <h2>Statistiques Globales</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card statistics-card">
                        <div class="card-body">
                            <h5 class="card-title">Total Utilisateurs</h5>
                            <p class="card-text display-4">150</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card statistics-card">
                        <div class="card-body">
                            <h5 class="card-title">Total Cours</h5>
                            <p class="card-text display-4">45</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card statistics-card">
                        <div class="card-body">
                            <h5 class="card-title">Enseignants Actifs</h5>
                            <p class="card-text display-4">12</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card statistics-card">
                        <div class="card-body">
                            <h5 class="card-title">Étudiants Actifs</h5>
                            <p class="card-text display-4">120</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Teacher Validation Section -->
        <section id="teacher-validation" class="mb-4">
            <h2>Validation des comptes Enseignants</h2>
            <div class="table-responsive">
                <table class="table">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Date demande</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $currentUser = new Admin('test', 'test@test.com', 'test', 'admin');
                        $allTeacher = User::getAllTeachers($currentUser);

                        foreach ($allTeacher as $teacher):
                        ?>
                            <tr>
                                <td><?= $teacher['id'] ?></td>
                                <td><?= $teacher['username'] ?></td>
                                <td><?= $teacher['email'] ?></td>
                                <td><?= $teacher['created_at'] ?></td>
                                <td><?= $teacher['status'] ?></td>
                                <td>
                                    <form method="POST" action="" style="display:inline;">
                                        <input type="hidden" name="action" value="accept_teacher">
                                        <input type="hidden" name="email" value="<?= $teacher['email'] ?>">
                                        <button type="submit" class="btn btn-success btn-sm">Accepter</button>
                                    </form>
                                    <form method="POST" action="" style="display:inline;">
                                        <input type="hidden" name="action" value="refuse_teacher">
                                        <input type="hidden" name="email" value="<?= $teacher['email'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Refuser</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- User Management Section -->
        <section id="user-management" class="mb-4">
            <h2>Gestion des utilisateurs</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Type</th>
                            <th>Role</th>
                            <th>Date Creation</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $currentUser = new Admin('test', 'test@test.com', 'test', 'admin');
                            $allUsers = User::getAllUsers($currentUser);

                            foreach ($allUsers as $user):
                            ?>
                                <td><?= $user['id'] ?></td>
                                <td><?= $user['username'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><?= $user['role'] ?></td>
                                <td><?= $user['created_at'] ?></td>
                                <td><?= $user['status'] ?></td>
                                <td>
                                    <form method="POST" action="" style="display:inline;">
                                        <input type="hidden" name="action" value="ban_user">
                                        <input type="hidden" name="email" value="<?= $user['email'] ?>">
                                        <button type="submit" class="btn btn-warning btn-sm">Bannir</button>
                                    </form>
                                    <form method="POST" action="" style="display:inline;">
                                        <input type="hidden" name="action" value="unban_user">
                                        <input type="hidden" name="email" value="<?= $user['email'] ?>">
                                        <button type="submit" class="btn btn-success btn-sm">Débannir</button>
                                    </form>
                                    <form method="POST" action="" style="display:inline;">
                                        <input type="hidden" name="action" value="delete_user">
                                        <input type="hidden" name="email" value="<?= $user['email'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
                                </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Course Management Section -->
        <section id="course-management" class="mb-4">
            <h2>Gestion des cours</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Enseignant</th>
                            <th>Catégorie</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Introduction PHP</td>
                            <td>John Doe</td>
                            <td>Programmation</td>
                            <td>
                                <form method="POST" action="" style="display:inline;">
                                    <input type="hidden" name="action" value="modify_course">
                                    <input type="hidden" name="course_id" value="1">
                                    <button type="submit" class="btn btn-primary btn-sm">Modifier</button>
                                </form>
                                <form method="POST" action="" style="display:inline;">
                                    <input type="hidden" name="action" value="delete_course">
                                    <input type="hidden" name="course_id" value="1">
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>


        <!-- Category Management Section -->
        <section id="category-management" class="mb-4">
            <h2>Gestion des catégories</h2>
            <button class="btn btn-primary mb-3" id="addCategoryBtn">Ajouter une catégorie</button>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>created_at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $category = new Category();
                        $categories = $category->getAllCategories();

                        foreach ($categories as $category):
                        ?>
                            <tr>
                                <td><?= $category['id'] ?></td>
                                <td><?= $category['name'] ?></td>
                                <td><?= $category['created_at'] ?></td>
                                <td>
                                    <button class="btn btn-primary btn-sm editCategoryBtn" data-id="1" data-name="Programmation">Modifier</button>
                                    <form method="POST" action="" style="display:inline;">
                                        <input type="hidden" name="action" value="delete_category">
                                        <input type="hidden" name="category_id" value="1">
                                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Tag Management Section -->
        <section id="tag-management" class="mb-4">
            <h2>Gestion des tags</h2>
            <button class="btn btn-primary mb-3" onclick="showAddTagsModal()">Ajouter en masse</button>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Date Creation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $tags = new Tag();
                            foreach ($tags as $tag):
                        ?>
                        <tr>
                            <td><?= $tag['id'] ?></td>
                            <td><?= $tag['name'] ?></td>
                            <td><?= $tag['created_at'] ?></td>
                            <td>
                                <form method="POST" action="" class="d-inline">
                                    <input type="hidden" name="action" value="modify_tag">
                                    <input type="hidden" name="tag_id" value="1">
                                    <button type="submit" class="btn btn-primary btn-sm">Modifier</button>
                                </form>
                                <form method="POST" action="" class="d-inline">
                                    <input type="hidden" name="action" value="delete_tag">
                                    <input type="hidden" name="tag_id" value="1">
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </section>


    </div>

    <!-- Modals for Add/Edit operations -->
    <!-- Add Category Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalTitle">Ajouter une catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="categoryForm" method="POST">
                        <input type="hidden" name="action" value="add_category">
                        <input type="hidden" name="id" id="categoryId" value="">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Nom de la catégorie</label>
                            <input type="text" name="name" class="form-control" id="categoryName" required>
                            <div class="invalid-feedback">
                                Le nom de la catégorie doit contenir uniquement des lettres, des chiffres, des espaces et des tirets.
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Tags Modal -->
    <div class="modal fade" id="tagsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter des tags</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="tagsForm">
                        <div class="mb-3">
                            <label for="tagsList" class="form-label">Tags (séparés par des virgules)</label>
                            <textarea class="form-control" id="tagsList" rows="3" required></textarea>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryModal = new bootstrap.Modal(document.getElementById('categoryModal'));
            const categoryForm = document.getElementById('categoryForm');
            const categoryNameInput = document.getElementById('categoryName');
            const categoryModalTitle = document.getElementById('categoryModalTitle');
            const categoryIdInput = document.getElementById('categoryId');

            const categoryNameRegex = /^[a-zA-Z0-9\s-]+$/;

            document.getElementById('addCategoryBtn').addEventListener('click', function() {
                categoryModalTitle.textContent = 'Ajouter une catégorie';
                categoryForm.action.value = 'add_category';
                categoryIdInput.value = '';
                categoryNameInput.value = '';
                categoryModal.show();
            });

            document.querySelectorAll('.editCategoryBtn').forEach(button => {
                button.addEventListener('click', function() {
                    const categoryId = this.getAttribute('data-id');
                    const categoryName = this.getAttribute('data-name');
                    categoryModalTitle.textContent = 'Modifier la catégorie';
                    categoryForm.action.value = 'modify_category';
                    categoryIdInput.value = categoryId;
                    categoryNameInput.value = categoryName;
                    categoryModal.show();
                });
            });

            categoryNameInput.addEventListener('input', function() {
                if (categoryNameRegex.test(this.value)) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                }
            });

            categoryForm.addEventListener('submit', function(e) {
                if (!categoryNameRegex.test(categoryNameInput.value)) {
                    e.preventDefault();
                    categoryNameInput.classList.add('is-invalid');
                }
            });

            document.getElementById('tagsForm')?.addEventListener('submit', function(e) {
                e.preventDefault();
            });
        });
    </script>
</body>

</html>