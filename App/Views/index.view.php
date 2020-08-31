<?php
require "../App/Views/header.view.php";
?>
<h2>Users</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
      <th scope="col">Info</th>
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
          <a class="btn btn-primary" href="users/<?php echo $user->getId(); ?>/edit">Update</a>
      </td>
      <td>
          <a class="btn btn-danger"  href="users/<?php echo $user->getId(); ?>/delete">Delete</a>
      </td>
      <td>
          <a class="btn btn-info" href="users/<?php echo $user->getId(); ?>/tasks">View tasks</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

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
           <a class="btn btn-primary" href="tasks/<?php echo $task->getId(); ?>/complete">Complete</a>
        <?php endif; ?>
      </td>
      <td>
        <?php if (!$task->isAssigned()): ?>
           <span class="badge-pill badge-danger">Un-Assigned</span>
           <a class="btn btn-primary" href="tasks/<?php echo $task->getId(); ?>/assign">Assign</a>
        <?php else: ?>
           <span class="badge-pill badge-warning">Assigned</span>
        <?php endif; ?>
      </td>
      <td>
          <a class="btn btn-primary" href="tasks/<?php echo $task->getId(); ?>/edit">Update</a>
      </td>
      <td>
          <a class="btn btn-danger" href="tasks/<?php echo $task->getId(); ?>/delete">Delete</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
require "../App/Views/footer.view.php";
?>
