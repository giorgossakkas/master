<?php
require "../App/Views/header.view.php";
?>

<a href="/leaders/create" class="btn btn-primary float-right" />New team leader</a>

<h2>Team Leaders</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
      <th scope="col">Team Members</th>
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
          <a class="btn btn-primary" href="/leaders/<?php echo $user->getId(); ?>/edit">Update</a>
      </td>
      <td>
          <a class="btn btn-danger"  href="/leaders/<?php echo $user->getId(); ?>/delete">Delete</a>
      </td>
      <td>
          <a class="btn btn-primary"  href="/leaders/<?php echo $user->getId(); ?>/team">View</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
require "../App/Views/footer.view.php";
?>
