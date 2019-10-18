<?php include("config.php");
include("header.php");
include("usernavbar.php");

if(!isset($_SESSION['username'])){
	redirect("index.php");}

if(isset($_GET['id'])){

$query = query("SELECT*FROM users WHERE user_id =".escape_string($_GET['id'])."");
	confirm($query);

while($row = fetch_array($query)){

	$email			= escape_string($row['email']);
	$forename	= escape_string($row['forename']);
	$surname			= escape_string($row['surname']);
	$age	= escape_string($row['age']);
	$country			= escape_string($row['country']);
	$user_bio		= escape_string($row['user_bio']);
	$profile_img			= escape_string($row['profile_img']);
}
update_user();
}?>

<body class="profile-page sidebar-collapse">

  <div class="page-header header-filter" data-parallax="true" style="background-image: url('admin/uploads/defaultcover.png');"></div>
  <div class="main main-raised">
    <div class="profile-content">
      <div class="container">
        <div class="row">

        </div>
        <div class="description text-center">
          <p> </p>
        </div>
</br>
<div class="row">

  <div class="col-md-12">
  <form action="" method="post" enctype="multipart/form-data">
  <div class="row">

  <div class="col-md-6">
    <div class="form-group has-info">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="<?php echo $email?>">
  </div>

  <div class="form-group has-info">
    <label for="exampleInputEmail1">Forename</label>
    <input type="text" name="forename" class="form-control" aria-describedby="forenameHelp" placeholder="<?php echo $forename?>">
  </div>

  <div class="form-group has-info">
    <label for="exampleInputEmail1">Surname</label>
    <input type="text" name="surname" class="form-control" aria-describedby="surnameHelp" placeholder="<?php echo $surname?>">
  </div>



  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
    <label for="exampleInputEmail1">Profile Pic</label>
      <div class="fileinput-new thumbnail img-raised">
          <img src="admin/uploads/<?php echo $profile_img?>" height="150px" width="120px" alt="...">
      </div>
      <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
      <div>
          <input class="btn-file" type="file" name="file">

      </div>
  </div><br/>

  </div>


    <div class="col-md-6">

        <div class="form-group has-info">
        <label for="exampleInputEmail1">Age</label>
        <input type="number" name="age" class="form-control" required="required" aria-describedby="emailHelp" placeholder="<?php echo $age?>">
      </div>

      <div class="form-group has-info">
      <label for="exampleInputEmail1">Country</label>
      <input type="text" name="country" class="form-control" aria-describedby="emailHelp" placeholder="<?php echo $country?>">
    </div>

    <div class="form-group has-info">
    <label for="exampleInputEmail1">Profile Bio</label>
    <input type="text" name="user_bio" class="form-control" aria-describedby="emailHelp" placeholder="<?php echo $user_bio?>">
  </div>



    </div>
    <br/>
    <input type="submit" name="update" class="btn btn-info" value="Change Details">

  </div></form>

<div class="col-sm-12">


    </div><br/>


                <br/>



</div>

</div>
    </div>
  </div>

  <?php
  include("userfooter.php");?>
