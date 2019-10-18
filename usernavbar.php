<nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
  <div class="container">
    <div class="navbar-translate">
      <a class="navbar-brand" href="home.php">
        <img src="assets/img/buzzer.png" height="60" width="60"/> </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="home.php">
            <i class="material-icons">home</i> Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php?id=<?php echo $_SESSION['user_id']?>" >
            <i class="material-icons">person</i> <?php echo $_SESSION['username'];?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" title="" data-placement="bottom" href="search.php">
            <i class="material-icons">search</i> Search
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" title="" data-placement="bottom" href="logout.php">
            <i class="material-icons">logout</i> Logout
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>
