<?php
  //by Zoe Abeln
  //function to save all userdata input from register form
  function saveUser($firstname, $lastname, $email, $username, $password){
    echo $firstname . ' -> ' . $lastname . ' -> ' . $email . ' -> ' . $username . ' -> ' . $password  . ' -> ' . crypt($password);
    require_once $_SERVER['DOCUMENT_ROOT'].'/cocktailGit/db/config2.php';
    $db = new Connection();
    $conn = $db->getConnection();
    // prepare the mysql statements
    $login = $conn->prepare("INSERT INTO login (username, password) VALUES ( ? , ? ) ");
    $user = $conn->prepare("INSERT INTO users (firstname, lastname, email, fk_login_id) VALUES ( ? , ? , ? , ? ) ");
    //bind parameters to statements
    $login->bind_param("ss", $username, $password);
    $user->bind_param("sssi", $firstname, $lastname, $email, $last_id);

    //retrieve input information and test it

      $firstname = test_input($firstname);
      $lastname = test_input($lastname);
      $email = test_input($email);
      $username = test_input($username);
      $password = crypt(test_input($password));
    //execute login insert
    if ($login->execute()) {
      //retrieve last entry id
      $last_id = $conn->insert_id;
      $login->close();
      //execute user insert with login_id
      if ($user->execute()) {
        header("Location: /cocktailGit/index.php");
      }else{
        echo "Unable to add user";
      }
    }else{
      echo "Unable to add login";
    }
  }
  //function to prevent sql injections
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>