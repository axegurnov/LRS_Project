<?php
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	echo "404 error - Страница не найдена!";
?>
<br><br>
<form action="<?= route('login'); ?>" method="post">
    <button type="submit" name="exit" class="btn btn-primary">Вернуться в безопасное место</button>
</form>