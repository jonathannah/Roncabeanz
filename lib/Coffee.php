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
    public $units;
    public $description;
    public $thumbnail;

    public function __construct()
    {

    }

    public static function fromQuery($pcode)
    {
        $dbh = new DBHelper();
        $query = "SELECT productCode, name, country, price, units, description, thumbnail FROM Roncabeanz.Coffee  WHERE productCode = '$pcode' ";
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
        $this->units = $row["units"];
        $this->description = $row["description"];

        if($row["thumbnail"] != null)
        {
            $this->thumbnail = "images/".$row["thumbnail"];
        }
        else {
            $this->thumbnail = "images/CoffeeThumbnail.jpg";
        }

    }
}