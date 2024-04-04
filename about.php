<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Assignment Part 1">
    <meta name="keywords" content="HTML Markup, HitechCore Co.">
    <meta name="author" content="Nguyen Minh Hieu">
    <title>About us - HitechCore Co.</title>
    <link rel="stylesheet" href="pages/styles/style.css">
</head>

<body>
<div class="banner4">
    <?php include 'common/header.inc' ?>
</div>

<main>
    <header>
        <h1>About Us</h1>
        <div class="brief">
            <dl>
                <dt>Group ID:</dt>
                <dd>ABC123</dd>
                <dt>Group Name:</dt>
                <dd>HiTechCore Co.</dd>
                <dt>Tutor's Name:</dt>
                <dd>Nguyen Van Cong</dd>
                <dt>Course Name:</dt>
                <dd>COS10026 Computing Technology Inquiry</dd>
            </dl>
            <br/>
        </div>
    </header>
    <section class="members">
        <h2>Members From Group</h2>
        <br/>
        <div class="leader">
            <div class="members-col">
                <img src="pages/images/HoangMinh.jpg" alt="Le Hoang Minh-group leader">
                <h3>Group Leader</h3>
                <p>
                    Student at Swinburne University. Following Information Technology Course
                    <br/>
                    My hometown is Thanh Hoa, and my favourite hobbies are reading comics and playing maimai.
                    <br/>
                </p>
            </div>
        </div>
        <div class="member">
            <div class="members-col">
                <img src="pages/images/HieuNguyen.png" alt="Nguyen Minh Hieu-group member">
                <h3>Group Member</h3>
                <p>
                    Student at Swinburne University. Following Information Technology Course
                    <br/>
                    My hometown is Ha Noi , and I am a fan of horror and detective genre.
                    <br/>
                </p>
            </div>
        </div>
    </section>
    <section class="timetable">
        <h2>Our Timetable</h2>
        <table>
            <caption>Timetable for COS10026 Computing Technology Inquiry Project and TNE10006 Networks and Switching
            </caption>
            <thead>
            <tr>
                <th>Course</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>COS10026-Computing Technology Inquiry Project</td>
                <td>OFF</td>
                <td>OFF</td>
                <td>STUDY</td>
                <td>OFF</td>
                <td>STUDY</td>
            </tr>
            <tr>
                <td>TNE10006-Networks and Switching</td>
                <td>OFF</td>
                <td>OFF</td>
                <td>STUDY</td>
                <td>OFF</td>
                <td>STUDY</td>
            </tr>
            </tbody>
        </table>
    </section>
    <a href="mailto:ngmnhieuu2807@gmail.com">Send email</a>
</main>

<?php include 'common/footer.inc' ?>
</body>
</html>