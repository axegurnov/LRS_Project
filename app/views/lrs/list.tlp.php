
<a href="/lrs/view/update" class="btn btn-info btn-sm ml-md-5 mt-md-3">Create LRS</a>
<table class="table-bordered table-sm ml-md-5 mt-md-3">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">LRS name</th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"><a href="/users"><img src="https://img.icons8.com/material-sharp/50/000000/settings.png" width="15px" height="15px"></a></th>
    </tr>
    </thead>
    <?php foreach ($lrsr as $lrs): ?>
        <tr>
            <th scope="row"><label><?= $lrs['id'] ?></label></th>
            <td><a href="/lrs?view=<?= $lrs['id'] ?>"><?= $lrs['name'] ?></a></td>
            <td>
                <form action="/lrs/view/update" method="post">
                    <input type="hidden" name="id" value="<?= $lrs['id']?>">
                    <button type="submit" class="btn btn-info">Edit</button>
                </form>
            </td>

            <td>
                <form action="/lrs/del" method="post">
                    <input type="hidden" name="id" value="<?= $lrs['id']?>">
                    <button type="submit" class="btn btn-danger del_confirm">Remove</button>
                </form>
            </td>
        </tr>
    <?php endforeach;?>
</table>

<nav class="ml-md-5 mt-md-3">
    <ul class="pagination">
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <li class="page-item"><a class="page-link" href="/lrs/list?page=<?= $i; ?>"><?= $i; ?></a></li>
        <?php endfor; ?>
    </ul>