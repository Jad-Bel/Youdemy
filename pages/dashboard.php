<?php
// Required database connections and model includes would go here
// session_start();

// Check if user is logged in and is admin
// if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
//     header('Location: login.php');
//     exit();
// }

// Handle POST requests for all admin actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($_POST['action']) {
        // Teacher account validation
        case 'accept_teacher':
            // Accept teacher account logic
            break;
        case 'refuse_teacher':
            // Refuse teacher account logic
            break;
            
        // User management
        case 'ban_user':
            // Ban user logic
            break;
        case 'unban_user':
            // Unban user logic
            break;
        case 'delete_user':
            // Delete user logic
            break;
            
        // Course management
        case 'add_course':
            // Add course logic
            break;
        case 'modify_course':
            // Modify course logic
            break;
        case 'delete_course':
            // Delete course logic
            break;
            
        // Category management
        case 'add_category':
            // Add category logic
            break;
        case 'modify_category':
            // Modify category logic
            break;
        case 'delete_category':
            // Delete category logic
            break;
            
        // Tag management
        case 'add_tags':
            // Add multiple tags logic
            break;
        case 'modify_tag':
            // Modify tag logic
            break;
        case 'delete_tag':
            // Delete tag logic
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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- PHP foreach for pending teacher accounts -->
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>2023-10-15</td>
                            <td>
                                <button class="btn btn-success btn-sm" onclick="acceptTeacher(1)">Accepter</button>
                                <button class="btn btn-danger btn-sm" onclick="refuseTeacher(1)">Refuser</button>
                            </td>
                        </tr>
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
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Jane Doe</td>
                            <td>Étudiant</td>
                            <td>Actif</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="banUser(1)">Bannir</button>
                                <button class="btn btn-success btn-sm" onclick="unbanUser(1)">Débannir</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteUser(1)">Supprimer</button>
                            </td>
                        </tr>
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
                                <button class="btn btn-primary btn-sm" onclick="modifyCourse(1)">Modifier</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteCourse(1)">Supprimer</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Category Management Section -->
        <section id="category-management" class="mb-4">
            <h2>Gestion des catégories</h2>
            <button class="btn btn-primary mb-3" onclick="showAddCategoryModal()">Ajouter une catégorie</button>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Programmation</td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick="modifyCategory(1)">Modifier</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteCategory(1)">Supprimer</button>
                            </td>
                        </tr>
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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>PHP</td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick="modifyTag(1)">Modifier</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteTag(1)">Supprimer</button>
                            </td>
                        </tr>
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
                    <h5 class="modal-title">Ajouter une catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="categoryForm">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Nom de la catégorie</label>
                            <input type="text" class="form-control" id="categoryName" required>
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
        function acceptTeacher(id) {
            if(confirm('Confirmer l\'acceptation de cet enseignant ?')) {
            }
        }

        function refuseTeacher(id) {
            if(confirm('Confirmer le refus de cet enseignant ?')) {
            }
        }

        function banUser(id) {
            if(confirm('Confirmer le bannissement de cet utilisateur ?')) {
            }
        }

        function unbanUser(id) {
            if(confirm('Confirmer le débannissement de cet utilisateur ?')) {
                // AJAX call to unban user
            }
        }

        function deleteUser(id) {
            if(confirm('Confirmer la suppression de cet utilisateur ?')) {
                // AJAX call to delete user
            }
        }

        function modifyCourse(id) {
            // Show course modification modal
        }

        function deleteCourse(id) {
            if(confirm('Confirmer la suppression de ce cours ?')) {
                // AJAX call to delete course
            }
        }

        function showAddCategoryModal() {
            new bootstrap.Modal(document.getElementById('categoryModal')).show();
        }

        function showAddTagsModal() {
            new bootstrap.Modal(document.getElementById('tagsModal')).show();
        }

        // Form submission handlers
        document.getElementById('categoryForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            // Handle category form submission
        });

        document.getElementById('tagsForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            // Handle tags form submission
        });
    </script>
</body>
</html>

