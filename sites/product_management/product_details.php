<?php
/**
* by Steven Ringger
* class to return all product information requested
*/
class ProductDetails
{
  private $db;
  public function __construct()
  {
    $this->db = new Connection();
  }
  /**
  * function to get all cockatils by category and page
  * @param $cat
  * @param $from
  */
  public function getAllCocktails($cat,$from): array{
    $cocktails = array();
    $con = $this->db->getConnection();
    $query = '';
    if ($cat!= 0) {
      $query =  'SELECT * FROM cocktail_details WHERE category='.$cat.' LIMIT '.$from.', 15';
    }else{
    $query = 'SELECT * FROM cocktail_details LIMIT '.$from.', 15';
    }
      foreach(mysqli_query($con, $query)as $key){
        $titel = $key['c_name'];
        $description = $key['c_description'];
        $id = $key['idcoccktail_details'];
        $image = $key['c_image'];
        $cat = $key['category'];
        $ingredients = array();
        foreach (mysqli_query($con, 'Select i.ingredient, a.amount from cocktails join ingredients i on fk_ingredient_id=idingredients join amounts a on fk_amounts_id=idamounts where fk_detail_id='.$id.';') as $co) {
          $ingredients[] = array($co['ingredient'],$co['amount']);
        }
        $rating = 0;
        $count = 0;
        foreach (mysqli_query($con, 'SELECT * FROM rating where fk_cocktail='.$id.';') as $co) {
          $rating = $rating + $co['rating'];
          $count++;
        }
        if ($count != 0) {
          $rating = round($rating/$count);
        }else{
          $rating = 0;
        }
        $getcat = mysqli_fetch_assoc(mysqli_query($con, 'SELECT category_name FROM categories where idcategories='.$cat.';'));
      $category = $getcat['category_name'];
        $cocktails[] = new Cocktail($id, $titel, $description, $image, $ingredients, $category, $rating);
      }
      return $cocktails;
      $this->con->closeConnection();
  }
  /**
  * get information of specific cocktail
  * @param $id
  */
  public function getCocktail($id){
    $cocktails = array();
    $con = $this->db->getConnection();
      foreach(mysqli_query($con, 'SELECT * FROM cocktail_details WHERE idcoccktail_details='.$id)as $key){
        $titel = $key['c_name'];
        $description = $key['c_description'];
        $id = $key['idcoccktail_details'];
        $image = $key['c_image'];
        $cat = $key['category'];
        $ingredients = array();
        foreach (mysqli_query($con, 'Select i.ingredient, a.amount from cocktails join ingredients i on fk_ingredient_id=idingredients join amounts a on fk_amounts_id=idamounts where fk_detail_id='.$id.';') as $co) {
          $ingredients[] = array($co['ingredient'],$co['amount']);
        }
        $rating = 0;
        $count = 0;
        foreach (mysqli_query($con, 'SELECT * FROM rating where fk_cocktail='.$id.';') as $co) {
          $rating = $rating + $co['rating'];
          $count++;
        }
        if ($count != 0) {
          $rating = round($rating/$count);
        }else{
          $rating = 0;
        }
        $getcat = mysqli_fetch_assoc(mysqli_query($con, 'SELECT category_name FROM categories where idcategories='.$cat.';'));
      $category = $getcat['category_name'];
        $cocktail = new Cocktail($id, $titel, $description, $image, $ingredients, $category, $rating);
      }
      return $cocktail;
      $this->con->closeConnection();
  }
  /**
  * get list of ingredients
  */
  public function getIngredients(): array{
    $ingredients = array();
    $con = $this->db->getConnection();
      foreach(mysqli_query($con, 'SELECT * FROM ingredients')as $key){ $ingredients[$key['idingredients']] = $key['ingredient']; }
      return $ingredients;
      $this->con->closeConnection();
  }
  /**
  * get list of amounts
  */
  public function getAmounts(): array{
    $amounts = array();
    $con = $this->db->getConnection();
      foreach(mysqli_query($con, 'SELECT * FROM amounts')as $key){ $amounts[$key['idamounts']] = $key['amount']; }
      return $amounts;
      $this->con->closeConnection();
  }
  /**
  * get list of categories
  */
  public function getCategories(): array{
    $category = array();
    $con = $this->db->getConnection();
      foreach(mysqli_query($con, 'SELECT * FROM categories')as $key){ $category[$key['idcategories']] = $key['category_name']; }
      return $category;
      $this->con->closeConnection();
  }
  /**
  * delete a cocktail
  */
  public function deleteCocktail($id){
    $con = $this->db->getConnection();
    $con->query('DELETE FROM cocktails WHERE fk_detail_id='.$id);
    $con->query('DELETE FROM rating WHERE fk_cocktail='.$id);
    $con->query('DELETE FROM cocktail_details WHERE idcoccktail_details='.$id);
    header('Location: index.php');
  }
  /**
  * get amounts of cocktail in categorie
  * @param $cat
  */
  public function getAmountOfCocktails($cat){
    $con = $this->db->getConnection();
    if ($cat!= 0) {
      $query =  'SELECT COUNT(*) as count FROM cocktail_details WHERE category='.$cat;
    }else{
      $query = 'SELECT COUNT(*) as count FROM cocktail_details';
    }
    $sql = mysqli_query($con, $query);
        $row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
    return $row['count'];
  }
}
?>