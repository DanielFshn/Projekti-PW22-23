<?php
class ProductToAdd
{
    // Properties
    public $id;
    public $name;
    public $description;
    public $price;
    public $size;
    public $category;
    public $imageUrl;
    // Methods
    public function __construct($id,$n, $des, $pr, $siz, $cat,$image)
    {
        $this->id = $id;
        $this->name = $n;
        $this->description = $des;
        $this->price = $pr;
        $this->category = $cat;
        $this->imageUrl = $image;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getCategory()
    {
        return $this->category;
    }
    public function getImage(){
        return $this->imageUrl;
    }
}
