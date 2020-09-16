<?php
require "../App/Views/header.view.php";
?>

<form action="/roles/created" method="post">
  <div class="form-group">
		<label for="name">Name</label>
        <input
            type="text"
            name="name"
            class="form-control"
            id="name"
            placeholder="Provide name"
            value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES) : ''; ?>">
	</div>
  <?php
  foreach ($allPermissions as $permission) :
  ?>
  <div class="form-group">
    <label class="checkbox-inline">
        <input type="checkbox"
           data-toggle="toggle"
           id=<?php echo $permission ?>
           name=<?php echo $permission ?>
           value=true> <?php echo $permission ?>
    </label>
  </div>
  <?php endforeach; ?>


  <a href="/roles/index" class="float-right p-2" />Cancel</a>
  <button type="submit" class="btn btn-primary float-right" name="create" id="create">Create</button>
</form>

<?php
require "../App/Views/footer.view.php";
?>
