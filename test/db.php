<?php include("../top.html");
/**
 * Created by PhpStorm.
 * User: Binny
 * Date: 7/30/2015
 * Time: 11:54 AM
 */



$dbhost = "localhost";
$dbuser = "user";
$dbpass = "password";

function dbConnect($db="") {
    global $dbhost, $dbuser, $dbpass;

    $dbcnx = @mysql_connect($dbhost, $dbuser, $dbpass)
    or die("The site database appears to be down.");

    if ($db!="" and !@mysql_select_db($db))
        die("The site database is unavailable.");

    return $dbcnx;
}
?>