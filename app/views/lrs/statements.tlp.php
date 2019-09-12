<div class="mx-md-5"><h3><?= $title ?> Statements</h3></div>
<table class="table-bordered table-sm ml-md-5 mt-md-3">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Actor</th>
        <th scope="col">Verb</th>
        <th scope="col">Activity</th>
        <th scope="col">Content</th>
    </tr>
    </thead>

    <?php $i=1; foreach ($statements as $statement): ?>
        <tr>
            <th scope="row"><label><?= $i?></label></th>
            <td><?= $statement['login'] ?></td>
            <td><?= $statement['verb'] ?></td>
            <td><?= $statement['activity'] ?></td>
            <td><?= $statement['content'] ?></td>
        </tr>
    <?php $i++; endforeach; ?>
</table><br>


