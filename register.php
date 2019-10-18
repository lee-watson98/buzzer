<?php require_once("config.php");
include("header.php");
include("navbar.php");
register();?>
<title> Buzzer - Register </title>

<body class="login-page collapse-sidebar">
  <div class="page-header header-filter" style="background-image: url('assets/img/background2.jpg'); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
          <div class="card">
            <form class="form" method="post" action="" enctype="multipart/form-data">
              <div class="card-header card-header-info text-center">

                <h4 class="card-title">Register</h4>
                Get started.
              </div>
              <div class="card-body">
              </br>
                <div class="input-group has-info" name="email">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">mail</i>
                    </span>
                  </div>
                  <input type="email" name="email" required="required" class="form-control" placeholder="Enter your e-mail address...">
                </div>
                <br />
                <div class="input-group has-info" name="username">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">face</i>
                    </span>
                  </div>
                  <input type="text" name="username" required="required" class="form-control" placeholder="Create a username...">
                </div>
                <br />
                <div class="input-group has-info" name="password">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                  </div>
                  <input type="password" name="password" required="required" class="form-control" placeholder="Create a password...">
                </div>
                <br /><br /><br /><br />
                <div class="footer text-center">
                  <input type="submit" name="publish" value="Register" class="btn btn-info btn-wd btn-lg">
                <br/><br/>

                </div></div>






            </form>
          </div>
        </div>
      </div>
    </div>
<?php include("footer.php");?>
    </div>
