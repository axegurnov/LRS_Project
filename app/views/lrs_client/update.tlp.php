<div class="container-fluid">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
                <h1><?= isset($data_field['id']) ? "Edit" : "Create" ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="<?= route('lrs_client_update'); ?>" method="post">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Login</label>
                        <div class="col-sm-10">
                            <input type="text" id="login" class="form-control" name="login"
                                   value="<?= $data_field['login'] ?? "" ?>" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" id="password" class="form-control" name="password" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <input id="description" class="form-control" name="description"
                                   value="<?= $data_field['description'] ?? "" ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" name="lrs_id"
                                   value="<?= $data_field['lrs_id'] ?? $lrs_id ?>">
                            <input type="hidden" class="form-control" name="client_id"
                                   value="<?= $data_field['id'] ?? "" ?>">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="<?= route('lrs_list'); ?>" class="btn btn-secondary float-right">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
