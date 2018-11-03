<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 10/20/18
 * Time: 9:49 PM
 */

include_once 'Cookies.php';

session_start();


setcookie(COOKIE_EMAIL, "", 0, "/");
setcookie(COOKIE_NAME, "", 0, "/");
$_COOKIE[COOKIE_NAME] = "";
$_COOKIE[COOKIE_EMAIL] = "";
$ref = $_SESSION['ref'];
session_write_close();


$pathParts = explode("/", $ref);
$page = end($pathParts);
$hdr = "Location: $page";

header($hdr);