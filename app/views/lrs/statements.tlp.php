<div class="mx-md-5"><h3>LRS State</h3></div>
<table class="table-bordered table-sm ml-md-5 mt-md-3">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Actor</th>
        <th scope="col">Activity</th>
        <th scope="col">Key</th>
        <th scope="col">Value</th>
    </tr>
    </thead>
    
    <?php foreach ($states as $state): ?>
        <tr>
            <th scope="row"><label><?= $state['id'] ?></label></th>
            <td><?= $state['login'] ?></td>
            <td><?= $state['activity'] ?></td>
            <td><?= $state['state_key'] ?></td>
            <td><?= $state['value'] ?></td>
        </tr>
    <?php endforeach; ?>
</table><br>
<div class="mx-md-5"><h3>LRS Statements</h3></div>
<table class="table-bordered table-sm ml-md-5 mt-md-3">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Actor</th>
        <th scope="col">Verb</th>
        <th scope="col">Activity</th>
        <th scope="col">Content</th>
    </tr>
    </thead>

    <?php foreach ($statements as $statement): ?>
        <tr>
            <th scope="row"><label><?= $state['id'] ?></label></th>
            <td><?= $statement['login'] ?></td>
            <td><?= $statement['verb'] ?></td>
            <td><?= $statement['activity'] ?></td>
            <td><?= $statement['content'] ?></td>
        </tr>
    <?php endforeach; ?>
</table><br>

<div class="container-fluid">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
                <h1><?= $lrs['id']?></h1>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-md-12">
                <p><?= $lrs['name'] ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <a class="link pages" href="state.php">State</a>
                <a class="link pages" href="statements.php">Statements</a>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-md-12">
                <p><?= $lrs['name'] ?> Clients</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Login</th>
                        <th scope="col">Password</th>
                        <th scope="col">Dx</th>
                        <th scope="col">Edit</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <th scope="row"><?= $client['id'] ?></th>
                            <td><?= $client['login'] ?></td>
                            <td>************</td>
                            <td><?= $client['description'] ?></td>
                            <td>
                                <form action="/lrs/client/view/update" method="post">
                                    <input type="hidden" name="client_id" value="<?=$client['id']?>">
                                    <input type="hidden" name="lrs_id" value="<?=$lrs['id']?>">
                                    <button type="submit" class="btn btn-sm" style="background-color:transparent;">
                                        <i class="far fa-edit" aria-hidden="true"></i>
                                    </button>
                                </form>
                                <form action="lrs/client/delete" method="post">
                                    <input type="hidden" name="client_id" value="<?=$client['id']?>">
                                    <button type="submit" class="btn btn-sm del_confirm" style="background-color:transparent;">
                                        <i class="fas fa-minus-circle" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 for-button">
                <form action="/lrs/client/view/update" method="post">
                    <input type="hidden" name="lrs_id" value="<?= $lrs['id']?>">
                    <button type="submit" class="btn btn-info btn-sm ml-md-5 mt-md-3">Add client LRS</button>
                </form>
            </div>
        </div>
    </div>
</div>
