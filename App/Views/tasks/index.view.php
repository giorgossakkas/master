<?php
require "../App/Views/header.view.php";
?>

<a href="/tasks/create" class="btn btn-primary float-right" />New task</a>

<h2>Tasks</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Status</th>
      <th scope="col">Signed</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
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
        <?php endif; ?>
      </td>
      <td>
        <?php if (!$task->isAssigned()): ?>
           <span class="badge-pill badge-danger">Un-Assigned</span>
           <?php if (!empty($_SESSION['MANAGE_TASKS'])):?>
              <a class="btn btn-primary" href="/tasks/<?php echo $task->getId(); ?>/assign">Assign</a>
           <?php endif; ?>
        <?php else: ?>
           <span class="badge-pill badge-warning">Assigned</span>
           <?php if (!empty($_SESSION['MANAGE_TASKS']) && !$task->isCompleted()):?>
              <a class="btn btn-primary" href="/tasks/<?php echo $task->getId(); ?>/unassign">Unassign</a>
           <?php endif; ?>
        <?php endif; ?>
      </td>
      <td>
          <?php if (!empty($_SESSION['MANAGE_TASKS'])):?>
              <a class="btn btn-primary" href="/tasks/<?php echo $task->getId(); ?>/edit">Update</a>
           <?php endif; ?>
      </td>
      <td>
          <?php if (!empty($_SESSION['MANAGE_TASKS'])):?>
              <a class="btn btn-danger" href="/tasks/<?php echo $task->getId(); ?>/delete">Delete</a>
           <?php endif; ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
require "../App/Views/footer.view.php";
?>
