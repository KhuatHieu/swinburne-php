<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Assignment Part 1">
    <meta name="keywords" content="HTML Markup, HitechCore Co.">
    <meta name="author" content="Le Hoang Minh and Nguyen Minh Hieu">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Page</title>
    <link rel="stylesheet" href="pages/styles/style.css">
</head>
<body>
    <div class="banner1">
        <?php include 'common/header.inc' ?>
    </div>

    <div class="content">
        <h1>HiTechCore Company</h1>

        <p> A high technology company aims to bring innovation to the world.<br>We are recruiting NOW!!!!</p>
        <div>
            <a href="apply.php"><button type="button">SUBMIT NOW</button></a>
            <a href="https://www.youtube.com/watch?v=cTuXhcJOwl0"><button type="button">WATCH MORE</button></a>
        </div>
    </div>

    <?php include 'common/footer.inc' ?>
</body>
</html>