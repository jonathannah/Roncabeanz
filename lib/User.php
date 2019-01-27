<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 11/9/18
 * Time: 10:46 PM
 */

include_once "DBHelper.php";
include_once 'CurlHelper.php';
include_once 'Cookies.php';

class User
{
    public $fname;
    public $lname;
    public $email;
    public $password;
    public $group;
    public $address;
    public $apt;
    public $city;
    public $state;
    public $zipCode;
    public $cellPhone;
    public $homePhone;

    public static function fromQuery($uid)
    {
        $dbh = new DBHelper();
        $query = "SELECT * FROM  User WHERE LOWER(emailAddress) = LOWER('$uid')";
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

        $user->address = $row['streetAddress'];
        $user->apt = $row['apt'];
        $user->city = $row['city'];
        $user->state = $row['state'];
        $user->zipCode = $row['zipCode'];
        $user->cellPhone = $row['cellPhone'];
        $user->homePhone = $row['homePhone'];
        $user->group = $row["groupID"];

        return $user;
    }

    static function fromToken($uToken)
    {
        $user = new User();

        $ch = new CurlHelper();
        $userJson = $ch->get("http://teamalphamarket.com/TeamAlphaMarket/ReadUserInfo.php?userToken=".$uToken);

        $udec = json_decode($userJson, TRUE);

        $user->fname = $udec[0]["firstName"];
        $user->lname = $udec[0]["lastName"];
        $user->email = $udec[0]["emailAddress"];
        $user->password = $udec[0]["password"];

        $user->address = $udec[0]['streetAddress'];
        $user->apt = $udec[0]['apt'];
        $user->city = $udec[0]['city'];
        $user->state = $udec[0]['state'];
        $user->zipCode = $udec[0]['zipCode'];
        $user->cellPhone = $udec[0]['cellPhone'];
        $user->homePhone = $udec[0]['homePhone'];
        $user->group = $udec [0]["groupID"];

        return $user;
    }

    function writeUser()
    {
        $dbh = new DBHelper();

        $query = "SELECT emailAddress FROM Roncabeanz.User WHERE emailAddress='$this->email' ";
        error_log($query);
        $result = $dbh->query($query);

        if($result->num_rows == 0) {

            $add = "INSERT INTO Roncabeanz.User (firstName, lastName, emailAddress, streetAddress, apt, city, state, zipCode, homePhone, cellPhone, groupID, password)";
            $values = "VALUES
            (
                '$this->fname', '$this->lname', '$this->email', '$this->address', '$this->apt', 
                '$this->city', '$this->state', '$this->zipCode', '$this->homePhone', '$this->cellPhone', 'Customer', '$this->password'
            )";


            $query = $add . " " . $values;
            error_log($query);
            $dbh->query($query);
        }

        $dbh->close();
    }

    static function getCurrentUID()
    {
        $user = self::getCurrentUser();

        if($user != null){
            return $user->email;
        }
        return null;
    }

    static function getCurrentUser()
    {
        if(isset($_COOKIE[COOKIE_TAM_UTOKEN])){
            return self::fromToken($_COOKIE[COOKIE_TAM_UTOKEN]);
        }
        else if(isset($_COOKIE[COOKIE_EMAIL])){
            return self::fromQuery($_COOKIE[COOKIE_EMAIL]);
        }

        return null;
    }

}