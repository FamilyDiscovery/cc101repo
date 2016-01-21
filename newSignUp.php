<?php include('top.html');
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 4/17/2015
 * Time: 4:30 AM
 */
?>

  <div class="container">
    <h1>Thank you!</h1>
    <h2>Welcome to Cousin Connects <?= $_POST['name'] ?>!!</h2>
    <a class="button" href="logIn.php">Log In</a>
    <a class="button" href="index.php">Home</a>
    <div id="error"></div>
  </div>


<?php
require_once 'Phonetic/Phonetic.php';

// add new member to member table in profile database
$db = new PDO("mysql:dbname=profiles;host=localhost","root","binnil");
//if ($conn->connect_error) {
//    die("connection failed: " . $conn->connect_error);
//}

$name = strtolower($_POST['name']);
$surname = strtolower($_POST['surname']);
$sql = "INSERT INTO 'members' (first_name,last_name,email,password)
  VALUES ('" . $name . "', '" . $surname . "', '" .
    $_POST['email'] . "', '" . $_POST['password'] . "')";

$db->exec($sql);

// sql to create table
$sql_table = "CREATE TABLE " . $name . $surname . " (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
reg_date TIMESTAMP,
col1 VARCHAR(30) NOT NULL,
col2 VARCHAR(30) NOT NULL,
col3 VARCHAR(30) NOT NULL,
col4 VARCHAR(30) NOT NULL,
col5 VARCHAR(30) NOT NULL
)";
//create table
$db->exec($sql_table);

// info to add to the table
$location = explode(", ", $_POST['city_born']);
for ($i=sizeof($location);$i>0;$i--) {
    if (sizeof($location) < 4) {
        $location[3] = "";
        if (sizeof($location < 3)) {
            $location[2] = "";
            if (sizeof($location == 2)) {
                $location[1] = "";
            }
        }
    }
}

$sql_line1 = "INSERT INTO " . $name . $surname . " (col1, col2, col3, col4, col5)" .
    " VALUES ('" . $surname . "', '" . $location[0] . "', '" .
    $location[1] . "', '" . $location[2] . "', '" . $location[3] . "');";

$location_mother = explode(", ", $_POST['mother_city']);
for ($i=sizeof($location_mother);$i>0;$i--) {
    if (sizeof($location_mother) < 4) {
        $location_mother[3] = "";
        if (sizeof($location_mother < 3)) {
            $location_M[2] = "";
            if (sizeof($location_mother == 2)) {
                $location_mother[1] = "";
            }
        }
    }
}
if (sizeof($location_mother) < 4) {
    $location_mother[3] = "";
}
$sql_line2 = "INSERT INTO " . $name . $surname . " (col1, col2, col3, col4, col5)" .
    " VALUES ('" . $_POST['maiden_name'] . "', '" . $location_mother[0] . "', '" .
    $location_mother[1] . "', '" . $location_mother[2] . "', '" . $location_mother[3] . "');";

$sql_line3 = "INSERT INTO " . $name . $surname . " (col1)" .
    " VALUES ('0');";
$sql_line4 = "INSERT INTO " . $name . $surname . " (col1)" .
    " VALUES ('0');";
$sql_line5 = "INSERT INTO " . $name . $surname . " (col1, col2, col3, col4, col5)" .
    " VALUES ('" . $surname . "', '" . $location[0] . "', '" .
    $location[1] . "', '" . $location[2] . "', '" . $location[3] . "');";
$sql_line6 = "INSERT INTO " . $name . $surname . " (col1)" .
    " VALUES ('0');";
$sql_line7 = "INSERT INTO " . $name . $surname . " (col1)" .
    " VALUES ('0');";
$sql_lines = array();
$sql_lines[0] = $sql_line1;
$sql_lines[1] = $sql_line2;
$sql_lines[2] = $sql_line3;
$sql_lines[3] = $sql_line4;
$sql_lines[4] = $sql_line5;
$sql_lines[5] = $sql_line6;
$sql_lines[6] = $sql_line7;

// add info to table
foreach($sql_lines as $line) {
    $db->exec($line);
}


/*
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
}
 else {
    echo "Error: " . $sql . "<br/>" . $conn->error;
}
*/

//add info to profiles.txt
$file_name = $_POST['name'] . "" . $_POST['surname'] . ".txt";
$file = fopen('profiles.txt','a');
// The new data to add to the file
$data = $_POST['name'] . "," . $_POST['surname'] . "," . $_POST['email'] . "," . $_POST['password'] . "," .  $file_name . PHP_EOL;


fwrite($file, $data);
fclose($file);

//create profile txt file for new user
$file_name = "profiles/" . $_POST['name'] . "" . $_POST['surname'] . ".txt";
$my_file = fopen($file_name,"w");

$txt = $_POST['surname'] . "," . $_POST['maiden_name'] . "," . "0" . "," . "0" . "," . $_POST['surname'] . "," . "0" . "," . "0" .
    "\r\n" . $_POST['city_born'] . "," . $_POST['mother_city'] . "," . "0" . "," . "0" . "," . $_POST['city_born'] . "," . "0" . "," . "0";


/*
$txt = "[
    new primitives.orgdiagram.ItemConfig({
                    id: 0,
                    parent: null,
                    title:\" ". $_POST['surname'] . "\",
                    description: \" ". $_POST['city_born'] . "\",
                    image: \"user.jpg\"
                }),
                new primitives.orgdiagram.ItemConfig({
                    id: 1,
                    parent: 0,
                    title:\" ". $_POST['surname'] . "\",
                    description: \" ". $_POST['city_born'] . "\",
                    image: \"user.jpg\"
                }),
                new primitives.orgdiagram.ItemConfig({
                    id: 2,
                    parent: 0,
                    title:\" ". $_POST['maiden_name'] . "\",
                    description: \" ". $_POST['mother_city'] . "\",
                    image: \"user.jpg\"
                })
            ];";
*/

fwrite($my_file, $txt);
fclose($my_file);

include("bottom.html"); ?>