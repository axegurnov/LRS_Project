<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=(!isset($title)) ? '' : $title?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <?php
        if(isset($_POST['errors'])) {
            echo "<div class='alert alert-danger'>";
            foreach($_POST['errors'] as $value) {
                echo "$value";                
                echo '<br>';                
            }
    		echo "</div>";
        }
    ?> 
    <?php 
        echo $content;
    ?>

</body>
</html>
