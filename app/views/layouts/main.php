<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=(!isset($title)) ? '' : $title?></title>
    <link rel="stylesheet" href="/public/css/bootstrap.css">
</head>
<body>
    <?php if (isset($_SESSION["auth"])): ?>
        <form action="/user/exit" method="post">
            <button type="submit" name="exit" class="btn btn-danger">Выход</button>
        </form>
        <br>
    <?php endif; ?>
    <?php
    if(isset($_SESSION['errors'])) {
            echo "<div class='alert alert-danger'>";
            foreach($_SESSION['errors'] as $value) {
                echo "$value";                
                echo '<br>';                
            }
            echo "</div>";
        }
    ?> 
    <?php 
        echo $content;
    ?>

    <script src="/public/js/jquery-3.4.1.slim.js"></script>
    <script src="/public/js/warning.js"></script>
</body>
</html>