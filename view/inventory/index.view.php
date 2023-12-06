<?php require_once ViewDir . "/template/header.php"; ?>

<h1>Inventories</h1>
<div class=" d-flex  justify-content-between mb-3">
    <a href="<?= route("inventory-create") ?>" class=" btn btn-outline-primary">Create</a>
    <form action="" method="get">
        <div class="input-group">
            <input type="text" name="q" value="<?php if (isset($_GET['q'])) : ?><?= $_GET['q'] ?>  <?php endif; ?>" class="   form-control  rounded-4 mx-2">
            <?php if (isset($_GET['q'])) : ?> <a href="<?= route("list") ?>" class=" btn btn-danger rounded-4"> X</a> <?php endif; ?>
            <button class=" btn btn-primary  rounded-4">Search</button>
        </div>
    </form>
</div>
<table class=" table table-bordered">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Control</th>
            <th>Created at</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lists['data'] as $list) : ?>
            <tr>
                <td><?= $list['id'] ?></td>
                <td><?= $list['sname'] ?></td>
                <td><?= $list['price'] ?></td>
                <td><?= $list['stock'] ?></td>
                <td>
                    <a href="<?= route("inventory-edit", ['id' => $list['id']]) ?>" class=" btn btn-outline-info btn-sm">Edit</a>
                    <form action="<?= route("inventory-delete") ?>" method="post" class=" d-inline">
                        <input type="hidden" name="id" value="<?= $list['id'] ?>">
                        <input type="hidden" name="_method" value="delete">
                        <button class=" btn btn-outline-danger btn-sm">Delete</button>
                    </form>

                </td>
                <td><?= $list['created_at'] ?></td>
            </tr>
    </tbody>

<?php endforeach; ?>
</table>

<?=paginationUI($lists)?>
<?php require_once ViewDir . "/template/footer.php"; ?>