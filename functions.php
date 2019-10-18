<?


function redirect($location){
	header("Location: $location");
}

function query ($sql){
	global $connection;
	return mysqli_query($connection,$sql);
}

function confirm($result) {
	global $connection;
	if(!$result){
		die("QUERY FAILED ".mysqli_error($connection));
	}
}

function escape_string($string){
	global $connection;
	return mysqli_real_escape_string($connection,$string);
}

function fetch_array($result) {
	return mysqli_fetch_array($result);
}

function set_message($msg) {
	if(!empty($msg)){
		$_SESSION['message'] = $msg;
	} else{
		$msg="";
	}
}

function display_message(){
	if(isset($_SESSION['message'])){
		echo $_SESSION['message'];
		unset ($_SESSION['message']);
	}
}

function send_message(){
	if(isset($_POST['submit'])) {
		echo "It works!";
	}
}

function last_id(){
	global $connection;
	return mysqli_insert_id($connection);
}


function register(){

	if(isset($_POST['publish'])){
        $email =
		escape_string($_POST['email']);
		$username =
		escape_string($_POST['username']);
		$password =
		hash('sha256',$_POST['password']);
		$query = query("INSERT INTO users(email, username, password)
		VALUES('{$email}', '{$username}', '{$password}')");
			$last_id = last_id();
			confirm($query);
			set_message("New user with id {$last_id} just added");
			redirect("index.php");
	}
}

function login(){
//check if the submit button has been pressed
	if(isset($_POST['submit'])){
		//create variables and assign values from the username and password fields in the login form
		$username= escape_string($_POST['username']);
		$password= hash('sha256', $_POST['password']);
		//check them against the values held in the database
		$query= query("SELECT*FROM users WHERE username = '{$username}' AND password = '{$password}'");
		confirm($query);
		//use the num_rows function to work out whether there is a match - or not
		if(mysqli_num_rows($query) == 0){
			set_message("Your username or password is incorrect. Please try again.");
			redirect("login.php");
		}else{
		$_SESSION['username'] = $username;

			while ($row = fetch_array($query)){
				$_SESSION['user_id'] = $row['user_id'];
				redirect("profile.php?id={$row['user_id']}");
			}
		}
	}
}

function add_post(){

	if(isset($_POST['publish'])){
    $post_user_id = escape_string($_POST['post_user_id']);
		$post_date = date("Y-m-d");
		$post_time = date("H:i:s");
		$post_content = escape_string($_POST['post_content']);
		$query = query("INSERT INTO posts(post_user_id, post_date, post_time, post_content)
		VALUES('{$post_user_id}', '{$post_date}', '{$post_time}', '{$post_content}')");
			$last_id = last_id();
			confirm($query);
				redirect("profile.php?id={$post_user_id}");
	}

}

			function get_posts_in_profile(){
				$query = query("SELECT*FROM posts, users WHERE post_user_id =".escape_string($_GET['id'])." AND user_id =".escape_string($_GET['id'])." ORDER BY post_date DESC, post_time DESC;");
				confirm("query");

				while ($row = fetch_array($query)){
					$posts = <<<DELIMITER
					<div class="card gedf-card">
										<div class="card-header">
												<div class="d-flex justify-content-between align-items-center">
														<div class="d-flex justify-content-between align-items-center">
																<div class="mr-2">
																		<img class="rounded-circle" height="50" width="45" src="admin/uploads/{$row['profile_img']}" alt="">
																</div>
																<div class="ml-2">
																		<div class="h5 m-0">Posted by {$row['username']}</div>
																		<div class="h7 text-muted">Posted on {$row['post_date']} at {$row['post_time']}
																		<br/>{$row['forename']} {$row['surname']}</div>
																</div>
														</div>
												</div>

										</div>
										<div class="card-body">
												<div class="text-muted h7 mb-2"></div>


												<p class="card-text">
														{$row['post_content']}
												</p>
										</div>
										<div class="card-footer">


										</div>
								</div><br/>

DELIMITER;

					echo $posts;
				}
			}

			function get_posts_in_home(){
				$query = query("SELECT*FROM posts, users, following WHERE follower_id =".escape_string($_SESSION['user_id'])." AND followed_id = user_id AND post_user_id=user_id ORDER BY post_date DESC, post_time DESC;");
				confirm("query");

				while ($row = fetch_array($query)){
					$posts = <<<DELIMITER
					<div class="card gedf-card">
										<div class="card-header">
												<div class="d-flex justify-content-between align-items-center">
														<div class="d-flex justify-content-between align-items-center">
																<div class="mr-2">
																		<a href="profile.php?id={$row['user_id']}"><img class="rounded-circle" height="50" width="45" src="admin/uploads/{$row['profile_img']}" alt=""></a>
																</div>
																<div class="ml-2">
																		<div class="h5 m-0">Posted by <a href="profile.php?id={$row['user_id']}">{$row['username']}</a></div>
																		<div class="h7 text-muted">Posted on {$row['post_date']} at {$row['post_time']}
																		<br/><a href="profile.php?id={$row['user_id']}">{$row['forename']} {$row['surname']}</a></div>
																</div>
														</div>
												</div>

										</div>
										<div class="card-body">
												<div class="text-muted h7 mb-2"></div>


												<p class="card-text">
														{$row['post_content']}
												</p>
										</div>
										<div class="card-footer">


										</div>
								</div><br/>

DELIMITER;

					echo $posts;
				}
			}

			function follow(){
				if(isset($_POST['submit'])){
					$followed = escape_string($_POST['followed']);
					$follower = escape_string($_POST['follower']);


					$query = query("INSERT INTO following(followed_id, follower_id)
					VALUES('{$followed}', '{$follower}')");
						confirm($query);
						redirect("profile.php?id=$followed");
				}

			}

			function get_followers_in_profile(){
				$query = query("SELECT*FROM following, users WHERE followed_id=".escape_string($_GET['id'])." AND user_id = follower_id ");
				confirm("query");

				while ($row = fetch_array($query)){
					$followers = <<<DELIMITER

					<div class="card" style="height:120px; width:100px;">
					<img class="card-img-top img-fluid" src="admin/uploads/{$row['profile_img']}" style="height:120px; width:100px;" alt="Card image cap">
					<div class="card-body">
					<a href="profile.php?id={$row['user_id']}"><p class="card-text">{$row['username']}</p></a>
					</div>
					</div>

DELIMITER;

					echo $followers;
				}
			}

			function get_following_in_profile(){
				$query = query("SELECT*FROM following, users WHERE follower_id=".escape_string($_GET['id'])." AND user_id = followed_id");
				confirm("query");

				while ($row = fetch_array($query)){
					$following = <<<DELIMITER

					<div class="card" style="height:120px; width:100px;">
					<img class="card-img-top img-fluid" src="admin/uploads/{$row['profile_img']}" style="height:120px; width:100px;" alt="Card image cap">
					<div class="card-body">
					<a href="profile.php?id={$row['user_id']}"><p class="card-text">{$row['username']}</p></a>
					</div>
					</div>

DELIMITER;

					echo $following;
				}
			}

			function update_user(){

				if(isset($_POST['update'])){

					$email			= escape_string($_POST['email']);
					$forename	= escape_string($_POST['forename']);
					$surname			= escape_string($_POST['surname']);
					$age	= escape_string($_POST['age']);
					$country			= escape_string($_POST['country']);
					$user_bio		= escape_string($_POST['user_bio']);
					$profile_img			= escape_string($_FILES['file']['name']);
					$image_temp_location	= escape_string($_FILES['file']['tmp_name']);

			if(empty($profile_img)){

			$get_pic= query ("SELECT profile_img FROM users WHERE user_id=" .escape_string($_GET['id']). " ");
					confirm ($get_pic);

					while($pic= fetch_array($get_pic)){

						$profile_img = $pic['profile_img'];
					}
			}

				move_uploaded_file($image_temp_location, "admin/uploads/".$profile_img);

				//make sure to put a space after SET
				$query = "UPDATE users SET ";
				$query.= "email	  = '{$email}' , ";
				$query.= "forename	= '{$forename}' , ";
			   	 $query.= "surname = '{$surname}' , ";
				$query.= "age	= '{$age}' , ";
				$query.= "country = '{$country}'	, ";
				$query.= "user_bio = '{$user_bio}' , ";
				$query.= "profile_img = '{$profile_img}'	";
				$query.= "WHERE user_id=" .escape_string($_GET['id']);

				$send_update_query = query($query);
				confirm($send_update_query);
			redirect("profile.php?id=3");
		}
		}

			function display_no_of_following(){
			$query = query("SELECT * FROM following WHERE follower_id=".escape_string($_GET['id'])."");
			$count = mysqli_num_rows($query);
			return $count;
			}

			function display_no_of_followers(){
			$query = query("SELECT * FROM following WHERE followed_id=".escape_string($_GET['id'])."");
			$count = mysqli_num_rows($query);
			return $count;
			}




?>
