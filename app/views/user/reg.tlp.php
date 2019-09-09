
<div class="container mt-4">
    <h1>New User</h1>
    <form action="/user/add" method="post">
        <div class="form-group">
            <label for="inputLogin">Login</label>
            <input type="text" name="login" class="form-control" id="inputLogin" aria-describedby="loginHelp" placeholder="Enter login" value="<?=(empty($_POST['login'])) ? '' : $_POST['login']?>">
        </div>
        <div class="form-group">
            <label for="inputEmail">Email address</label>
            <input type="email" name="email "class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email" value="<?=(empty($_POST['email'])) ? '' : $_POST['email']?>">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Enter password">
        </div>
        <div class="form-group">
            <label for="inputName">Name</label>
            <input type="text" name="name" class="form-control" id="inputName" aria-describedby="nameHelp" placeholder="Enter name" value="<?=(empty($_POST['name'])) ? '' : $_POST['name']?>">
        </div>
        <div class="form-group">
            <label for="inputPhone">Phone</label>
            <input type="number" name="phone" class="form-control" id="inputPhone" aria-describedby="phoneHelp" placeholder="Enter phone" value="<?=(empty($_POST['phone'])) ? '' : $_POST['phone']?>">
        </div>
        <button type="submit" name="submitButton" class="btn btn-primary" value="1">Submit</button>
        <a href="/users" class="btn btn-secondary float-right">Cancel</a>
    </form>
</div>