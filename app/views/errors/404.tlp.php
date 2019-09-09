<?php
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	echo "404 error - Страница не найдена!";
?>
<br><br>
<form action="/login" method="post">
    <button type="submit" name="exit" class="btn btn-primary">Страница авторизации</button>
</form>