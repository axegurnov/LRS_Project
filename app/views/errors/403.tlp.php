<?php
    header($_SERVER["SERVER_PROTOCOL"] . " 403 Forbidden");
    echo "403 error - Отказано в доступе! Пожалуйста, авторизуйтесь!";
?>
<br><br>
<a href="<?= route('login'); ?>" class="btn btn-primary">Страница авторизации</a>