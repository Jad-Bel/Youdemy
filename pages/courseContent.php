<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Structures & Algorithms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .course-sidebar {
            background: #f8f9fa;
            height: 100vh;
            overflow-y: auto;
        }
        
        .video-container {
            background: #7952b3;
            aspect-ratio: 16/9;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .section-title {
            padding: 15px;
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            cursor: pointer;
        }
        
        .section-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        
        .section-content.show {
            max-height: 1000px;
        }
        
        .lecture-item {
            padding: 10px 15px 10px 30px;
            cursor: pointer;
            border-bottom: 1px solid #e9ecef;
            transition: background-color 0.2s;
        }
        
        .lecture-item:hover {
            background-color: #e9ecef;
        }
        
        .course-tabs {
            border-bottom: 1px solid #dee2e6;
        }
        
        .tab-button {
            padding: 15px 20px;
            border: none;
            background: none;
            color: #6c757d;
            position: relative;
        }
        
        .tab-button.active {
            color: #000;
            font-weight: 500;
        }
        
        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: #7952b3;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Main Content -->
            <div class="col-md-8 p-0">
                <!-- Video Player -->
                <div class="video-container">
                    <img src="/api/placeholder/100/100" alt="Play Button" style="width: 80px; height: 80px;">
                </div>
                
                <!-- Course Navigation -->
                <div class="course-tabs d-flex">
                    <button class="tab-button active">Overview</button>
                    <button class="tab-button">Notes</button>
                    <button class="tab-button">Announcements</button>
                    <button class="tab-button">Reviews</button>
                    <button class="tab-button">Learning tools</button>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4 course-sidebar p-0">
                <div class="section-title" data-section="1">
                    <div class="d-flex justify-content-between">
                        <div>Section 3: Classes & Pointers</div>
                        <div class="text-muted">2/2 | 13min</div>
                    </div>
                </div>
                <div class="section-content" id="section1">
                    <div class="lecture-item">
                        <div class="d-flex justify-content-between">
                            <div>1. Introduction to Classes</div>
                            <div class="text-muted">6:30</div>
                        </div>
                    </div>
                    <div class="lecture-item">
                        <div class="d-flex justify-content-between">
                            <div>2. Working with Pointers</div>
                            <div class="text-muted">6:30</div>
                        </div>
                    </div>
                </div>

                <div class="section-title" data-section="2">
                    <div class="d-flex justify-content-between">
                        <div>Section 4: Linked Lists</div>
                        <div class="text-muted">17/17 | 1hr 19min</div>
                    </div>
                </div>
                <div class="section-content" id="section2">
                    <div class="lecture-item">
                        <div class="d-flex justify-content-between">
                            <div>1. Linked List Basics</div>
                            <div class="text-muted">7:15</div>
                        </div>
                    </div>
                    <div class="lecture-item">
                        <div class="d-flex justify-content-between">
                            <div>2. Implementing a Linked List</div>
                            <div class="text-muted">8:45</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.section-title').forEach(title => {
            title.addEventListener('click', () => {
                const sectionId = title.dataset.section;
                const content = document.querySelector(`#section${sectionId}`);
                content.classList.toggle('show');
            });
        });

        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelectorAll('.tab-button').forEach(btn => {
                    btn.classList.remove('active');
                });
                button.classList.add('active');
            });
        });

        document.querySelectorAll('.lecture-item').forEach(item => {
            item.addEventListener('click', () => {
                console.log('Playing lecture:', item.querySelector('div').textContent);
            });
        });
    </script>
</body>
</html>