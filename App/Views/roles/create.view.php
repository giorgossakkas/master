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
  <div class="form-group">
    <label class="checkbox-inline">
        <input type="checkbox"
           data-toggle="toggle"
           id="MANAGE_ROLES"
           name="MANAGE_ROLES"
           value=true> Manage roles
    </label>
  </div>
  <div class="form-group">
    <label class="checkbox-inline">
        <input type="checkbox"
           data-toggle="toggle"
           id="MANAGE_TEAM_LEADERS"
           name="MANAGE_TEAM_LEADERS"
           value=true> Manage Team Leaders
    </label>
  </div>
  <div class="form-group">
    <label class="checkbox-inline">
        <input type="checkbox"
           data-toggle="toggle"
           id="MANAGE_USERS"
           name="MANAGE_USERS"
           value=true> Manage users
    </label>
  </div>
  <div class="form-group">
    <label class="checkbox-inline">
        <input type="checkbox"
           data-toggle="toggle"
           id="MANAGE_TASKS"
           name="MANAGE_TASKS"
           value=true> Manage Tasks
    </label>
  </div>
  <div class="form-group">
    <label class="checkbox-inline">
        <input type="checkbox"
           data-toggle="toggle"
           id="COMPLETE_TASKS"
           name="COMPLETE_TASKS"
           value=true> Complete Tasks
    </label>
  </div>

  <a href="/roles/index" class="float-right p-2" />Cancel</a>
  <button type="submit" class="btn btn-primary float-right" name="create" id="create">Create</button>
</form>

<?php
require "../App/Views/footer.view.php";
?>
