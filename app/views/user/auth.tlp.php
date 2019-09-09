<?php if (!isset($_SESSION["auth"])): ?>
<div class="container mt-4">
    <h1>Authorization</h1>
    <form action="/login" method="post">
        <div class="form-group">
            <label for="inputLogin">Login</label>
            <input type="text" name="login" class="form-control" id="inputLogin" aria-describedby="loginHelp" placeholder="Enter login" value="<?=(empty($_POST['login'])) ? '' : $_POST['login']?>">
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Enter password">
        </div>
        <button type="submit" name="loginButton" class="btn btn-success" value="2">Login</button>
    </form>
</div>

<?php else: ?>
    <?php
        
    ?>
    <br>
    <p>Пользователь уже авторизован.</p>
    <form action="/lrs/list" method="post">
        <button type="submit" name="exit" class="btn btn-primary">Перейти в главное меню</button>
    </form>
<?php endif; ?>