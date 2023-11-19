
<?php require_once ViewDir."/template/header.php" ;?>

<h1>Lists</h1>
<div class=" d-flex  justify-content-between mb-3">
<a href="<?=route("list-create")?>" class=" btn btn-outline-primary">Create</a>
</div>
<table class=" table table-bordered">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Money</th>
            <th>Control</th>
            <th>Created at</th>
        </tr>
    </thead>
<tbody>
<?php foreach($lists as $list): ?>
<tr>
    <td><?=$list['id']?></td>
    <td><?=$list['sname']?></td>
    <td><?=$list['money']?></td>
    <td>
        <a href="<?= route("list-delete?id=".$list['id'])?>" class=" btn btn-outline-danger btn-sm">Delete</a>
    </td>
    <td><?=$list['created_at']?></td>
</tr>
</tbody>

    <?php endforeach; ?>
    </table>
<?php require_once ViewDir."/template/footer.php" ;?>