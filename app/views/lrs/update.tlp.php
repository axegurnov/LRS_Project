<form action="/lrs/update" method="post"> <?php
    if (isset($errors)) { ?>
    <div class="alert alert-danger" role="alert">
        <?php
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
        }
        echo "</div>" ?>
        <div class="form-group">
            <label for="email_address" class="col-md-4 col-form-label ">Name</label>
            <div class="col-md-6">
                <input type="text" id="name" class="form-control" name="name" value="<?= $data_field['name']??""?>" autofocus>
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-md-4 col-form-label">Description</label>
            <div class="col-md-6">
                <input type="text" id="description" class="form-control" name="description" value="<?=$data_field['description']??"" ?>">
            </div>
        </div>

        <div class="col-md-6">
            <input type="hidden" class="form-control edit_confirm" name="id" value="<?= $data_field['id']??""?>">
            <button type="submit" class="btn btn-primary">
               Update
            </button>
        </div>
</form>