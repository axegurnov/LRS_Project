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
        <!-- Большие модальное окно -->

        <div class="modal fade modal-all-statements">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Statements in JSON</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <pre><?php
                            echo json_encode($statementsJson, JSON_PRETTY_PRINT)
                            /*foreach($statementsJson as $sta) {
                                    echo json_encode($sta, JSON_PRETTY_PRINT);
                                    echo "<BR>";
                                }*/
                            ?>
                        </pre>
                    </div>
                </div>
            </div>
        </div>
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
                                <th><button class="btn btn-light float-right" data-toggle="modal" data-target=".modal-all-statements">JSON</button></th>
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
                                    <td>
                                        <button id="btnStatementId" class="btn btn-info float-right showStatementInJson" btnStatementid="<?=$i?>" data-toggle="modal" data-target=".modal-single-statement">JSON</button>
                                        <div id="statementId" class="statementInJson" divStatementId="<?=$i?>" hidden="hidden">
                                            <pre><?php

                                                    echo json_encode($statement, JSON_PRETTY_PRINT);
                                                ?>
                                            </pre>
                                        </div>
                                    </td>
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