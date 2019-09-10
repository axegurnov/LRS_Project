<?php
	header($_SERVER["SERVER_PROTOCOL"]." 403 Forbidden");
	echo "403 error - Отказано в доступе! Пожалуйста, авторизуйтесь!";
?>
<br><br>
<form action="/login" method="post">
    <button type="submit" name="exit" class="btn btn-primary">Страница авторизации</button>
</form>