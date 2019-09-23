<?php
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
    echo "404 error - Страница не найдена!";
?>
<br><br>
<a href="<?= route('login'); ?>" class="btn btn-primary">Вернуться в безопасное место</a>