<div class="row align-items-center">
    <div class="col-md-12">
        <?php foreach ($lrs as $lrss): ?>
            <p><?= $lrss['name'] ?></p>
        <?php endforeach; ?>
    </div>
</div>
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

    <?php $i=1; foreach ($states as $state): ?>
        <tr>
            <th scope="row"><label><?= $i ?></label></th>
            <td><?= $state['login'] ?></td>
            <td><?= $state['activity'] ?></td>
            <td><?= $state['state_key'] ?></td>
            <td><?= $state['value'] ?></td>
        </tr>
        <?php $i++; endforeach; ?>
</table>