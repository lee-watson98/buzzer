<?php include("config.php");
include("header.php");

include("usernavbar.php");

if(!isset($_SESSION['username'])){
	redirect("index.php");}?>

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


<div class="col-sm-12">

  <form name="search" action="" method="post">
    <div class="input-group mb-3 has-info">
  <input type="text" name="search" action="search" class="form-control" placeholder="Search for users via username, forename or surname" aria-label="Search" aria-describedby="basic-addon2">

  </div>

  </form>

<table class="table">
  <tbody>
  <?php
  include 'database.php';
  $pdo = Database::connect();

  if (isset($_POST['search'])) {

    $search=$_POST['search'];
    $query = $pdo->prepare("SELECT * FROM users WHERE username LIKE '%$search%' OR forename LIKE '%$search%' OR surname LIKE '%$search%' LIMIT 10");
    $query->bindValue(1, "%$search%", PDO::PARAM_STR);
    //binds a value to a named placeholder, in this case
    $query->execute();
    // Display search result

      if ($query->rowCount() > 0){

        while ($row = $query->fetch()) {

          $users = <<<DELIMITER

                <tr>

                  <td> <a href="profile.php?id={$row['user_id']}"><img class="img-fluid d-block mx-auto" src="admin/uploads/{$row['profile_img']}" height="150px" width="100px"></a> </td>
                  <td> <a href="profile.php?id={$row['user_id']}">{$row['username']}</a> </td>
                  <td>
                  <p>
                  {$row['forename']} {$row['surname']}<br/>
                  {$row['country']}<br/>
                  {$row['age']}</p></td>
                  <td> <a href="profile.php?id={$row['user_id']}"><button class="btn btn-info" type="button"><i class="fa fa-user"></i> View Profile</button></a> </td>
                    </tr>

      DELIMITER;

          echo $users;
        }
      } else {
        echo 'No results found';
      }

  }
  ?>
</tbody>
</table>
  <br/>

    </div><br/>





</div>

</div>
    </div>
  </div>

  <?php
  include("userfooter.php");?>
