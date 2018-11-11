<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 11/10/18
 * Time: 1:21 PM
 */

class Address
{
    public $address;
    public $apt;
    public $city;
    public $state;
    public $zipCode;
    public $phone;

    public static function fromQuery($uid)
    {
        $dbh = new DBHelper();
        $query = "SELECT * FROM `Address` WHERE customerId = '$uid' AND isPrimary = '1'";
        $result = $dbh->query($query);

        $row = mysqli_fetch_array($result);
        return self::fromRow($row);
        $dbh->close();
    }

    public static function fromRow($row)
    {
        $addr = new Address();
        $addr->address = $row['streetAddress'];
        $addr->apt = $row['apt'];
        $addr->city = $row['city'];
        $addr->state = $row['state'];
        $addr->zipCode = $row['zipCode'];
        $addr->phone = $row['phoneNumber'];

        return $addr;
    }
}