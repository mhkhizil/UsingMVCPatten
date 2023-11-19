
<?php require_once ViewDir."/template/header.php" ;?>

<h1>Lists</h1>
<div class=" d-flex  justify-content-between mb-3">
<a href="/list-create" class=" btn btn-outline-primary">Create</a>
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
    <td><?=$list['name']?></td>
    <td><?=$list['money']?></td>
    <td></td>
    <td><?=$list['created_at']?></td>
</tr>
</tbody>

    <?php endforeach; ?>
    </table>
<?php require_once ViewDir."/template/footer.php" ;?>