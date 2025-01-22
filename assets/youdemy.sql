CREATE DATABASE IF NOT EXISTS youdemy;
USE youdemy;
CREATE TABLE `categories` (
    `id` int NOT NULL,
    `name` varchar(100) NOT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`)
VALUES (
        1,
        'Programmation ',
        '2025-01-14 16:54:40',
        '2025-01-17 21:02:53'
    ),
    (
        2,
        'Design',
        '2025-01-14 16:54:40',
        '2025-01-14 16:54:40'
    ),
    (
        3,
        'Business',
        '2025-01-14 16:54:40',
        '2025-01-14 16:54:40'
    );
CREATE TABLE `courses` (
    `id` int NOT NULL,
    `title` varchar(255) NOT NULL,
    `description` text NOT NULL,
    `content` varchar(255) DEFAULT NULL,
    `document_link` varchar(255) DEFAULT NULL,
    `video_link` varchar(255) DEFAULT NULL,
    `teacher_id` int NOT NULL,
    `category_id` int NOT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `type` enum('video', 'document') DEFAULT NULL,
    `course_bnr` varchar(255) NOT NULL,
    `status` enum('pending', 'approved', 'declined') DEFAULT 'pending',
    `certification` varchar(255) DEFAULT NULL,
    `skill_level` enum('beginner', 'intermediate', 'advanced') NOT NULL,
    `duration` time DEFAULT NULL,
    `language` varchar(50) NOT NULL
)
INSERT INTO `courses` (
        `id`,
        `title`,
        `description`,
        `content`,
        `document_link`,
        `video_link`,
        `teacher_id`,
        `category_id`,
        `created_at`,
        `updated_at`,
        `type`,
        `course_bnr`,
        `status`,
        `certification`,
        `skill_level`,
        `duration`,
        `language`
    )
VALUES (
        13,
        'Advanced PHP Programming',
        'Learn advanced PHP concepts and techniques',
        NULL,
        'https://example.com/advanced-php.pdf',
        '',
        2,
        3,
        '2025-01-15 07:50:06',
        '2025-01-18 01:14:34',
        'document',
        'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/PHP_Logo.png/640px-PHP_Logo.png',
        'approved',
        NULL,
        'beginner',
        NULL,
        ''
    ),
    (
        14,
        'Advanced PHP Programming',
        'Learn advanced PHP concepts and techniques',
        NULL,
        'https://docs.google.com/document/d/1Ps_RuUKLSOc4RjTnnMI4Xu17lKBA1koeykYuob76jeE/edit?tab=t.0#heading=h.olaiqff762pw',
        '',
        2,
        3,
        '2025-01-15 07:50:48',
        '2025-01-18 16:15:55',
        'document',
        'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/PHP_Logo.png/640px-PHP_Logo.png',
        'approved',
        NULL,
        'beginner',
        NULL,
        ''
    ),
    (
        33,
        'Introduction to Web Development',
        'Learn the basics of HTML, CSS, and JavaScript.',
        NULL,
        'https://example.com/web-development.pdf',
        'https://www.youtube.com/watch?v=C0cgGRDD2Mw',
        2,
        1,
        '2025-01-16 08:00:00',
        '2025-01-19 20:11:40',
        'document',
        'https://upload.wikimedia.org/wikipedia/commons/e/eb/HTML5_Logo_512.png',
        'approved',
        NULL,
        'beginner',
        NULL,
        ''
    ),
    (
        34,
        'Advanced PHP Programming',
        'Learn advanced PHP concepts and techniques.',
        NULL,
        'https://example.com/advanced-php.pdf',
        'https://www.youtube.com/watch?v=OK_JCtrrv-c',
        2,
        2,
        '2025-01-16 09:00:00',
        '2025-01-18 16:16:02',
        'document',
        'https://upload.wikimedia.org/wikipedia/commons/2/27/PHP-logo.svg',
        'approved',
        NULL,
        'beginner',
        NULL,
        ''
    ),
    (
        58,
        'Introduction to Web Development',
        'Learn the basics of HTML, CSS, and JavaScript.',
        NULL,
        'https://example.com/web-development.pdf',
        'https://www.youtube.com/watch?v=dD2EISBDjWM',
        2,
        1,
        '2025-01-16 08:00:00',
        '2025-01-18 16:35:48',
        'document',
        'https://via.placeholder.com/600x300',
        'approved',
        NULL,
        'beginner',
        NULL,
        ''
    ),
    (
        59,
        'Advanced PHP Programming',
        'Learn advanced PHP concepts and techniques.',
        NULL,
        'https://example.com/advanced-php.pdf',
        'https://www.youtube.com/watch?v=OK_JCtrrv-c',
        2,
        1,
        '2025-01-16 09:00:00',
        '2025-01-18 16:35:52',
        'document',
        'https://via.placeholder.com/600x300',
        'approved',
        NULL,
        'beginner',
        NULL,
        ''
    ),
    (
        60,
        'Mastering Python',
        'Comprehensive Python programming for data science and web development.',
        NULL,
        'https://example.com/python-guide.pdf',
        'https://www.youtube.com/watch?v=rfscVS0vtbw',
        2,
        1,
        '2025-01-16 10:00:00',
        '2025-01-18 16:35:56',
        'document',
        'https://via.placeholder.com/600x300',
        'approved',
        NULL,
        'beginner',
        NULL,
        ''
    ),
    (
        61,
        'JavaScript Essentials',
        'Discover the core concepts of JavaScript for modern web development.',
        NULL,
        'https://docs.google.com/document/d/1HjSDF1234567890/edit',
        'https://www.youtube.com/watch?v=W6NZfCO5SIk',
        2,
        1,
        '2025-01-16 11:00:00',
        '2025-01-18 16:35:59',
        'document',
        'https://via.placeholder.com/600x300',
        'approved',
        NULL,
        'beginner',
        NULL,
        ''
    ),
    (
        62,
        'Introduction to Databases',
        'Learn database fundamentals, SQL, and database design.',
        NULL,
        'https://example.com/sql-basics.pdf',
        'https://www.youtube.com/watch?v=HXV3zeQKqGY',
        2,
        1,
        '2025-01-16 12:00:00',
        '2025-01-18 16:36:02',
        'document',
        'https://via.placeholder.com/600x300',
        'approved',
        NULL,
        'beginner',
        NULL,
        ''
    ),
    (
        63,
        'Machine Learning Basics',
        'Understand the foundations of machine learning and its applications.',
        NULL,
        'https://example.com/machine-learning.pdf',
        'https://www.youtube.com/watch?v=GwIo3gDZCVQ',
        2,
        1,
        '2025-01-16 13:00:00',
        '2025-01-17 15:34:00',
        'document',
        'https://via.placeholder.com/600x300',
        'pending',
        NULL,
        'beginner',
        NULL,
        ''
    ),
    (
        64,
        'Cloud Computing 101',
        'Learn the basics of cloud computing and popular services like AWS and Azure.',
        NULL,
        'https://example.com/cloud-computing.pdf',
        'https://www.youtube.com/watch?v=2LaAJq1lB4Q',
        2,
        1,
        '2025-01-16 14:00:00',
        '2025-01-17 15:34:00',
        'document',
        'https://via.placeholder.com/600x300',
        'pending',
        NULL,
        'beginner',
        NULL,
        ''
    ),
    (
        65,
        'Cybersecurity Essentials',
        'Protect systems and networks with fundamental cybersecurity techniques.',
        NULL,
        'https://example.com/cybersecurity.pdf',
        'https://www.youtube.com/watch?v=JsmfB0u-A0o',
        2,
        1,
        '2025-01-16 15:00:00',
        '2025-01-17 15:34:00',
        'document',
        'https://via.placeholder.com/600x300',
        'pending',
        NULL,
        'beginner',
        NULL,
        ''
    ),
    (
        66,
        'ReactJS for Beginners',
        'Build powerful front-end applications using ReactJS.',
        NULL,
        'https://example.com/reactjs-guide.pdf',
        'https://www.youtube.com/watch?v=w7ejDZ8SWv8',
        2,
        1,
        '2025-01-16 16:00:00',
        '2025-01-17 15:34:00',
        'document',
        'https://via.placeholder.com/600x300',
        'pending',
        NULL,
        'beginner',
        NULL,
        ''
    );
CREATE TABLE `course_tags` (
    `course_id` int NOT NULL,
    `tag_id` int NOT NULL
) CREATE TABLE `enrollments` (
    `id` int NOT NULL,
    `course_id` int NOT NULL,
    `enrolled_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
)
INSERT INTO `enrollments` (`id`, `course_id`, `enrolled_at`)
VALUES (7, 13, '2025-01-19 16:25:42'),
    (7, 14, '2025-01-19 21:40:24'),
    (7, 33, '2025-01-19 19:53:03');
CREATE TABLE `statistics` (
    `id` int NOT NULL,
    `course_id` int NOT NULL,
    `student_count` int DEFAULT '0',
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) CREATE TABLE `tags` (
    `id` int NOT NULL,
    `name` varchar(100) NOT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`)
VALUES (
        2,
        'JavaScript',
        '2025-01-14 16:54:40',
        '2025-01-14 16:54:40'
    ),
    (
        3,
        'Python',
        '2025-01-14 16:54:40',
        '2025-01-14 16:54:40'
    ),
    (
        4,
        'Web Development',
        '2025-01-14 16:54:40',
        '2025-01-14 16:54:40'
    ),
    (
        7,
        'Java',
        '2025-01-17 10:52:44',
        '2025-01-17 11:08:02'
    ),
    (
        8,
        'Youtube',
        '2025-01-17 10:52:44',
        '2025-01-17 11:08:09'
    );
CREATE TABLE `users` (
    `id` int NOT NULL,
    `username` varchar(50) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(255) NOT NULL,
    `role` enum('student', 'teacher', 'admin') NOT NULL,
    `status` enum('pending', 'active', 'suspended') DEFAULT 'pending',
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
INSERT INTO `users` (
        `id`,
        `username`,
        `email`,
        `password`,
        `role`,
        `status`,
        `created_at`,
        `updated_at`
    )
VALUES (
        2,
        'jane_doe',
        'jane@example.com',
        '$2y$10$/8td/j5P52z8Rf5Z9HnsAOAACOJAo4RAu0H2MD/8y7WSdAtg/czue',
        'teacher',
        'active',
        '2025-01-14 16:54:40',
        '2025-01-16 22:46:04'
    ),
    (
        3,
        'admin',
        'admin@example.com',
        '$2y$10$/0iqfZSLgLaC3NMky7sgBObfQNWwNXxVLsDWta3.1teZ98ySybxze',
        'admin',
        'pending',
        '2025-01-14 16:54:40',
        '2025-01-14 16:54:40'
    ),
    (
        4,
        'test',
        'test@test.com',
        '$2y$10$uor3v8OmxXPHIe2ZsH9Jv.J3qoy0qVOttoBRI5QgYm.Kf2wpLZSdi',
        'student',
        'pending',
        '2025-01-15 21:46:39',
        '2025-01-15 21:46:39'
    ),
    (
        6,
        'Youssef Ghoraibil',
        'yousGH@user.com',
        '$2y$10$omyG/.18gC5wbXObA7ZJMu5cbUB6PwXHAq2MaQHk5U0PF6eJBMom2',
        'student',
        'active',
        '2025-01-17 18:01:00',
        '2025-01-17 19:02:51'
    ),
    (
        7,
        'taha jaiti',
        'taha@user.com',
        '$2y$10$qs2D6C/rvnhjoRs/uJ4XVurjee9Bgb94q5.KZHLapQB0a/ukgRor.',
        'student',
        'pending',
        '2025-01-19 14:14:15',
        '2025-01-19 14:14:15'
    );
ALTER TABLE `categories`
ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `name` (`name`);
ALTER TABLE `courses`
ADD PRIMARY KEY (`id`),
    ADD KEY `teacher_id` (`teacher_id`),
    ADD KEY `category_id` (`category_id`);
ALTER TABLE `course_tags`
ADD PRIMARY KEY (`course_id`, `tag_id`),
    ADD KEY `tag_id` (`tag_id`);
ALTER TABLE `enrollments`
ADD PRIMARY KEY (`id`, `course_id`),
    ADD KEY `course_id` (`course_id`);
ALTER TABLE `statistics`
ADD PRIMARY KEY (`id`),
    ADD KEY `course_id` (`course_id`);
ALTER TABLE `tags`
ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `name` (`name`);
ALTER TABLE `users`
ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `email` (`email`);
ALTER TABLE `categories`
MODIFY `id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 7;
ALTER TABLE `courses`
MODIFY `id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 84;
ALTER TABLE `statistics`
MODIFY `id` int NOT NULL AUTO_INCREMENT;
ALTER TABLE `tags`
MODIFY `id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 13;
ALTER TABLE `users`
MODIFY `id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 8;
ALTER TABLE `courses`
ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
ALTER TABLE `course_tags`
ADD CONSTRAINT `course_tags_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
    ADD CONSTRAINT `course_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;
ALTER TABLE `enrollments`
ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;
ALTER TABLE `statistics`
ADD CONSTRAINT `statistics_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;