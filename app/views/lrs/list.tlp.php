<table class="table-bordered table-sm ml-md-5 mt-md-3">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
    </tr>
    </thead>
    <?php foreach ($lrsr as $lrs): ?>
        <tr>
            <th scope="row"><label><?= $lrs['id'] ?></label></th>
            <td><?= $lrs['name'] ?></td>
            <td>
                <form action="/lrs/addEditUser" method="post">
                    <input type="hidden" name="id" value="">
                    <button type="submit" class="btn btn-info">Edit</button>
                </form>
            </td>

            <td>
                <form action="/users/del" method="post">
                    <input type="hidden" name="id" value="">
                    <button type="submit" class="btn btn-danger">Remove</button>
                </form>
            </td>
        </tr>
    <?php endforeach;?>
</table>
<nav class="ml-md-5 mt-md-3">
    <ul class="pagination">

        <li class="page-item"><a class="page-link" href="/users/all/">1</a></li>
        <li class="page-item"><a class="page-link" href="/users/all/">2</a></li>
        <li class="page-item"><a class="page-link" href="/users/all/">3</a></li>
        <li class="page-item"><a class="page-link" href="/users/all/">4</a></li>

    </ul>