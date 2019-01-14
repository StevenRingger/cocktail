<?php 
  // by Steven Ringger
  $products = new ProductDetails();
  //aquire all product information needed
  $ingredients = $products->getIngredients();
  $amounts = $products->getAmounts();
  $categories = $products->getCategories();

  $con = new Connection();
  $db = $con->getConnection();
  $id = $_SESSION['login_id'];
  $sql = mysqli_query($db,"select role from users where fk_login_id = '$id'");
  $row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
  
  if ($row['role'] != 1) {
    header("location: /cocktailGit");
  }
?>
<!-- basic form for adding a cocktail -->
<div class="add_cocktail">
  <h1>Add new cocktail</h1>
  <form method="post" action="/cocktailGit/sites/product_management/validate.php" onsubmit="return validateForm()" name="addCocktail" enctype="multipart/form-data">
    <input type="hidden" name="action" value="insert">
    <div class="row">
      <div class="form-group col-sm-7">
        <label for="title">Cocktailname: </label>
        <input type="text" class="form-control" name="title" id="title" required>
      </div>
      <div class="form-group col-sm-5">
        <!-- dispaly all categories -->
        <label for="cat">Category: </label>      
        <select class="form-control" name="cat" id="cat" required>
          <option class="first_option" disabled="disabled" value="" selected>Choose a category</option>
          <?php foreach ($categories as $cat => $value): ?>
            <option value="<?php echo $cat; ?>"><?php echo $value; ?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>

    <div class="row">
      <div class="form-group col-sm-12">
        <label for="desc">Description:</label>
        <textarea class="form-control" name="desc" id="desc" rows="5"></textarea>
      </div>
    </div>

    <div class="row">
      <div class="form-group col-sm-12">
        <!-- inptu field for the product image -->
        <div class="row">
          <div class="col-sm-4">
            <label for="img">Cocktail image:</label>
            <input type="file" name="fileToUpload" id="fileToUpload" onchange="document.getElementById('cocktail_pic').src=window.URL.createObjectURL(this.files[0])"> 
          </div>
          <div class="col-sm-4">
            <div class="preview">
              <img src="/cocktailGit/img/placeholder.png" id="cocktail_pic">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- display the first input field for ingredients -->
    <div class="row">
      <label for="ing" class="col-sm-7">Ingredient: </label>
      <label for="am" class="col-sm-4">Amount in parts: </label>
    </div>

    <div class="row">
      <div class="form-group col-sm-12">
        <div class="container1">
          <div class="row">
            <div class="col-sm-7">            
              <select class="form-control" name="ing[]" id="ing" required>
                <option class="first_option" disabled="disabled" value="" selected>Select an ingredient</option>
                <?php foreach ($ingredients as $ing => $value): ?>
                  <option value="<?php echo $ing; ?>"><?php echo $value; ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="col-sm-4">            
              <select class="form-control" name="am[]" id="am" required>
                <option class="first_option" disabled="disabled" value="" selected>Select the amount in parts</option>
                <?php foreach ($amounts as $am => $value): ?>
                  <option value="<?php echo $am; ?>"><?php echo $value; ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <button class="add_form_field col-sm-1 btn btn-default">Add</button>
          </div>
        </div>
      </div>
      </div>
    <div class="row">
         <div class="col-sm-4"></div>
         <div class="col-sm-2"><button type="submit" value="submit" class="btn btn-default submit">Submit</button></div>
         <div class="col-sm-2"><a href="index.php" class="btn btn-default submit">Cancel</a></div>
         <div class="col-sm-4"></div>
    </div>
  </form>
</div>

<!-- script for adding and deleting ned ingeredient fields generically-->
<script type="text/javascript">
  $(document).ready(function() {
    var max_fields      = 6;
    var wrapper         = $(".container1");
    var add_button      = $(".add_form_field");
    var x = 1;
    $(add_button).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper).append('<div class="row"><div class="col-sm-7"><div><select class="form-control" name="ing[]" id="ing" required><option class="first_option" disabled="disabled" value="" selected>Select an ingredient</option><?php foreach ($ingredients as $ing => $value): ?><option value="<?php echo $ing; ?>"><?php echo $value; ?></option><?php endforeach ?></select></div></div><div class="col-sm-4"><div><select class="form-control" name="am[]" id="am" required><option class="first_option" disabled="disabled" value="" selected>Select the amount in parts</option><?php foreach ($amounts as $am => $value): ?><option value="<?php echo $am; ?>"><?php echo $value; ?></option><?php endforeach ?></select></div></div><a href="#" class="delete_ing col-sm-1 btn btn-default">Delete</a></div>'); //add input box
        }
  else
  {
  alert('You Reached the limits')
  }
    });
  $(wrapper).on("click",".delete_ing", function(e){
      e.preventDefault(); $(this).parent('div').remove(); x--;
  })
});
</script>
