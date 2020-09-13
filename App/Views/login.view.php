<?php
require "../App/Views/header.view.php";
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                <form method="POST" action="login">
                    <div class="form-group row">
                        <label for="user_name" class="col-md-4 col-form-label text-md-right">Username</label>
                        <div class="col-md-6">
                          <input
                              id="user_name"
                              name="user_name"
                              type="text"
                              class="form-control"
                              required
                              value="<?php echo isset($_POST['user_name']) ? htmlspecialchars($_POST['user_name'], ENT_QUOTES) : ''; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require "../App/Views/footer.view.php";
?>
