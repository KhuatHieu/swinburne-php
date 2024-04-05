<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Assignment Part 1">
    <meta name="keywords" content="HTML Markup, HitechCore Co.">
    <meta name="author" content="Le Hoang Minh">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HitechCore Co. - Available jobs</title>
    <link rel="stylesheet" href="pages/styles/style.css">
    <style>



        .job-section {
            max-width: 100%;
        }

        .jobdetail {
            list-style-type: none;
            padding: 0;
        }

        .jobdetail li {
            margin-bottom: 10px;
        }

        .btn {
            margin-top: 10px;
        }

        .job-selection {
            list-style-type: none;
            padding: 0;
            margin-bottom: 20px;
        }

        .job-selection li {
            display: inline-block;
            margin-right: 10px;
        }

        .job-selection li a {
            text-decoration: none;
            color: #000000;
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #cccccc;
        }

        .job-selection li a:hover,
        .job-selection li a.active {
            background-color: #cccccc;
        }

        .job-selection li a.active {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="banner2">
    <?php include 'common/header.inc' ?>
</div>
<main>
    <?php
    // Khởi tạo biến $current_section với giá trị mặc định là 'frontend'
    $current_section = isset($_GET['section']) ? $_GET['section'] : 'frontend';
    ?>

    <div class="content-container">
        <section>
            <ul class="job-selection">
                <li><a href="?section=frontend" class="<?php echo $current_section === 'frontend' ? 'active' : ''; ?>">Frontend Developer</a></li>
                <li><a href="?section=backend" class="<?php echo $current_section === 'backend' ? 'active' : ''; ?>">Backend Developer</a></li>
            </ul>
        </section>
        <section>
            <div class="job-section">
                <?php if ($current_section === 'frontend'): ?>
                    <h2>Frontend Developer</h2>
                <?php elseif ($current_section === 'backend'): ?>
                    <h2>Backend Developer</h2>
                <?php endif; ?>
                <ul class="jobdetail">
                    <!-- Nội dung PHP giữ nguyên -->
                    <?php if ($current_section === 'frontend'): ?>
                        <li>
                            Job reference number: FE024
                        </li>
                        <li>
                            Position title: Frontend Developer
                        </li>
                        <li>
                            Salary range: 55 - 70M VND
                        </li>
                        <li>
                            Brief description: Our company are looking for a talented Frontend Developer,<br> who will be in
                            charge of developing graphic components for users to interact with in a web application
                        </li>
                        <li>
                            Reporting title: Lead Frontend Developer
                        </li>
                        <li>
                            Key Responsibilities:
                            <ol>
                                <li>
                                    Create user interfaces and responsive web pages using the included designs as a guide.
                                </li>
                                <li>
                                    Enhance applications in the aspects of maximum speed and scalability(Responsive Web Design)
                                </li>
                                <li>
                                    Work with Frontend developers and other designers to improve usability of apps
                                </li>
                                <li>
                                    Ensure brand new technology are applied and stay up-to-date to emerging technologies
                                </li>
                            </ol>
                        </li>
                        <li>
                            <strong>Essentials:</strong>
                            <ol>
                                <li>
                                    Master HTML,CSS and JavaScript
                                </li>
                                <li>
                                    Use modern framework such as React,Angular
                                </li>
                                <li>
                                    Experience in tools like Git, Webpack, npm
                                </li>
                            </ol>
                            <p>Preferable:</p>
                            <ol>
                                <li>
                                    Bachelor degree in Information Technology and other related fields
                                </li>
                                <li>
                                    Experience in design principles
                                </li>
                                <li>
                                    Experience in building responsive web design
                                </li>
                            </ol>
                        </li>

                    <?php elseif ($current_section === 'backend'): ?>
                        <li>
                            Job reference number: BE024
                        </li>
                        <li>
                            Position title: Backend Developer
                        </li>
                        <li>
                            Salary range: 75 - 80M VND
                        </li>
                        <li>
                            Brief description: The Backend Developer will develop, build, and maintain server-side logic in
                            Python, Node.js, and Java.<br> They will collaborate closely with the front-end development team to
                            create strong and scalable online apps.
                        </li>
                        <li>
                            Reporting title: Lead Backend Developer
                        </li>
                        <li>
                            Key Responsibilities:
                            <ol>
                                <li>
                                    Create server-side logic and APIs for web apps.
                                </li>
                                <li>
                                    Design and deploy data storage systems utilizing databases such as MySQL, MongoDB, and
                                    PostgreSQL.
                                </li>
                                <li>
                                    Collaborate with frontend developers to connect user-facing components to server-side logic.
                                </li>
                                <li>
                                    Troubleshoot and debug problems reported by users or QA teams.
                                </li>
                            </ol>
                        </li>
                        <li>
                            <strong>Essentials:</strong>
                            <ol>
                                <li>
                                    Master Python, Node.js, or Java.
                                </li>
                                <li>
                                    Use modern framework such as Django, Flask, Express, or Spring Boot.
                                </li>
                                <li>
                                    Experience in cloud platforms like AWS, Azure, or Google Cloud.
                                </li>
                            </ol>
                            <p>Preferable:</p>
                            <ol>
                                <li>
                                    Bachelor degree in Information Technology and other related fields
                                </li>
                                <li>
                                    Understanding of DevOps processes and tools.
                                </li>
                                <li>
                                    Knowledge of containerization technologies such as Docker and Kubernetes.
                                </li>
                            </ol>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </section>
    </div>



    <?php include 'common/footer.inc' ?>
</main>
<aside>
    <p>
        HitechCore Company <br> where you code everyday.
        <br/>
        Find your most fit job<br> and click the "Apply"<br> to apply.
    </p>
</aside>

</body>
</html>
sửa lỗi