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
                            <td>
                                <form action="/user/view/update" method="post">
                                    <input type="hidden" name="id" value="<?= $user['id']?>">
                                    <button type="submit" class="btn btn-sm" style="background-color:transparent;"><i
                                                class="far fa-edit" aria-hidden="true"></i></button>
                                </form>
                                <form action="/user/del" method="post">
                                    <input type="hidden" name="id" value="<?= $user['id']?>">
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
                <a class="btn btn-primary" href="/user/view/update" role="button">Add</a>
            </div>
        </div>
        <nav class="mt-md-3">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $pages; $i++): ?>
                    <li class="page-item"><a class="page-link" href="/lrs/list?page=<?= $i; ?>"><?= $i; ?></a></li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
</div>
