<?php require_once("includes/header.php");?>
<?php

if ($session->is_signed_in()) {
  redirect_to("dashboard.php");
}

if (isset($_POST['submit'])) {

  $admin_name = trim($_POST['admin_name']);
  $password = trim($_POST['password']);

  $admin_found = Admins::verify_admin($admin_name, $password);

  if ($admin_found) {
    $session->login($admin_found);
    redirect_to("dashboard.php");
  } else {
    $the_message = "Your password or admin_name was FAILED";
  }

} else {
  $admin_name = "";
  $password = "";
}

?>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-8 col-lg-6 col-md-9 my-5">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-danger mb-4">Welcome to Back office!</h1>
                  </div>
                  <h2 class="bg-danger"><?php /*echo $the_message; */?></h2> <!--if login false then it will show-->
                  <form method="post">
                    <div class="form-group">
                      <input type="text" name="admin_name" value="<?php echo htmlentities($admin_name); ?>" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Name">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" value="<?php echo htmlentities($password); ?>" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label> <br>

                      </div>
                    </div>
                    <hr>
                    <div class="form-group">
                      <input type="submit" name="submit" class="btn btn-danger btn-block" value="Submit">
                    </div>
                  </form>
                  <hr>
                  <div class="text-center">
                    <label>Contact <a href="https://www.applepanithi.com#contact" class="text-danger">me</a> for asking the permission to access the data</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

<?php include ("includes/footer.php"); ?>
