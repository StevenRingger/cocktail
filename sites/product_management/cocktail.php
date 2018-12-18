<?php
// by Steven Ringger
// class for cocktail object

class Cocktail
{
    private $id;
    private $title;
    private $description;
    private $image;
    private $ingredients;
    private $cat;
    private $rating;

    /**
     * Article constructor.
     * @param $id
     * @param $title
     * @param $description
     * @param $image
     * @param $ingredients
     * @param $cat
     * @param $rating
     */
    public function __construct($id, $title, $description, $image, $ingredients, $cat, $rating)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->ingredients = $ingredients;
        $this->cat = $cat;
        $this->rating = $rating;
    }

    /**
     * @param mixed $id
     */
    public function setid($id): void{$this->id = $id;}
     public function getid(){return $this->id;}

    /**
     * @param mixed $title
     */
    public function setTitle($title): void{$this->title = $title;}
    public function getTitle(){return $this->title;}

    /**
     * @param mixed $description
     */
    public function setdescription($description): void{$this->description = $description;}
    public function getdescription(){return $this->description;}    

    /**
     * @param mixed $image
     */
    public function setimage($image): void{$this->image = $image;}
    public function getimage(){return $this->image;}

    /**
     * @param mixed $ingredients
     */
    public function setingredients($ingredients): void{$this->ingredients = $ingredients;}
    public function getingredients(){return $this->ingredients;}

    /**
     * @param mixed $category
     */
    public function setCat($cat): void{$this->cat = $cat;}
    public function getCat(){return $this->cat;}

    /**
     * @param mixed $category
     */
    public function setRating($rating): void{$this->rating = $rating;}
    public function getRating(){return $this->rating;}
}
?>