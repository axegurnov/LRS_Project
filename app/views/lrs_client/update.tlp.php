<form action="/lrs/client/update" method="post"> <?php
    if (isset($errors)) { ?>
    <div class="alert alert-danger" role="alert">
        <?php
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
        }
        echo "</div>";



        ?>
        <div class="form-group">
            <label for="email_address" class="col-md-4 col-form-label ">Login</label>
            <div class="col-md-6">
                <input type="text" id="login" class="form-control" name="login" value="<?= $data_field['login']??""?>" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-md-4 col-form-label">Password</label>
            <div class="col-md-6">
                <input type="password" id="password" class="form-control" name="password" value="">
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-md-4 col-form-label">Description</label>
            <div class="col-md-6">
                <input type="text" id="description" class="form-control" name="description" value="<?=$data_field['description']??"" ?>">
            </div>
        </div>


        <div class="col-md-6">
            <input type="hidden" class="form-control" name="lrs_id" value="<?= $data_field['lrs_id']??$lrs_id?>">
            <input type="hidden" class="form-control" name="client_id" value="<?= $data_field['id']??""?>">
            <button type="submit" class="btn btn-primary">
                <?=isset($data_field['id'])?"Update":"Create"?>
            </button>
            <a href="/lrs" class="btn btn-secondary float-right">
                Cancel
            </a>
        </div>
</form>