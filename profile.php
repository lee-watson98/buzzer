<?php include("config.php");
include("header.php");

add_post();
follow();
if(!isset($_SESSION['username'])){
	redirect("index.php");}
$query = query("SELECT*FROM users WHERE user_id=" .escape_string($_GET['id'])."");
confirm($query);
while($row = fetch_array($query)):

include("usernavbar.php");?>

<body class="profile-page sidebar-collapse">

  <div class="page-header header-filter" data-parallax="true" style="background-image: url('admin/uploads/defaultcover.png');"></div>
  <div class="main main-raised">
    <div class="profile-content">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto mr-auto">
            <div class="profile">
              <div class="avatar">
                <img src="admin/uploads/<?php echo $row['profile_img'];?>" alt="Circle Image" class="img-raised rounded img-fluid" style="height: 175px; object-fit: cover;">
              </div>
              <div class="name">
                <h3 class="title">  <?php echo $row['forename'];
                echo ' ';
                echo $row['surname'] ?></h3>
                <?php echo $row['age'];?> | @<?php echo $row['username'];?> | <?php echo $row['country'];?><br/>
                Has <?php echo display_no_of_followers();?> followers | Following <?php echo display_no_of_following();?> people
              </div>
            </div>
          </div>
        </div>
        <div class="description text-center">
          <p><?php echo $row['user_bio'];?> </p>

            <?php if($_SESSION['user_id'] == $row['user_id']){
              $edit=<<<DELIMITER

              <a href="edit_details.php?id={$_SESSION['user_id']}"><button class="btn btn-warning"><i class="material-icons">edit</i> Edit Profile</button></a>
DELIMITER;
  echo $edit;

            }else{

            }
              ?>

          <?php
    include 'database.php';
    $pdo = Database::connect();
$stmt = $pdo->prepare("SELECT count(*) FROM following WHERE followed_id =" .escape_string($_GET['id'])." AND follower_id =" .escape_string($_SESSION['user_id'])."");
$stmt->execute([
    $_SESSION['user_id'], // logged-in user
    $_GET['id']           // who we are following
]);

// How to count when using PDO - https://phpdelusions.net/pdo_examples/count
$count = $stmt->fetchColumn();
if($_SESSION['user_id'] == $row['user_id']){
} else {

if ($count > 0) {
    // show `unfollow` form
    $unfollowbutton=<<<DELIMITER

  <form method="post" action="unfollow.php?id={$row['user_id']}">
    <input class="btn btn-info" type="submit"  value="Unfollow">
  </form>

DELIMITER;
  echo $unfollowbutton;
} else {
    // show `follow` form
    $followbutton=<<<DELIMITER

  <form method="post" action="">
    <input type="hidden" name="followed" value="{$row['user_id']}">
    <input type="hidden" name="follower" value="{$_SESSION['user_id']}">
    <input class="btn btn-info" type="submit" name="submit" value="follow">
  </form>

DELIMITER;
  echo $followbutton;}
}?>
        </div>

</br>
<div class="row">


<div class="col-md-6">
  <div class="card">
        <div class="card-header card-header-info">
          <h4 class="card-title">Following</h4>
        </div>
        <div class="card-body">
          <div class="row">
          <?php get_following_in_profile();?></div><br/><br/>

        </div>
      </div>
      <br/>
      <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Followers</h4>
            </div>
            <div class="card-body"><div class="row">
              <?php get_followers_in_profile();?></div><br/>

            </div>
          </div>


</div>

<div class="col-md-6">

  <?php if($_SESSION['user_id'] == $row['user_id']){
    $writepost = <<<DELIMITER
    <form method="post" action="">
    <input type="hidden" name="post_user_id" value="{$_SESSION['user_id']}">
                    <div class="card gedf-card">
                        <div class="card-header card-header-info">
                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="posts-tab" data-toggle="tab" role="tab" aria-controls="posts" aria-selected="true">Write a new post...</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">

                                <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                    <div class="form-group has-info">
                                        <label class="sr-only" for="message">post</label>
                                        <input class="form-control" id="message" required="required" rows="3" name="post_content" placeholder="Say something. (140 characters or less)">
                                    </div>


                            </div>
                            <div class="btn-toolbar justify-content-between">
                                <div class="btn-group">
                                    <input type="submit" name="publish" class="btn btn-info" value="Share">
                                </div>
                            </div>
                        </div>
                    </div></form>
DELIMITER;
echo $writepost;
  } else {

  }?>

                <br/>
<?php get_posts_in_profile();?>
</div>

</div>

</div>
    </div>
  </div>

  <?php   endwhile;
  include("userfooter.php");?>
