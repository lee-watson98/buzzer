<?php require("config.php");
include("header.php");
include("navbar.php");
login();?>
<title> Buzzer </title>

<body class="login-page collapse-sidebar">
  <div class="page-header header-filter" style="background-image: url('assets/img/background.jpg'); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
          <div class="card">
            <form class="form" method="post" action="">
              <div class="card-header card-header-info text-center">

                <h4 class="card-title">Login</h4>
                Jump in.
              </div>
              <div class="card-body">
              </br>
                <div class="input-group has-info">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">face</i>
                    </span>
                  </div>
                  <input type="text" name="username" required="required" class="form-control" placeholder="Username...">
                </div>
                <br />
                <div class="input-group has-info">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                  </div>
                  <input type="password" name="password" required="required" class="form-control" placeholder="Password...">
                </div>

              </div>
              <br /><br /><br /><br /><br /><br /><br />
              <div class="footer text-center">
                <input type="submit" name="submit" value="Login" class="btn btn-info btn-wd btn-lg">
            <hr /><p style="color: black;">Don't have an account? <a href="register.php">Register</a>. It's free.</p><br />

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
<?php include("footer.php");?>
    </div>
