<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 11/9/18
 * Time: 10:46 PM
 */

include_once "DBHelper.php";
include_once 'Address.php';

class User
{
    public $fname;
    public $lname;
    public $email;
    public $password;
    public $group;
    public $primaryAddr;

    public static function fromQuery($uid)
    {
        $dbh = new DBHelper();
        $query = "SELECT lastName, firstName, emailAddress, password, groupID FROM  `User` WHERE 'emailAddress' = $uid";
        $result = $dbh->query($query);

        $row = mysqli_fetch_array($result);
        return self::fromRow($row);
        $dbh->close();
    }

    public static function fromRow($row)
    {
        $user = new User();

        $user->fname = $row["firstName"];
        $user->lname = $row["lastName"];
        $user->email = $row["emailAddress"];
        $user->password = $row["password"];
        $user->group = $row["groupID"];

        $user->primaryAddr = Address::fromQuery($user->email);


        return $user;
    }


}