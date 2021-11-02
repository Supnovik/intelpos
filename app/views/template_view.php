<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="app/views/Main/main.css">
    <title>Main</title>
</head>
    <body>
        

        <?php include 'app/views/blocks/navbar.php' ?>

        <?php include 'app/views/'.$content_view; ?>

        <?php include 'app/views/blocks/footer.php' ?>
        
    </body>
</html>