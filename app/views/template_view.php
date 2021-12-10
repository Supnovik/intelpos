<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <link rel="stylesheet" type="text/css" href="/styles/index.css">
    <link rel="stylesheet" type="text/css" href="/styles/navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/footer.css">
    <link rel="stylesheet" type="text/css" href="/styles/home.css">
    <link rel="stylesheet" type="text/css" href="/styles/login.css">
    <link rel="stylesheet" type="text/css" href="/styles/profile.css">
    <link rel="stylesheet" type="text/css" href="/styles/registration.css">
    <link rel="stylesheet" type="text/css" href="/styles/listOfUsers.css">
    <link rel="stylesheet" type="text/css" href="/styles/setofcards.css">
    <link rel="stylesheet" type="text/css" href="/styles/backdropsList.css">
    <link rel="stylesheet" type="text/css" href="/styles/backdrop.css">
    <link rel="stylesheet" type="text/css" href="/styles/learnCards.css">
    <title><?= $GLOBALS['title'] ?></title>
</head>
<body>

<?php
include 'app/views/Sections/navbar.php' ?>
<div class="content">
    <?php
    include 'app/views/Pages/'.$content_view; ?>
</div>
<?php
include 'app/views/Sections/footer.php' ?>

<?php
foreach ($scripts as $script): ?>
<?php
endforeach; ?>
</body>
</html>