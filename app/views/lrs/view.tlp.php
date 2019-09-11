<a href="/lrs/list" class="btn btn-info mx-md-5">Back to lrs list</a><br><br>
<div class="mx-md-5"><h1><?= $lrs['name'] ?></h1></div>

<div class="mx-md-5"><h3>LRS State</h3></div>
<table class="table-bordered table-sm ml-md-5 mt-md-3">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Actor</th>
        <th scope="col">Activity</th>
        <th scope="col">Key</th>
        <th scope="col">Value</th>
    </tr>
    </thead>
    <?php foreach ($clients as $client): ?>
        <tr>
            <th scope="row"><label><?= $client['id'] ?></label></th>
            <td><?= $client['login'] ?></td>
            <td><?= $client['description'] ?></td>
            <td><?= $client['login'] ?></td>
            <td><?= $client['login'] ?></td>
        </tr>
    <?php endforeach; ?>
</table><br>

<div class="mx-md-5"><h3>Clients LRS</h3></div>
<form action="/lrs/client/view/update" method="post">
    <input type="hidden" name="lrs_id" value="<?= $lrs['id']?>">
    <button type="submit" class="btn btn-info btn-sm ml-md-5 mt-md-3">Create client LRS</button>
</form><br>

<table class="table-bordered table-sm ml-md-5 mt-md-3">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Login</th>
        <th scope="col">Description</th>
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>
    </thead>
    <?php foreach ($clients as $client): ?>
        <tr>
            <th scope="row"><label><?= $client['id'] ?></label></th>
            <td><?= $client['login'] ?></td>
            <td><?= $client['description'] ?></td>
            <td>
                <form action="/lrs/client/view/update" method="post">
                    <input type="hidden" name="client_id" value="<?=$client['id']?>">
                    <input type="hidden" name="lrs_id" value="<?=$lrs['id']?>">
                    <button type="submit" class="btn btn-info">Edit</button>
                </form>
            </td>

            <td>
                <form action="lrs/client/delete" method="post">
                    <input type="hidden" name="client_id" value="<?=$client['id']?>">
                    <button type="submit" class="btn btn-danger del_confirm"">Remove</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>