<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=(!isset($title)) ? '' : $title?></title>
    <link rel="stylesheet" href="/css/bootstrap.css">
</head>
    <body>
        <div class="wrapper">
            <main>
                <?php
                if(isset($errors)) {
                    echo "<div class='alert alert-danger'>";
                    foreach($errors as $value) {
                        echo "$value";
                        echo '<br>';
                    }
                    echo "</div>";
                }
                ?>
                <?=$content;?>
            </main>
        </div>
    </body>
</html>