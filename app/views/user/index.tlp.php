<div class="container-fluid">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
                <h1>Users</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <th scope="row"><?= $user['id'] ?></th>
                            <td><?= $user['name'] ?></td>
                            <td class="row">
                                <form action="<?= route('user_view_update',$user['id']); ?>" method="post">
                                    <button type="submit" class="btn btn-sm" style="background-color:transparent;"><i
                                                class="far fa-edit" aria-hidden="true"></i></button>
                                </form>
                                <form action="<?= route('user_delete',$user['id']); ?>" method="post">
                                    <button type="submit" class="btn btn-sm del_confirm" style="background-color:transparent;"><i
                                                class="fas fa-minus-circle" aria-hidden="true"></i></button>
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
                <a class="btn btn-primary" href="<?= route('user_view_create_new'); ?>" role="button">Add</a>
            </div>
        </div>
        <?php if($pages != 1):?>
            <nav class="mt-md-3">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $pages; $i++): ?>
                        <li class="page-item"><a class="page-link" href="<?= route('users'); ?>?page=<?= $i; ?>"><?= $i; ?></a></li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif?>
    </div>
</div>