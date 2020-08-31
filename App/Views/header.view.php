<?php
if(session_status() !== PHP_SESSION_ACTIVE)
  session_start();

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Training</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="nav navbar-nav ml-auto">
          <?php if (!empty($_SESSION['id'])):?>
              <li class="nav-item active">
                <a class="nav-link" href="../index">Home<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../users/create">Add User</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../tasks/create">Add Task</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?= $_SESSION['user_name']; ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="/logout">Logout</a>
                </div>
              </li>
            <?php else: ?>
              <li class="nav-item">
                <a class="nav-link" href="../">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../users/register">Register</a>
              </li>

            <?php endif; ?>
      </ul>
    </div>
  </nav>


    <!-- Begin page content -->
    <div class="card">
      <div class="card-body">

          <?php if (isset($messages)):?>
          <div class="alert alert-danger">
              <ul>
                  <?php foreach ($messages as $message): ?>
                      <li><?php echo $message; ?></li>
                  <?php endforeach; ?>
              </ul>
          </div>
          <?php endif; ?>
