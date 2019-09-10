<a href="/user/add" class="btn btn-info btn-sm ml-md-5 mt-md-3">Create User</a>
<table class="table-bordered table-sm ml-md-5 mt-md-3">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">User name</th>
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>
    </thead>
    <?php foreach ($users as $user): ?>
        <tr>
            <th scope="row"><label><?= $user['id'] ?></label></th>
            <td><a href="/user/<?= $user['id'] ?>"><?= $user['name'] ?></a></td>
            <td>
                <form action="/user/update" method="post">
                    <input type="hidden" name="id" value="<?= $user['id']?>">
                    <button type="submit" class="btn btn-info">Edit</button>
                </form>
            </td>

            <td>
                <form action="/user/del" method="post">
                    <input type="hidden" name="id" value="<?= $user['id']?>">
                    <button type="submit" class="btn btn-danger classWarning">Remove</button>
                </form>
            </td>
        </tr>
    <?php endforeach;?>
</table>

<nav class="ml-md-5 mt-md-3">
    <ul class="pagination">
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <li class="page-item"><a class="page-link" href="/users?page=<?= $i; ?>"><?= $i; ?></a></li>
        <?php endfor; ?>
    </ul>
</nav>