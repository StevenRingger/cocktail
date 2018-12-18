<?php
  //by Zoe Abeln
  // general display page of user
  // to be continued

  include('session.php');
  include('user_info.php');
  $user = getUserName($login_session);
?>
<h1>Welcome <?php echo $user['firstname'] . ' ' . $user['lastname'] ?></h1> 
