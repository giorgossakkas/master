<?php
require "../App/Views/header.view.php";
?>

<form action="/tasks/<?php echo $task->getId(); ?>/update" method="post">
    <div class="form-group">
    		<label for="name">Name: </label>
    		<input type="text" name="name" class="form-control" id="name" value="<?php echo $task->getName(); ?>" required>
  	</div>
  	<div class="form-group">
    		<label for="description">Description: </label>
        <input type="text" name="description" class="form-control" id="description" value="<?php echo $task->getDescription(); ?>">
  	</div>
    <a href="/tasks/index" class="float-right p-2" />Cancel</a>
    <button type="submit" class="btn btn-primary float-right" name="update" id="update">Update</button>
</form>

<?php
require "../App/Views/footer.view.php";
?>
