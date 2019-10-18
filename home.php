<?php include("config.php");
include("header.php");
add_post();
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


    <form method="post" action="">
    <input type="hidden" name="post_user_id" value="<?php echo $_SESSION['user_id']?>">
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
                    </div></form></div><br/>


<!--- \\\\\\\Post-->
<?php get_posts_in_home();?>
                <!-- Post /////-->
                <br/>



</div>

</div>
    </div>
  </div>

  <?php
  include("userfooter.php");?>
