<div class="container-fluid">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 mx-md-5 mt-3 mb-3">
                <h1><?= $lrs['name'] ?></h1>
            </div>
        </div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" href="<?= route('lrs'); ?>?view=<?= $lrs['id'] ?>" role="tab"
                   aria-selected="true">Clients</a>
                <a class="nav-item nav-link" href="<?= route('lrs_state'); ?>?view=<?= $lrs['id'] ?>" role="tab"
                   aria-controls="nav-profile" aria-selected="false">State</a>
                <a class="nav-item nav-link" href="<?= route('lrs_statements'); ?>?lrs=<?= $lrs['id'] ?>" role="tab"
                   aria-controls="nav-contact" aria-selected="false">Statements</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover text-center">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Login</th>
                                <th scope="col">Password</th>
                                <th scope="col">Dx</th>
                                <th scope="col">API Token</th>
                                <th scope="col">Edit</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; foreach ($clients as $client): ?>
                                <tr>
                                    <th scope="row"><?= $client['id'] ?></th>
                                    <td><?= $client['login'] ?></td>
                                    <td>************</td>
                                    <td><?= $client['description'] ?></td>
                                    <td><?= $client['api_token'] ?></td>
                                    <td class="row">
                                        <form action="<?= route('lrs_client_view_update'); ?>" method="post">
                                            <input type="hidden" name="client_id" value="<?= $client['id'] ?>">
                                            <input type="hidden" name="lrs_id" value="<?= $lrs['id'] ?>">
                                            <button type="submit" class="btn btn-sm"
                                                    style="background-color:transparent;">
                                                <i class="far fa-edit" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                        <form action="<?= route('lrs_client_delete'); ?>" method="post">
                                            <input type="hidden" name="client_id" value="<?= $client['id'] ?>">
                                            <button type="submit" class="btn btn-sm del_confirm"
                                                    style="background-color:transparent;">
                                                <i class="fas fa-minus-circle" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php $i++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 for-button">
                        <form action="<?= route('lrs_client_view_update'); ?>" method="post">
                            <input type="hidden" name="lrs_id" value="<?= $lrs['id'] ?>">
                            <button type="submit" class="btn btn-info mt-md-3">Add client LRS</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
