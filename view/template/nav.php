<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?=route("list")?>">List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=route("inventory")?>">Inventory</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"href="<?=route("api/users")?>">User</a> 
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?=route("api/cars")?>">Cars</a>
        </li>
      </ul>
    </div>
  </div>
</nav>