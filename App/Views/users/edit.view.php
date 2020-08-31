<?php
require "../App/Views/header.view.php";
?>

<form action="/users/<?php echo $user->getId(); ?>/update" method="post">
    <div class="form-group">
        <label for="user_name">Name: </label>
        <input type="text" name="user_name" class="form-control" id="user_name" value="<?php echo $user->getUserName(); ?>" >
    </div>
    <div class="form-group">
        <label for="email">Email: </label>
        <input type="text" name="email" class="form-control" id="email" value="<?php echo $user->getEmail(); ?>" >
    </div>
    <a href="/index" class="float-right p-2" />Cancel</a>
    <button type="submit" class="btn btn-primary float-right" name="update" id="update">Update</button>
</form>

<?php
require "../App/Views/footer.view.php";
?>
