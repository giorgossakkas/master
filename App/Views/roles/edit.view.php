<?php
require "../App/Views/header.view.php";
?>

<form action="/roles/<?php echo $role->getId(); ?>/update" method="post">
    <div class="form-group">
    		<label for="name">Name: </label>
    		<input type="text" name="name" class="form-control" id="name" value="<?php echo $role->getName(); ?>" required>
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
                 <?php if (isset($permissions[$permission])) echo 'checked'?>
                 value=true><?php echo $permission ?>
          </label>
        </div>
    <?php endforeach; ?>



    <a href="/roles/index" class="float-right p-2" />Cancel</a>
    <button type="submit" class="btn btn-primary float-right" name="update" id="update">Update</button>
</form>

<?php
require "../App/Views/footer.view.php";
?>
