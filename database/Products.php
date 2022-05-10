<?php

abstract class Product {
    protected $host = 'localhost';
    protected $user = 'id18845999_root';
    protected $password = 'V=L2v}{KAe\8KU@u';
    protected $database = "id18845999_juniordev";
    public $table = "products";

     public $con = null;

    public $type;
    public $id;
    public $sku;
    public $name;
    public $price;
    public $attributes;

    public function __construct($type) {
      $this->type = $type;
      $this->con = new mysqli($this->host, $this->user, $this->password, $this->database);
      if ($this->con->connect_error){
        echo "Fail " . $this->con->connect_error;
        }
    }

    abstract public function getData();
    abstract public function postData();
}


class DVD extends Product {

    public function setSku($sku){
        $this->sku = $sku;
        }
    public function getSku(){
        return $this->sku;
        }
    public function setName($name){
        $this->name = $name;
        }
    public function getName(){
        return $this->name;
        }
    public function setPrice($price){
        $this->price = $price;
        }
    public function getPrice(){
        return $this->price;
        }
    public function setAttr($attributes){
        $this->attributes = $attributes;
        }
    public function getAttr(){
        return $this->attributes;
        }
    public function getType(){
        return $this->type;
        }

    public function getData() {

        $result = $this->con->query("SELECT * FROM $this->table WHERE type='$this->type'");

        $resultArray = array();

        while ($item = $result->fetch_array(MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }
       

    public function postData(array $list = []) {
        $this->setSku($list[0]);
        $this->setName($list[1]);
        $this->setPrice($list[2]);
        $this->setAttr($list[3]);

        $sku = $this->getSku();
        $name = $this->getName();
        $price = $this->getPrice();
        $attribute = $this->getAttr(); 
        $type = $this->getType(); 
        
        $size = trim($attribute, " ");
        $size.="MB";

        $arr = array($sku, $name, $price, $attribute, $type );
        $query = "INSERT INTO $this->table (sku, name, price, attribute, type) VALUES ('$sku', '$name',  '$price', '$size', '$type')";
        $result = $this->con->query($query);
        if(!$result) {
            echo 'error occured';
            }
        else {
            //header("Location: index.php");
            header("Location: https://juniordev123.000webhostapp.com");
            }  
        }
}

class Book extends Product {

    public function setSku($sku){
        $this->sku = $sku;
        }
    public function getSku(){
        return $this->sku;
        }
    public function setName($name){
        $this->name = $name;
        }
    public function getName(){
        return $this->name;
        }
    public function setPrice($price){
        $this->price = $price;
        }
    public function getPrice(){
        return $this->price;
        }
    public function setAttr($attributes){
        $this->attributes = $attributes;
        }
    public function getAttr(){
        return $this->attributes;
        }
    public function getType(){
        return $this->type;
        }

    public function getData() {

            $result = $this->con->query("SELECT * FROM $this->table WHERE type='$this->type'");
    
            $resultArray = array();
    
            while ($item = $result->fetch_array(MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }
    
            return $resultArray;
        }

    public function postData($list = []) {
        $this->setSku($list[0]);
        $this->setName($list[1]);
        $this->setPrice($list[2]);
        $this->setAttr($list[3]);

        $sku = $this->getSku();
        $name = $this->getName();
        $price = $this->getPrice();
        $attribute = $this->getAttr(); 
        $type = $this->getType(); 

        $weight = trim($attribute, " ");
        $weight.="KG";

        $arr = array($sku, $name, $price, $attribute, $type );
        $query = "INSERT INTO $this->table (sku, name, price, attribute, type) VALUES ('$sku', '$name',  '$price', '$weight', '$type')";
        $result = $this->con->query($query);
        if(!$result) {
            echo 'error occured';
            }
        else {
            //header("Location: index.php");
            header("Location: https://juniordev123.000webhostapp.com");
            }  
        }
}


class Furniture extends Product {

    public function setSku($sku){
        $this->sku = $sku;
        }
    public function getSku(){
        return $this->sku;
        }
    public function setName($name){
        $this->name = $name;
        }
    public function getName(){
        return $this->name;
        }
    public function setPrice($price){
        $this->price = $price;
        }
    public function getPrice(){
        return $this->price;
        }
    public function setAttr($attributes){
        $this->attributes = $attributes;
        }
    public function getAttr(){
        return $this->attributes;
        }
    public function getType(){
        return $this->type;
        }

        public function getData() {

            $result = $this->con->query("SELECT * FROM $this->table WHERE type='$this->type'");
    
            $resultArray = array();
    
            while ($item = $result->fetch_array(MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }
    
            return $resultArray;
        }

    public function postData($list = []) {
        $this->setSku($list[0]);
        $this->setName($list[1]);
        $this->setPrice($list[2]);
        $this->setAttr($list[3]);

        $sku = $this->getSku();
        $name = $this->getName();
        $price = $this->getPrice();
        $attribute = $this->getAttr(); 
        $type = $this->getType(); 

        $dimension = preg_replace('/\s+/', 'x', $attribute);
        $dimension .= "CM";
        $dimension = ltrim($dimension,"x");

        $arr = array($sku, $name, $price, $attribute, $type );
        $query = "INSERT INTO $this->table (sku, name, price, attribute, type) VALUES ('$sku', '$name',  '$price', '$dimension', '$type')";
        $result = $this->con->query($query);
        if(!$result) {
            echo 'error occured';
            }
        else {
            header("Location: https://juniordev123.000webhostapp.com");
         }   
        }
}