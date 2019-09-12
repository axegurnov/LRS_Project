<div class="container-fluid">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
                <h1><?= isset($data_field['id']) ? "Edit" : "Create" ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="<?= route('user_update'); ?>" method="post">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Login</label>
                        <div class="col-sm-10">
                            <input type="text" name="login" class="form-control" id="inputLogin"
                                   aria-describedby="loginHelp" placeholder="Enter login"
                                   value="<?= $data_field['login'] ?? "" ?>" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="inputName"
                                   aria-describedby="nameHelp" placeholder="Enter name"
                                   value="<?= $data_field['name'] ?? "" ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Surname</label>
                        <div class="col-sm-10">
                            <input type="text" name="second_name" class="form-control" id="inputSecondName"
                                   aria-describedby="secondNameHelp" placeholder="Enter surname"
                                   value="<?= $data_field['second_name'] ?? "" ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="inputEmail"
                                   aria-describedby="emailHelp" placeholder="Enter email"
                                   value="<?= $data_field['email'] ?? "" ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="password" name="password" placeholder="Password"
                                   value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" name="id" value="<?= $data_field['id'] ?? "" ?>">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        <a href="/users" class="btn btn-secondary float-right">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>