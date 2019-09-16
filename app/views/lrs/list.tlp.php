<div class="container-fluid">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
                <h1>LRS list</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1+$limit*(($_GET['page']??'1')-1); foreach ($lrsr as $lrs): ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><a href="<?= route('lrs'); ?>?view=<?= $lrs['id'] ?>" class="link"><?= $lrs['id'] ?></a></td>
                            <td><?= $lrs['name'] ?></td>
                            <td><?= $lrs['description'] ?></td>
                            <td class="row">
                                <form action="<?= route('lrs_view_update'); ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $lrs['id'] ?>">
                                    <button type="submit" class="btn btn-sm" style="background-color:transparent;"><i
                                                class="far fa-edit" aria-hidden="true"></i></button>
                                </form>
                                <form action="<?= route('lrs_del'); ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $lrs['id'] ?>">
                                    <button type="submit" class="btn btn-sm del_confirm" style="background-color:transparent;"><i
                                                class="fas fa-minus-circle" aria-hidden="true"></i></button>
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
                <a class="btn btn-primary" href="<?= route('lrs_view_update'); ?>" role="button">Add</a>
            </div>
        </div>
        <nav class="mt-md-3">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $pages; $i++): ?>
                    <li class="page-item"><a class="page-link" href="<?= route('lrs_list'); ?>?page=<?= $i; ?>"><?= $i; ?></a></li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
</div>