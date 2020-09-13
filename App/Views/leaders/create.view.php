<?php
require "../App/Views/header.view.php";
?>

<form action="/leaders/created" method="post">
    <div class="form-group">
        <label for="user_name">Username</label>
        <input
            type="text"
            name="user_name"
            class="form-control"
            id="user_name"
            placeholder="Provide username"
            value="<?php echo isset($_POST['user_name']) ? htmlspecialchars($_POST['user_name'], ENT_QUOTES) : ''; ?>">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input
            type="email"
            name="email"
            class="form-control"
            id="email"
            placeholder="Provide email"
            value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : ''; ?>">
    </div>
    <div class="form-group">
        <label for="user_id">Role: </label>
        <select class="form-control" id="role_id" name="role_id" >
            <option value=''><?php echo 'Please select role' ?></option>
            <?php
            foreach ($roles as $role) :
            ?>
            <option value="<?php echo $role->getId(); ?>"><?php echo $role->getName(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input
            type="password"
            name="password"
            class="form-control"
            id="password"
            placeholder="Provide password"
            value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password'], ENT_QUOTES) : ''; ?>">
    </div>
    <a href="/leaders/index" class="float-right p-2" />Cancel</a>
    <button type="submit" class="btn btn-primary float-right" name="create" id="create">Create</button>
</form>

<?php
require "../App/Views/footer.view.php";
?>
