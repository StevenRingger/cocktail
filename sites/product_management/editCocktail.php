<?php
// by Steven Ringger
  $products = new ProductDetails();
  // getting all used information and cocktail_id
  $ingredients = $products->getIngredients();
  $amounts = $products->getAmounts();
  $categories = $products->getCategories();
  $cocktail = $products->getCocktail($_GET['id']);
?>
<div class="add_cocktail">
<h1>Edit cocktail</h1>
<!-- form for editing a cockatil -->
<form method="post" action="/cocktail/sites/product_management/validate.php" onsubmit="return validateForm()" name="addCocktail" enctype="multipart/form-data">
  <input type="hidden" name="action" value="update">
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
  <div class="row">
    <!-- display the set cocktailname -->
    <div class="form-group col-sm-7">
      <label for="title">Cocktailname: </label>
      <input type="text" class="form-control" name="title" id="title" value="<?php echo $cocktail->getTitle(); ?>" required>
    </div>
    <!-- preselect choosen categorie -->
    <div class="form-group col-sm-5">
      <label for="cat">Category: </label>      
      <select class="form-control" name="cat" id="cat" required>
        <option class="first_option" disabled="disabled" value="">Choose a category</option>
        <?php foreach ($categories as $cat => $value): 
        if ($cat == $cocktail->getCat()) { ?>
          <option value="<?php echo $cat; ?>" selected><?php echo $value; ?></option>
        <?php }else{ ?>
          <option value="<?php echo $cat; ?>"><?php echo $value; ?></option>
        <?php }
         endforeach ?>
      </select>
    </div>
  </div>
  <!-- display the description -->
  <div class="row">
    <div class="form-group col-sm-12">
      <label for="desc">Description:</label>
      <textarea class="form-control" name="desc" id="desc" ><?php echo $cocktail->getdescription(); ?></textarea>
    </div>
  </div>
  <!-- display the set image -->
  <div class="row">
    <div class="form-group col-sm-12">
      <div class="row">
        <div class="col-sm-4">
          <label for="img">Cocktail image:</label>
          <input type="file" name="fileToUpload" id="fileToUpload" onchange="document.getElementById('cocktail_pic').src=window.URL.createObjectURL(this.files[0])"> 
          <input type="hidden" name="prev_img" value="<?php echo $cocktail->getimage(); ?>">
          <div class="currentPic">Currently set: <?php echo $cocktail->getimage(); ?></div>
        </div>
        <div class="col-sm-4">
          <div class="preview">
            <img src="/cocktail/img/<?php echo $cocktail->getimage(); ?>" id="cocktail_pic">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <label for="ing" class="col-sm-7">Ingredient: </label>
    <label for="am" class="col-sm-4">Amount in parts: </label>
  </div>

<!-- display all already set ingredients -->
  <div class="row">
    <div class="form-group col-sm-12">
      <div class="container1">
      <?php 
      $i = 0;
      foreach ($cocktail->getingredients() as $ingredient) { ?>
        <div class="row">
          <div class="col-sm-7">            
            <select class="form-control" name="ing[]" id="ing" required>
              <option class="first_option" disabled="disabled" value="">Select an ingredient</option>
              <?php foreach ($ingredients as $ing => $value): 
                if($value == $ingredient[0]){ ?>
                  <option value="<?php echo $ing; ?>" selected><?php echo $value; ?></option>
                <?php }else{ ?>
                  <option value="<?php echo $ing; ?>"><?php echo $value; ?></option>
              <?php  }
               endforeach ?>
            </select>
          </div>
          <div class="col-sm-4">            
            <select class="form-control" name="am[]" id="am" required>
              <option class="first_option" disabled="disabled" value="" >Select the amount in parts</option>
              <?php foreach ($amounts as $am => $value): 
                if($value == $ingredient[1]){ ?>
                <option value="<?php echo $am; ?>" selected><?php echo $value; ?></option>
              <?php }else{ ?>
                <option value="<?php echo $am; ?>"><?php echo $value; ?></option>
              <?php }
               endforeach ?>
            </select>
          </div>
          <?php
          if ($i==0) {
            echo '<button class="add_form_field col-sm-1 btn btn-default">Add</button>';
          }else{
            echo '<a href="#" class="delete_ing col-sm-1 btn btn-default">Delete</a>';
          }
          ?>
         
        </div>
        <?php
        $i++;
         } ?>
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
<!-- script for adding and removing new ingredient fields -->
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
  $(wrapper).on("click",".deleteIng", function(e){
      e.preventDefault(); $(this).parent('div').remove(); x--;
  })
});
</script>
