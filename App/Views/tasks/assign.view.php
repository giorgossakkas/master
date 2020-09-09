<?php
require "../App/Views/header.view.php";
?>

<form action="/tasks/<?php echo $task->getId(); ?>/assigned" method="post">

		<div class="form-group">
				<label for="user_id">Assign to: </label>
				<select class="form-control" id="user_id" name="user_id" required>
						<option><?php echo 'Please select user' ?></option>
						<?php
						foreach ($users as $user) :
						?>
						<option value="<?php echo $user->getId(); ?>"><?php echo $user->getUserName(); ?></option>
						<?php endforeach; ?>
				</select>
		</div>

    <a href="/tasks/index" class="float-right p-2" />Cancel</a>
    <button type="submit" class="btn btn-primary float-right" name="assign" id="assign">Assign</button>
</form>

<?php
require "../App/Views/footer.view.php";
?>
