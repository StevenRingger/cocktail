<?php
  //by Zoe Abeln
  //get database connection
  $con = new Connection();
  $db = $con->getConnection();
  //if no session is started start a new one
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
   //check if something was inputed
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    //prevent sql injection
    $myusername = mysqli_real_escape_string($db,$_POST['username']);
    $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
    //get user information from server
    $sql = "SELECT * FROM login WHERE username = '$myusername'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $username = $row['username'];
    $loginid = $row['idlogin'];
    $count = mysqli_num_rows($result);
    //verify if user exists and check if password is correct
    if($count == 1 && password_verify($mypassword, $row['password'])) {
      //add login id to session and go to user page
      $_SESSION['login_id'] = $loginid;
      header("location: /cocktail?action=user");
    }else {
      $error = "Your Login Name or Password is invalid";
    }
  }
?>
<!-- complete login form -->
<div align = "center">
  <div class="login">
    <div class="loginTitel"><b>Login</b></div>
    <div>
      <form action = "" method = "post">
        <?php if(isset($error)){echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";} ?>
        <label>Username  :    </label><input type = "text" name = "username" class = "box"/><br /><br />
        <label>Password  :    </label><input type = "password" name = "password" class = "box" /><br/><br />
        <input type = "submit" value = " Login "/><br />
      </form>
    </div>
  </div>
</div>
