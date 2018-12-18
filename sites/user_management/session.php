<?php
  //by Zoe Abeln
  $con = new Connection();
  $db = $con->getConnection();
  //check if session is set
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  if (isset($_SESSION['login_id'])) {
    $user_check = $_SESSION['login_id'];
    $ses_sql = mysqli_query($db,"select * from login where idlogin = '$user_check' ");
    $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
    $login_session = $row['idlogin'];
    //set $login session to login id
  }
   
  if(!isset($_SESSION['login_id'])){

    //commented out to not end in endless loop

    //header("location:/cocktail/index.php");
  }
?>