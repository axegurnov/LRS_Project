<div class="container-fluid">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 mx-md-5 mt-3 mb-3">
                <h1><?= $lrs['name'] ?></h1>
            </div>
        </div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link" href="<?= route('lrs'); ?>?view=<?= $lrs['id'] ?>" role="tab" aria-selected="true">Clients</a>
                <a class="nav-item nav-link" href="<?= route('lrs_state'); ?>?view=<?= $lrs['id'] ?>" role="tab" aria-controls="nav-profile" aria-selected="false">State</a>
                <a class="nav-item nav-link active" href="<?= route('lrs_statements'); ?>?lrs=<?= $lrs['id'] ?>" role="tab" aria-controls="nav-contact" aria-selected="false">Statements</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Actor</th>
                                <th scope="col">Verb</th>
                                <th scope="col">Activity</th>
                                <th scope="col">Content</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; foreach ($statements as $statement): ?>
                                <tr>
                                    <th scope="row"><label><?= $i?></label></th>
                                    <td><?= $statement['login'] ?></td>
                                    <td><?= $statement['verb'] ?></td>
                                    <td><?= $statement['activity'] ?></td>
                                    <td><?= $statement['content'] ?></td>
                                </tr>
                                <?php $i++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>