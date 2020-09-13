<?php
require "../App/Views/header.view.php";
?>

<h2>Tasks of <?php echo $user->getUserName(); ?></h2>

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
        <?php if ($task->isCompleted()): ?>
           <span class="badge-pill badge-success">Completed</span>
        <?php else: ?>
           <span class="badge-pill badge-warning">Work in progress</span>
        <?php endif; ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<br>
<a href="/index" class="float-right p-2" />Back</a>

<?php
require "../App/Views/footer.view.php";
?>
