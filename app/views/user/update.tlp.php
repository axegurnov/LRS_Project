<form action="/user/update" method="post">
<?php
    if (isset($errors)) { ?>
    <div class="alert alert-danger" role="alert">
        <?php
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
    }
?>
    </div>
        <div class="form-group">
            <label for="inputLogin">Login</label>
            <input type="text" name="login" class="form-control" id="inputLogin" aria-describedby="loginHelp" placeholder="Enter login" value="<?=$data_field['login']??"" ?>">
        </div>
        <div class="form-group">
            <label for="inputName">Name</label>
            <input type="text" name="name" class="form-control" id="inputName" aria-describedby="nameHelp" placeholder="Enter name" value="<?=$data_field['name']??"" ?>">
        </div>
        <div class="form-group">
            <label for="inputSecondName">Surname</label>
            <input type="text" name="second_name" class="form-control" id="inputSecondName" aria-describedby="secondNameHelp" placeholder="Enter surname" value="<?=$data_field['second_name']??"" ?>">
        </div>
        <div class="form-group">
            <label for="inputEmail">Email address</label>
            <input type="email" name="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email" value="<?=$data_field['email']??"" ?>">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Enter password">
        </div>

        <div class="col-md-6">
            <input type="hidden" class="form-control" name="id" value="<?= $data_field['id']??""?>">
            <button type="submit" class="btn btn-primary">
                <?=isset($data_field['id'])?"Update":"Create"?>
            </button>
            <a href="/users" class="btn btn-secondary float-right">Cancel</a>
        </div>
</form>