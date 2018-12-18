<?php 
// by Steven Ringger
require_once $_SERVER['DOCUMENT_ROOT'].'/cocktail/db/config2.php';
$db = new Connection();
$title = $description = $cat = $ingr = $am = $img = $detail = "";

if (isset($_POST['action'])) {
	if ($_POST['action']=='insert') {
		insert($db);
	}else{
		update($db);
	}
}
/**
* test input for sql injections
* @param $data
*/
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
/**
* upadte an existing cocktail
* @param $db
*/
function update($db){
	$conn = $db->getConnection();
	$detail = $conn->prepare("UPDATE cocktail_details SET c_name = ?, c_description = ?, c_image = ?, category = ? WHERE idcoccktail_details = ?");
	$conn->query("DELETE FROM cocktails WHERE fk_detail_id = ". $_POST['id']);
	$cocktails = $conn->prepare("INSERT INTO cocktails (fk_detail_id, fk_ingredient_id, fk_amounts_id) VALUES ( ? , ? , ? )");
	$detail->bind_param("ssssi", $title, $description, $img, $cat, $id);
	$cocktails->bind_param("iii", $id, $ingredient, $amount);

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  $id = $_POST['id'];
	  $title = test_input($_POST["title"]);
	  $description = test_input($_POST["desc"]);
	  if ($_FILES["fileToUpload"]["name"] != '') {
	  	$img = upload();
	  }else{
	  	$img = $_POST["prev_img"];
	  }	  
	  $cat = $_POST["cat"];
	  $ingr = $_POST["ing"];
	  $am = $_POST["am"];
	}
	echo $id . "=>" . $title . "=>" . $description . "=>" . $img  . "=>" . $cat . "=>" . $ingr  . "=>" . $am;
	if ($detail->execute()) {

		$last_id = $conn->insert_id;
		$detail->close();

		foreach ($ingr as $key => $value) {
			$amount = $am[$key];
			$ingredient = $value;
			$success = $cocktails->execute();
		}
		if ($success) {
			header("Location: /cocktail/index.php");
		}else{
			echo "Not skilled enough to mix cocktail!";
		}
	}else{
		echo "Could not add Cocktail";
	}

}
/**
* insert a cocktail into db
* @param $db
*/
function insert($db){
	$conn = $db->getConnection();
	
	$detail = $conn->prepare("INSERT INTO cocktail_details (c_name, c_description, c_image, category) VALUES ( ? , ? , ? , ? ) ");
	$cocktails = $conn->prepare("INSERT INTO cocktails (fk_detail_id, fk_ingredient_id, fk_amounts_id) VALUES ( ? , ? , ? ) ");
	$detail->bind_param("ssss", $title, $description, $img, $cat);
	$cocktails->bind_param("iii", $last_id, $ingredient, $amount);

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  $title = test_input($_POST["title"]);
	  $description = test_input($_POST["desc"]);
	  $img = upload();
	  echo $img;
	  $cat = $_POST["cat"];
	  $ingr = $_POST["ing"];
	  $am = $_POST["am"];
	}
	if ($detail->execute()) {
		$last_id = $conn->insert_id;
		$detail->close();

		foreach ($ingr as $key => $value) {
			$amount = $am[$key];
			$ingredient = $value;
			$success = $cocktails->execute();
		}
		if ($success) {
			header("Location: /cocktail/index.php");
		}else{
			echo "Not skilled enough to mix cocktail!";
		}
	}else{
		echo "Could not add Cocktail";
	}
}
/**
* upload a imag to the server (credits to w3schools)
*/
function upload(){
	$target_dir = $_SERVER['DOCUMENT_ROOT']."/cocktail/img/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    return 'placeholder.png';
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 5000000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	        return basename( $_FILES["fileToUpload"]["name"]);
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}
}
?>