<?php
require "../App/Views/header.view.php";
?>

<form action="/leaders/<?php echo $user->getId(); ?>/update" method="post">
    <div class="form-group">
        <label for="user_name">Name: </label>
        <input type="text" name="user_name" class="form-control" id="user_name" value="<?php echo $user->getUserName(); ?>" >
    </div>
    <div class="form-group">
        <label for="email">Email: </label>
        <input type="text" name="email" class="form-control" id="email" value="<?php echo $user->getEmail(); ?>" >
    </div>
    <div class="form-group">
        <label for="user_id">Role: </label>
        <select class="form-control" id="role_id" name="role_id" required value="<?php echo $user->getRoleId(); ?>">
            <option value=""><?php echo 'Please select role' ?></option>
            <?php
            foreach ($roles as $role) :
            ?>
            <option <?php if($role->getId() ==$user->getRoleId()) echo 'selected' ?> value="<?php echo $role->getId(); ?>"><?php echo $role->getName(); ?>

            </option>
            <?php endforeach; ?>
        </select>
    </div>
    <a href="/leaders/index" class="float-right p-2" />Cancel</a>
    <button type="submit" class="btn btn-primary float-right" name="update" id="update">Update</button>
</form>

<?php
require "../App/Views/footer.view.php";
?>
