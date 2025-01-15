<?php
// require_once '../../../models/Article.php';
// require_once '../../../models/themes.php';
// require_once '../../../models/tag.php';
// require_once '../../../models/comment.php';

// $articles = new Article();
// $themes = new Theme();
// $tags = new Tag();
// $comments = new Comment();

// $affArticles = $articles->getAllArticles();
// $affThemes = $themes->getAllThemes();
// $affComments = $comments->getAllComments();
// $affTags = $tags->getAllTags();
// $TotalArticles = $articles->countArticles();
// // var_dump($TotalArticles);
// $appArticles = $articles->appArticles();
// $penArticles = $articles->penArticles();
// $totalComm = $comments->countTotalComm();
// print_r($TotalArticles);

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     if (isset($_POST['action'])) {
//         $action = $_POST['action'];

//         switch ($action) {
//             case 'add_theme':
//                 $thm_nom = $_POST['themeName'];

//                 $themes->addTheme($thm_nom);
//                 break;
//             case 'update_theme':
//                 $thm_id = $_POST['thm_id'];
//                 $thm_nom = $_POST['thm_nom'];

//                 $themes->updateTheme($thm_nom, $thm_id);
//                 break;
//             case 'delete_theme': 
//                 $thm_id = $_POST['thm_id'];

//                 $themes->deleteTheme($thm_id);
//                 break;
//             case 'add_tag': 
//                 $nom = $_POST['nom'];

//                 $tags->addTag($nom);
//                 break;
//             case 'update_tag':
//                 $tag_id = $_POST['tag_id'];
//                 $nom = $_POST['nom'];

//                 $tags->updateTag($tag_id, $nom);
//         }
    // }
// }
// var_dump();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Admin Dashboard</title>
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
            background: white;
            border: 1px solid rgba(0, 0, 0, .125);
            height: 100%;
        }

        .statistics-card:hover {
            transform: scale(1.02);
        }

        .statistics-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: static;
                height: auto;
                width: 100%;
                padding-top: 0;
            }

            .main-content {
                margin-left: 0;
            }
        }

        .table-responsive {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Blog Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="adminDash.php">Location</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blogDash.php">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-box-arrow-right"></i> Logout</a>
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
                    <a class="nav-link active" href="#statistics">
                        <i class="bi bi-graph-up"></i> Statistics
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#articles">
                        <i class="bi bi-file-text"></i> Articles
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#comments">
                        <i class="bi bi-chat"></i> Comments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#themes">
                        <i class="bi bi-palette"></i> Themes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tags">
                        <i class="bi bi-tags"></i> Tags
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Statistics Section -->
        <div class="statistics-section">
            <h2 class="mb-4">Dashboard Overview</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="statistics-card">
                        <div class="card-body">
                            <h5 class="card-title text-muted">Total Articles</h5>
                            <p class="card-text display-4"><?= $TotalArticles ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="statistics-card">
                        <div class="card-body">
                            <h5 class="card-title text-muted">Approved Articles</h5>
                            <p class="card-text display-4"><?= $appArticles ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="statistics-card">
                        <div class="card-body">
                            <h5 class="card-title text-muted">Pending Articles</h5>
                            <p class="card-text display-4"><?= $penArticles ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="statistics-card">
                        <div class="card-body">
                            <h5 class="card-title text-muted">Total Comments</h5>
                            <p class="card-text display-4"><?= $totalComm ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Articles Section -->
        <div class="table-responsive">
            <div class="section-header">
                <h2>Articles</h2>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Creation Date</th>
                        <th>Author Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $statusLabels = [
                        0 => "Pending",
                        1 => "Approved",
                        -1 => "Declined"
                    ];

                    $statusStyles = [
                        0 => "background-color: grey; color: white;",
                        1 => "background-color: green; color: white;",
                        -1 => "background-color: red; color: white;"
                    ];
                    foreach ($affArticles as $article):
                    ?>
                        <tr>
                            <td><?= $article['art_id'] ?></td>
                            <td><?= $article['title'] ?></td>
                            <td><?= $article['creation_date'] ?></td>
                            <td><?= $article['author_name'] ?></td>
                            <td>
                            <td>
                                <div style="<?= $statusStyles[$article['status']] ?? '' ?>" class="badge">
                                    <?= $statusLabels[$article['status']] ?? "" ?>
                                </div>
                            </td></span></td>
                            <td class="d-flex gap-2">
                                <form method="POST" action="">
                                    <input type="hidden" name="action" value="accept_article">
                                    <input type="hidden" name="art_id" value="<?= $article['art_id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-success">Accept</button>
                                </form>

                                <!-- Decline Reservation Form -->
                                <form method="POST" action="">
                                    <input type="hidden" name="action" value="decline_article">
                                    <input type="hidden" name="art_id" value="<?= $article['art_id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Decline</button>
                                </form>
                            </td>
                        </tr>
                </tbody>
            <?php endforeach; ?>
            </table>
        </div>

        <!-- Comments Section -->
        <div class="table-responsive">
            <div class="section-header">
                <h2>Comments</h2>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Content</th>
                        <th>User ID</th>
                        <th>Article ID</th>
                        <th>Creation Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php foreach ($affComments as $comment): ?>
                    <tbody>
                        <tr>
                            <td><?= $comment['comm_id'] ?></td>
                            <td><?= $comment['content'] ?></td>
                            <td><?= $comment['user_id'] ?></td>
                            <td><?= $comment['art_id'] ?></td>
                            <td><?= $comment['creation_date'] ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="action" value="delete_comment">
                                    <input type="hidden" name="comm_id" value="<?= $comment['comm_id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            </table>
        </div>

        <!-- Themes Section -->
        <div class="table-responsive">
            <div class="section-header">
                <h2>Themes</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addThemeModal">
                    <i class="bi bi-plus-circle"></i> Add Theme
                </button>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php foreach ($affThemes as $theme): ?>
                    <tbody>
                        <tr>
                            <td><?= $theme['thm_id'] ?></td>
                            <td><?= $theme['thm_nom'] ?></td>
                            <td class="d-flex gap-2">
                                <button class="btn btn-sm btn-primary d-flex" data-bs-toggle="modal" data-bs-target="#updateThemeModal">Update</button>
                                <form method="POST" action="">
                                    <input type="hidden" name="action" value="delete_theme">
                                    <input type="hidden" name="thm_id" value="<?= $theme['thm_id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            </table>
        </div>

        <!-- Tags Section -->
        <div class="table-responsive">
            <div class="section-header">
                <h2>Tags</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTagModal">
                    <i class="bi bi-plus-circle"></i> Add Tag
                </button>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php foreach ($affTags as $tag): ?>
                    <tbody>
                        <tr>
                            <td><?= $tag['tag_id'] ?></td>
                            <td><?= $tag['nom'] ?></td>
                            <td class="d-flex gap-2">
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateTagModal">Update</button>
                                <form method="POST" action="">
                                    <input type="hidden" name="action" value="delete_tag">
                                    <input type="hidden" name="tag_id" value="<?= $tag['tag_id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <form method="POST" action="">
        <input type="hidden" name="action" value="delete_theme">
        <input type="hidden" name="thm_id" value="<?= $theme['thm_id'] ?>">
        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
    </form>

    <!-- Add Theme Modal -->
    <div class="modal fade" id="addThemeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Theme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" class="needs-validation" novalidate>
                        <input type="hidden" name="action" value="add_theme">
                        <div class="mb-3">
                            <label for="themeName" class="form-label">Theme Name</label>
                            <input type="text" class="form-control" name="themeName" id="themeName" required>
                            <div class="invalid-feedback">Please provide a theme name.</div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Theme</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Theme Modal -->
    <div class="modal fade" id="updateThemeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Theme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" class="needs-validation" novalidate>
                        <input type="hidden" name="action" value="update_theme">
                        <input type="hidden" name="thm_id" id="updateThemeId">
                        <div class="mb-3">
                            <label for="updateThemeName" class="form-label">Theme Name</label>
                            <input type="text" class="form-control" name="thm_nom" id="updateThemeName" required>
                            <div class="invalid-feedback">Please provide a theme name.</div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Theme</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Tag Modal -->
    <div class="modal fade" id="addTagModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addTagForm" class="needs-validation" method="POST" action="" novalidate>
                        <input type="hidden" name="action" value="add_tag">
                        <div class="mb-3">
                            <label for="tagName" class="form-label">Tag Name</label>
                            <input type="text" class="form-control" id="tagName" name="nom" required>
                            <div class="invalid-feedback">Please provide a tag name.</div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Tag</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Tag Modal -->
    <div class="modal fade" id="updateTagModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="updateTagForm" class="needs-validation" method="POST" action="" novalidate>
                        <input type="hidden" name="action" value="update_tag">
                        <input type="hidden" name="tag_id" id="updateTagId">
                        <div class="mb-3">
                            <label for="updateTagName" class="form-label">Tag Name</label>
                            <input type="text" class="form-control" id="updateTagName" name="nom" required>
                            <div class="invalid-feedback">Please provide a tag name.</div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Tag</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var updateButtons = document.querySelectorAll('.btn-primary[data-bs-target="#updateThemeModal"]');
            var updateTagBtn = document.querySelectorAll('.btn-primary[data-bs-target="#updateTagModal"]');


            updateButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var row = button.closest('tr');

                    var themeId = row.querySelector('td:nth-child(1)').textContent;

                    var themeName = row.querySelector('td:nth-child(2)').textContent;

                    document.getElementById('updateThemeId').value = themeId;

                    document.getElementById('updateThemeName').value = themeName;
                });
            });

            updateTagBtn.forEach (function (button) {
                button.addEventListener('click', function () {
                    var row = button.closest('tr');

                    var tagId = row.querySelector('td:nth-child(1)').textContent;

                    var nom = row.querySelector('td:nth-child(2)').textContent;

                    document.getElementById('updateTagId').value = tagId;
                    document.getElementById('updateTagName').value = nom;
                });
            });
        });
    </script>
</body>

</html>