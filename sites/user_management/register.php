<?php
//by Zoe Abeln
//registrationform like we used in one exercise
$error = '';
$firstname = $lastname = $email = $username = '';
// general validation if innput matches all requirements
if($_SERVER['REQUEST_METHOD'] == "POST"){
  $check = 0;
  if(isset($_POST['firstname']) && !empty(trim($_POST['firstname'])) && strlen(trim($_POST['firstname'])) <= 30){
    $firstname = htmlspecialchars(trim($_POST['firstname']));
  } else {
    $error .= "Please enter a valid firstname<br />";
    $check = 1;
  }

  if(isset($_POST['lastname']) && !empty(trim($_POST['lastname'])) && strlen(trim($_POST['lastname'])) <= 30){
    $lastname = htmlspecialchars(trim($_POST['lastname']));
  } else {
    $error .= "Please enter a valid lastname<br />";
    $check = 1;
  }

  if(isset($_POST['email']) && !empty(trim($_POST['email'])) && strlen(trim($_POST['email'])) <= 100){
    $email = htmlspecialchars(trim($_POST['email']));
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
      $error .= "Please enter a valid email-address<br />";
    }
  } else {
    $error .= "Please enter a valid email-address<br />";
    $check = 1;
  }

  if(isset($_POST['username']) && !empty(trim($_POST['username'])) && strlen(trim($_POST['username'])) <= 30){
    $username = trim($_POST['username']);
		if(!preg_match("/(?=.*[a-z])(?=.*[A-Z])[a-zA-Z]{6,}/", $_POST['username'])){
			$error .= "The username doesn't match requirements<br />";
		}else{
      $db = new Connection();
      $con = $db->getConnection();
      $result = mysqli_query($con, 'SELECT username FROM login where username="'.$username.'"');
      if (mysqli_num_rows($result)!=0) {
        $error .= "The username already exists.<br />";
        $check = 1;
      }
    }
  } else {
    $error .= "Please enter a valid username<br />";
    $check = 1;
  }

  if(isset($_POST['password']) && !empty(trim($_POST['password']))){
    $password = trim($_POST['password']);
    if(!preg_match("/(?=^.{8,}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $_POST['password'])){
      $error .= "Please enter a valid password<br />";
    }
  } else {
    $error .= "Please enter a password<br />";
    $check = 1;
  }
  
  if ($check == 0) {
    //include save_user.php and execute function to add user to database
    include('save_user.php');
    saveUser($firstname,$lastname,$email,$username,$password);
  }
}
?>
<div class="register">
  <h1>Sign-up</h1>
  <?php
    // output error-message
    if(strlen($error)){
      echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
    }
  ?>
  <form action="" method="post">
    <!-- firstname -->
    <div class="form-group">
      <label for="firstname">Firstname*:</label>
      <input type="text" name="firstname" class="form-control" id="firstname" value="<?php echo $firstname ?>" placeholder="Please enter your firstname" maxlength="30" required>
    </div>
    <!-- lastname -->
    <div class="form-group">
      <label for="lastname">Lastname*:</label>
      <input type="text" name="lastname" class="form-control" id="lastname" value="<?php echo $lastname ?>" placeholder="Please enter your lastname" maxlength="30" required>
    </div>
    <!-- email -->
    <div class="form-group">
      <label for="email">Email*:</label>
      <input type="email" name="email" class="form-control" id="email" value="<?php echo $email ?>" placeholder="Please enter your email" maxlength="100" required>
    </div>
    <!-- username -->
    <div class="form-group">
      <label for="username">Username*:</label>
      <input type="text" name="username" class="form-control" id="username" value="<?php echo $username ?>" placeholder="Upper- and lowercase, at least 6 characters" maxlength="30" required pattern="(?=.*[a-z])(?=.*[A-Z])[a-zA-Z]{6,}" title="Upper- and lowercase, at least 6 characters">
    </div>
    <!-- password -->
    <div class="form-group">
      <label for="password">Password*:</label>
      <input type="password" name="password" class="form-control" id="password" placeholder="Upper- and lowercase, numbers, specialcharacters, at least 8 characters" pattern="(?=^.{8,}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="At least one uppercase letter, one lowercase letter, one number, one specialcharacter, at least 8 characters" required>
    </div>
    <button type="submit" name="button" value="submit" class="btn btn-primary">Sign-Up</button>
    <button type="reset" name="button" value="reset" class="btn btn-warning">Cancel</button>
  </form>
</div>

