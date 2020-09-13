<?php
require "../App/Views/header.view.php";
?>

<h2>Team Members of <?php echo $teamLeader->getUserName(); ?></h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($teamMembers as $key=>$user):
    ?>
    <tr>
      <th scope="row"><?php echo $key+1 ?></th>
      <td><?php echo $user->getUserName(); ?></td>
      <td><?php echo $user->getEmail(); ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="/leaders/index" class="btn btn-link float-right" />Back</a>


<?php
require "../App/Views/footer.view.php";
?>
