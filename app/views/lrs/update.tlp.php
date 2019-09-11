<?php if (isset($errors)) {?>
<div class="alert alert-danger" role="alert">
    <?php foreach ($errors as $error) {
        echo $error . '<br>';
    }
    }
    echo "</div>" ?>
    <div class="container-fluid">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <h1><?=isset($data_field['id'])?"Edit":"Create"?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="/lrs/update" method="post">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= $data_field['name']??""?>" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?=$data_field['description']??"" ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" name="id" value="<?=$data_field['id']??""?>">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            <a href="/lrs/list" class="btn btn-secondary float-right">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>