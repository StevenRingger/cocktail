<?php
  //by Zoe Abeln
  //function to retrieve user information
  if (!function_exists('getUserName')) {
    function getUserName($userID){
      $con = new Connection();
      $db = $con->getConnection();
      $sql = mysqli_query($db,"select * from users where fk_login_id = '$userID'");
      $row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
      return $row;
    }
  }

?>