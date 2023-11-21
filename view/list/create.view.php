
<?php require_once ViewDir."/template/header.php" ;?>

<h1>Create New Lists</h1>
<div class=" d-flex  justify-content-between mb-3">
<a href="<?=route("list")?>" class=" btn btn-outline-primary">All lists</a>
</div>
<div class="border rounded-4 p-5">
<form action="<?=route('list-store')?>" method="post">
    <div class=" row align-items-end">
        <div class="col">
            <label for=" form-label">Your name</label>
            <input type="text" class=" form-control" name="name" required>
        </div>
        <div class="col">
            <label for=" form-label">Your money</label>
            <input type="number" class=" form-control" name="money" required>
        </div>
        <div class="col">
            <button class=" btn btn-primary w-100 btn-lg">Add List</button>
        </div>
    </div>
</form>
</div>


<?php require_once ViewDir."/template/footer.php" ;?>