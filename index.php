<?php
// by Steven Ringger and Zoe Abeln
//general includes needed
  require_once $_SERVER['DOCUMENT_ROOT'].'/cocktailGit/db/config2.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'/cocktailGit/sites/product_management/product_details.php'; 
  require_once $_SERVER['DOCUMENT_ROOT'].'/cocktailGit/sites/product_management/cocktail.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Cocktails</title>  
  <!-- Latest compiled and minified CSS -->
  <link href="bootstrap/dist/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
  <!-- include of main navigation file -->
  <?php include $_SERVER['DOCUMENT_ROOT'].'/cocktailGit/nav/main_nav.php'; ?>
  <div class="body container">
    <?php
    // include the file to render products
      include $_SERVER['DOCUMENT_ROOT'].'/cocktailGit/sites/product_management/render_p.php'; 
      $display = new Render();
      $products = new ProductDetails();
      //create a new render and productdetails instance
    ?>
    <div class="row">
      <div class="col-sm-3 ">
        <div class="categories">
          <a href="index.php"><h3>Cocktails</h3></a>
          <?php 
          // display all categories
          $categories = $products->getCategories(); 
          foreach ($categories as $key => $value) { ?>
          <a href="?cat=<?php echo $key; ?>" >
            <div class="row">
              <!-- make sure the active categorie is highlighted -->
              <?php if (isset($_GET['cat']) && $key == $_GET['cat']) { ?>
                <div class="col-sm-12 categorie activeCat"><?php echo $value; ?></div>
              <?php }else{ ?>
                <div class="col-sm-12 categorie"><?php echo $value; ?></div>
              <?php } ?>              
            </div>
          </a>
          <?php }
          ?>
        </div>
      </div>
      <!-- main body for products and all other user actions-->
      <div class="col-sm-9 cocktails">
        <div class="content-background">
          <?php 
          //switch case if user choose a sepcific action
          if(isset($_GET['action'])){
            switch ($_GET['action']) {
                case "add":
                    include $_SERVER['DOCUMENT_ROOT'].'/cocktailGit/sites/product_management/addCocktail.php';
                    break;
                case "edit":
                    include $_SERVER['DOCUMENT_ROOT'].'/cocktailGit/sites/product_management/editCocktail.php';
                    break;
                case "user":
                    include $_SERVER['DOCUMENT_ROOT'].'/cocktailGit/sites/user_management/welcome.php';
                    break;
                case "login":
                    include $_SERVER['DOCUMENT_ROOT'].'/cocktailGit/sites/user_management/login.php';
                    break;
                case "signup":
                    include $_SERVER['DOCUMENT_ROOT'].'/cocktailGit/sites/user_management/register.php';
                    break;
                case "delete":
                    $products->deleteCocktail($_GET['id']);
                    break;
                default:                  
            }
          }else{
            // when no action is selected products will be displayed
            $from = 0;
            if(isset($_GET['cid'])){
              //if a product is selected show only selected one
              $result= $products->getCocktail($_GET['cid']);              
              $display->render_singleP($result);            
            }elseif(isset($_GET['cat'])){
              //get amount of products to see if more than 15
              $amount = $products->getAmountOfCocktails($_GET['cat']);              
              if (isset($_GET['site'])) {
                $from = ($_GET['site']-1)*15;
              }else{
                $from = 0;
              }
              //select and display all cocktail from categorie starting from choosen site
              $result = $products->getAllCocktails($_GET['cat'],$from);
              foreach($result as $cocktail){
                if (!isset($user)) {$user['role']=2;}
                $display->render_p($cocktail, $user);
              }
              if (isset($_GET['site'])) {
                $display->renderPagination($_GET['site'],$amount, $_GET['cat']);
              }else{
                $display->renderPagination(1,$amount, $_GET['cat']);
              }
            }else{
              //get amount of products to see if more than 15
              $amount = $products->getAmountOfCocktails(0);            
              if (isset($_GET['site'])) {
                $from = ($_GET['site']-1)*15;
              }else{
                $from = 0;
              }
              $result = $products->getAllCocktails(0,$from);              
              //select and display all cocktail from categorie starting from choosen site
              foreach($result as $cocktail){
                if (!isset($user)) {$user['role']=2;}
                $display->render_p($cocktail, $user);
              }
              if (isset($_GET['site'])) {
                $display->renderPagination($_GET['site'],$amount,0);
              }else{
                $display->renderPagination(1,$amount,0);
              }
            }
          }          
        ?>
      </div>
      </div>
    </div>
  </div>
</body>
<!-- ajax script to add rating to a cocktail -->
<script type="text/javascript">
  $(document).ready(function() { 
    $('#cocktail_rating').change(function(){
      var data = $("#cocktail_rating").serialize();
      $.ajax({
        data: data,
        type: "POST",
        url: "/cocktailGit/sites/product_management/addRating.php",
        success: function(data){
          location.reload();
        }
    });      
    });
  });
</script>
</html>