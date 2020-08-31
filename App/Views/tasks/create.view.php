<?php
require "../App/Views/header.view.php";
?>

<form action="/tasks/created" method="post">
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
	<div class="form-group">
		<label for="description">Description</label>
    <textarea
            class="form-control"
            name="description"
            placeholder="Description"
            value="<?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description'], ENT_QUOTES) : ''; ?>" ></textarea>

	</div>
  <a href="/index" class="float-right p-2" />Cancel</a>
  <button type="submit" class="btn btn-primary float-right" name="create" id="create">Create</button>
</form>

<?php
require "../App/Views/footer.view.php";
?>
