<?php
/**
* class to render different views
* by Steven Ringger
*/
class Render{
	public function __construct()
	{
		
	}
  /**
  * render products
  * @param $cocktail
  * @param $user
  */
	public function render_p($cocktail, $user){ ?>
		<a href="?cid=<?php echo $cocktail->getid(); ?>">
            <div class="singleProduct col-sm-4">
              <div class="productContent">
                <div class="productImg">                  
                  <img src="/cocktailGit/img/<?php echo $cocktail->getimage(); ?>">
                </div>
                <div class="rating-box">
                     <?php 
                        for ($i=0; $i < 5; $i++) { 
                          if ($cocktail->getrating() > $i) {
                            echo '<span class="rating-star full-star"></span>';
                          }else{
                            echo '<span class="rating-star empty-star"></span>';
                          }
                        }
                        ?>
                  </div>
                <div class="productTitel"><h4><?php echo $cocktail->getTitle(); ?></h4></div>
                <div class="productDescription"><?php echo empty($cocktail->getdescription()) ? "No description avaiable" : $cocktail->getdescription(); ?></div>
                
                <?php if (isset($_SESSION['login_id'])&&$user['role']==1) { ?>
                  <a href="?action=edit&id=<?php echo $cocktail->getid(); ?>" class="edit"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="?action=delete&id=<?php echo $cocktail->getid(); ?>" class="delete" ><span class="glyphicon glyphicon-trash"></span></a>
                <?php } ?>
              </div>
            </div>
          </a>
        <?php
	}
  /**
  * render the single product view
  * @param $cocktail
  */
	public function render_singleP($cocktail){ ?>
		<div class="singleProduct col-sm-12">
      <div class="productContent">
        <div class="productImg">
          <img src="/cocktailGit/img/<?php echo $cocktail->getimage(); ?>">
        </div>
        <?php if(!isset($_SESSION['login_id'])){ ?>
          <div class="rating-box">
           <?php 
              for ($i=0; $i < 5; $i++) { 
                if ($cocktail->getrating() > $i) {
                  echo '<span class="rating-star full-star"></span>';
                }else{
                  echo '<span class="rating-star empty-star"></span>';
                }
              }
              ?>
          </div>
        <?php }else{ ?>
        <div class="rating-box">
          <form id="cocktail_rating">
            <span class="starrating"> 
              <input type="hidden" name="id"  value="<?php echo $cocktail->getid(); ?>">
              <input type="hidden" name="user"  value="<?php echo $_SESSION['login_id']; ?>">
              <?php 
              for ($i=5; $i > 0; $i--) { 
                if (round($cocktail->getrating()) == $i) {
                  echo '<input type="radio" id="star'. $i .'" name="rating" value="'.$i.'" checked><label for="star'. $i .'"></label>';
                }else{
                  echo '<input type="radio" id="star'. $i .'" name="rating" value="'.$i.'"><label for="star'. $i .'"></label>';
                }
              }
              ?>
             
            </span>
          </form>
      </div>
        <?php } ?>
        
        <div class="productTitel"><h2><?php echo $cocktail->getTitle(); ?></h2></div>
        <div class="productDescriptionSingle">
          <h3>Description</h3>
          <?php echo empty($cocktail->getdescription()) ? "No description avaiable" : $cocktail->getdescription(); ?>
        </div>
        <div class="ingredients">
          <h3>Ingredients</h3>
          <?php foreach($cocktail->getingredients() as $ingredient){ ?>
            <div class="row">
              <div class="col-sm-6"><?php echo $ingredient[0]; ?></div>
              <div class="col-sm-6"><?php echo $ingredient[1]; ?></div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
<?php
	}
  /**
  * render site pagination
  * @param $curr
  * @param $amount
  * @param $cat
  */
  public function renderPagination($curr, $amount, $cat){
    if ($amount > 15) {
      $y = $amount / 15;
      echo '<div class="row pages">';
      if (ceil($y)<3) {
        echo '<div class="col-sm-4"></div>';
        echo '<div class="col-sm-4">';
      }else{
        echo '<div class="col-sm-3"></div>';
        echo '<div class="col-sm-6">';
      }
      
      if ($cat!=0) {
        echo '<a href="?site=1&cat='.$cat.'"><div class="firstPage">FIRST</div></a>';
      }else{
        echo '<a href="?site=1"><div class="firstPage">FIRST</div></a>';
      }
       
      if (ceil($y) > 5) {                
          if ($curr==1||$curr==2) {
          $cur = 1;
          $max = 6;
        }elseif ($curr==ceil($y)||$curr==ceil($y)-1) {
          $cur = ceil($y)-4;
          $max = ceil($y)+1;
        }else{
          $cur = $curr-2;
          $max = $curr+3;
        }             
        for ($i=$cur; $i < $max; $i++) { 
          if ($curr==$i) {
            if ($cat!=0) {
              echo '<a href="?site='.$i.'&cat='.$cat.'"><div class="pageNumber active">'.$i.'</div></a>';
            }else{
             echo '<a href="?site='.$i.'"><div class="pageNumber active">'.$i.'</div></a>'; 
            }
          }else{
            if ($cat!=0) {
              echo '<a href="?site='.$i.'&cat='.$cat.'"><div class="pageNumber">'.$i.'</div></a>';
            }else{
             echo '<a href="?site='.$i.'"><div class="pageNumber">'.$i.'</div></a>'; 
            }
          }
        }
      }else{
        $cur=1;
        $max = ceil($y)+1;
        for ($i=$cur; $i < $max; $i++) { 
          if ($curr==$i) {
            if ($cat!=0) {
              echo '<a href="?site='.$i.'&cat='.$cat.'"><div class="pageNumber active">'.$i.'</div></a>';
            }else{
             echo '<a href="?site='.$i.'"><div class="pageNumber active">'.$i.'</div></a>'; 
            }
          }else{
            if ($cat!=0) {
              echo '<a href="?site='.$i.'&cat='.$cat.'"><div class="pageNumber">'.$i.'</div></a>';
            }else{
             echo '<a href="?site='.$i.'"><div class="pageNumber">'.$i.'</div></a>'; 
            }
          }
        }
      }  
      if ($cat!=0) {
        echo '<a href="?site='. ceil($y) .'&cat='.$cat.'"><div class="lastPage">LAST</div></a>'; 
      }else{
        echo '<a href="?site='. ceil($y) .'"><div class="lastPage">LAST</div></a>';
      }  
      
      echo '</div>';
      echo '</div>';
    }
  }
  
}
?>