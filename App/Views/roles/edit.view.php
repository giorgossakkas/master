<?php
require "../App/Views/header.view.php";
?>

<form action="/roles/<?php echo $role->getId(); ?>/update" method="post">
    <div class="form-group">
    		<label for="name">Name: </label>
    		<input type="text" name="name" class="form-control" id="name" value="<?php echo $role->getName(); ?>" required>
  	</div>

    <div class="form-group">
      <label class="checkbox-inline">
          <input type="checkbox"
             data-toggle="toggle"
             id="MANAGE_ROLES"
             name="MANAGE_ROLES"
             <?php if (isset($permissions['MANAGE_ROLES'])) echo 'checked'?>
             value=true> Manage roles
      </label>
    </div>
    <div class="form-group">
      <label class="checkbox-inline">
          <input type="checkbox"
             data-toggle="toggle"
             id="MANAGE_TEAM_LEADERS"
             name="MANAGE_TEAM_LEADERS"
             <?php if (isset($permissions['MANAGE_TEAM_LEADERS'])) echo 'checked'?>
             value=true> Manage Team Leaders
      </label>
    </div>
    <div class="form-group">
      <label class="checkbox-inline">
          <input type="checkbox"
             data-toggle="toggle"
             id="MANAGE_USERS"
             name="MANAGE_USERS"
             <?php if (isset($permissions['MANAGE_USERS'])) echo 'checked'?>
             value=true> Manage users
      </label>
    </div>
    <div class="form-group">
      <label class="checkbox-inline">
          <input type="checkbox"
             data-toggle="toggle"
             id="MANAGE_TASKS"
             name="MANAGE_TASKS"
             <?php if (isset($permissions['MANAGE_TASKS'])) echo 'checked'?>
             value=true> Manage Tasks
      </label>
    </div>
    <div class="form-group">
      <label class="checkbox-inline">
          <input type="checkbox"
             data-toggle="toggle"
             id="COMPLETE_TASKS"
             name="COMPLETE_TASKS"
             <?php if (isset($permissions['COMPLETE_TASKS'])) echo 'checked'?>
             value=true> Complete Tasks
      </label>
    </div>



    <a href="/roles/index" class="float-right p-2" />Cancel</a>
    <button type="submit" class="btn btn-primary float-right" name="update" id="update">Update</button>
</form>

<?php
require "../App/Views/footer.view.php";
?>
