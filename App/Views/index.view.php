<?php
require "../App/Views/header.view.php";
?>

<?php if (count($teamMembers) > 0):?>
<h2>My Team</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">View Tasks</th>
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
      <td>
          <a class="btn btn-primary"  href="/users/<?php echo $user->getId(); ?>/tasks">View</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php  endif; ?>


<h2>My Tasks</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($tasks as $key=>$task):
    ?>
    <tr>
      <th scope="row"><?php echo $key+1 ?></th>
      <td><?php echo $task->getName(); ?></td>
      <td><?php echo $task->getDescription(); ?></td>
      <td>
        <?php if ($task->isCompleted()):?>
           <span class="badge-pill badge-success">Completed</span>
        <?php else: ?>
           <span class="badge-pill badge-warning">Work in progress</span>
           <?php if (!empty($_SESSION['COMPLETE_TASKS'])):?>
              <a class="btn btn-primary" href="tasks/<?php echo $task->getId(); ?>/complete">Complete</a>
           <?php endif; ?>
        <?php endif; ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
require "../App/Views/footer.view.php";
?>
