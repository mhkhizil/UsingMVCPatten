
<?php require_once ViewDir."/template/header.php" ;?>

<h1>Edit</h1>

<div class=" d-flex  justify-content-between mb-3">
<a href="<?=route("list")?>" class=" btn btn-outline-primary">All lists</a>
</div>
<div class="border rounded-4 p-5">
<form action="<?=route('list-update')?>" method="post">
<input type="text" hidden name="id" id="" value="<?=$list['id']?>">
    <div class=" row align-items-end">
        <div class="col">
            <label for=" form-label">Your name</label>
            <input type="text" class=" form-control" name="name" value="<?=$list['sname']?>">
        </div>
        <div class="col">
            <label for=" form-label">Your money</label>
            <input type="number" class=" form-control" name="money" value="<?=$list["money"]?>">
        </div>
        <div class="col">
            <button class=" btn btn-primary w-100 btn-lg">Update List</button>
        </div>
    </div>
</form>
</div>


<?php require_once ViewDir."/template/footer.php" ;?>