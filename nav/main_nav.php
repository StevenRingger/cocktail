<?php 
// by Steven Ringger
// aquire session info
  include $_SERVER['DOCUMENT_ROOT'].'/cocktail/sites/user_management/session.php';  
  require_once $_SERVER['DOCUMENT_ROOT'].'/cocktail/sites/user_management/user_info.php';
  // if session is set get user info
  if (isset($_SESSION['login_id'])) {
    $user = getUserName($_SESSION['login_id']);
  }
 ?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/cocktail/index.php">Cocktails Inc.</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <?php 
        // if user is not set display register and login buttons
          if(!isset($_SESSION['login_id'])){
            echo '<li><a href="?action=signup"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="?action=login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
          }else{   
          //if user is seet display userpage link and logout button       
            if ($user['role']==1) {
              //if user is set and the role is admin display add cocktail button
              echo '<li><a href="/cocktail/index.php?action=add">Add cocktail</a></li>';
            }
            echo '<li><a href="?action=user">'.$user['firstname'] . ' ' .$user['lastname'].'</a></li>';
            echo '<li><a href="/cocktail/sites/user_management/logout.php">Logout</a></li>';
          }
         ?>
      </ul>
    </div>
  </div>
</nav>