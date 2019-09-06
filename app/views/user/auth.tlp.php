<?php if (!isset($_COOKIE["user"])): ?>
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
    <p>Пользователь авторизован</p>
<?php endif; ?>