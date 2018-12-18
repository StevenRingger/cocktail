<?php
// by Steven Ringger
// add a rating to a product
require_once $_SERVER['DOCUMENT_ROOT'].'/cocktail/db/config2.php';
$db = new Connection();
$conn = $db->getConnection();
$detail = $conn->prepare("INSERT INTO rating (fk_cocktail, rating, fk_user) VALUES ( ? , ? , ? ) ");
$detail->bind_param("iii", $id, $rating, $user);
  if(isset($_POST['user'])){
    $rating = $_POST['rating'];
    $id = $_POST['id'];
    $user = $_POST['user'];
    $detail->execute();
  }
?>