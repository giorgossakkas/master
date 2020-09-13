<?php
require "../App/Views/header.view.php";
?>

<a href="/roles/create" class="btn btn-primary float-right" />New role</a>

<h2>Roles</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($roles as $key=>$role):
    ?>
    <tr>
      <th scope="row"><?php echo $key+1 ?></th>
      <td><?php echo $role->getName(); ?></td>
      <td>
          <a class="btn btn-primary" href="../roles/<?php echo $role->getId(); ?>/edit">Update</a>
      </td>
      <td>
          <a class="btn btn-danger"  href="../roles/<?php echo $role->getId(); ?>/delete">Delete</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
require "../App/Views/footer.view.php";
?>
