<?php
require "../App/Views/header.view.php";
?>

<a href="/users/create" class="btn btn-primary float-right" />New user</a>

<h2>Users</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($users as $key=>$user):
    ?>
    <tr>
      <th scope="row"><?php echo $key+1 ?></th>
      <td><?php echo $user->getUserName(); ?></td>
      <td><?php echo $user->getEmail(); ?></td>
      <td>
          <a class="btn btn-primary" href="/users/<?php echo $user->getId(); ?>/edit">Update</a>
      </td>
      <td>
          <a class="btn btn-danger"  href="/users/<?php echo $user->getId(); ?>/delete">Delete</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
require "../App/Views/footer.view.php";
?>
