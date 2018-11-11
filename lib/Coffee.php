<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 11/1/18
 * Time: 11:15 PM
 */
include_once "DBHelper.php";

class Coffee
{
    public $productCode;
    public $country;
    public $name;
    public $price;
    public $description;
    public $thumbnail;
    public $viewCount;
    public $avgRating = 0;

    public function __construct()
    {

    }

    public static function fromQuery($pcode)
    {
        $dbh = new DBHelper();
        $query = "SELECT productCode, name, country, price, description, thumbnail, viewCount FROM Roncabeanz.Coffee  WHERE productCode = '$pcode' ";
        $result = $dbh->query($query);
        $row = mysqli_fetch_array($result);
        return self::fromRow($row);

    }
    public static function fromRow($row)
    {
        $ret = new Coffee();
        $ret->loadFromRow($row);
        return $ret;
    }

    private function loadFromRow($row)
    {

        $this->productCode = $row["productCode"];
        $this->country = $row["country"];
        $this->name = $row["name"];
        $this->price = $row["price"];
        $this->description = $row["description"];
        $this->viewCount = $row["viewCount"];

        if($row["thumbnail"] != null)
        {
            $this->thumbnail = "images/".$row["thumbnail"];
        }
        else {
            $this->thumbnail = "images/CoffeeThumbnail.jpg";
        }

        $dbh = new DBHelper();
        $query = "SELECT AVG(rating) FROM Ratings WHERE productCode=$this->productCode";
        $rRow = mysqli_fetch_array($dbh->query($query));

        if($rRow != null && $rRow["AVG(rating)"] != null){
            $this->avgRating = $rRow["AVG(rating)"];
        }
        else{
            $this->avgRating = 0;
        }
    }

    public function displayName(){
        return $this->country." ".$this->name;
    }
}