<div class="container-fluid">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 mx-md-5 mt-3 mb-3">
                <h1><?= $lrs['name'] ?></h1>
            </div>
        </div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link" href="<?= route('lrs',$lrs['id']); ?>" role="tab"
                   aria-selected="true">Clients</a>
                <a class="nav-item nav-link active" href="<?= route('lrs_state',$lrs['id']); ?>" role="tab"
                   aria-controls="nav-profile" aria-selected="false">State</a>
                <a class="nav-item nav-link" href="<?= route('lrs_statements',$lrs['id']); ?>" role="tab"
                   aria-controls="nav-contact" aria-selected="false">Statements</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Actor</th>
                                <th scope="col">Activity</th>
                                <th scope="col">Key</th>
                                <th scope="col">Value</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($states as $state): ?>
                                <tr>
                                    <th scope="row"><?= $state['id'] ?></th>
                                    <td><?= $state['login'] ?></td>
                                    <td><?= $state['name'] ?></td>
                                    <td><?= $state['state_key'] ?></td>
                                    <td><?= $state['value'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>