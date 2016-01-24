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

// open database connection for mysql
$db = new PDO("mysql:dbname=profiles;host=localhost","root","binnil");
/*
if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}
*/

// create id and add entry in members table for new user
$name = strtolower($_POST['name']);
$surname = strtolower($_POST['surname']);
$sql = "INSERT INTO members (first_name, last_name, email, password, birth_town)" .
  " VALUES ('" . $name . "', '" . $surname . "', '" .
    $_POST['email'] . "', '" . $_POST['password'] . "', '" . $_POST['city_born'] . "');";
$db->exec($sql);

// add parents id numbers to user entry in table members
// get id of child/root
$sql_id = "SELECT id FROM members WHERE email like '" . $_POST['email'] ."';";
$new_id = $db->query($sql_id);
foreach($new_id as $user_id) {
    $user_id = $user_id["id"];
}
$user_id = (int)$user_id;
// create new id for parents based on id of child/root
$new_id_father = ($user_id*2) + 1001;
$new_id_mother = ($user_id*2) + 1002;
$sql = "UPDATE members SET father_id=". $new_id_father .", mother_id=" . $new_id_mother .
    " WHERE email= '" . $_POST['email'] . "';";
$db->exec($sql);

/*
 *  insert new entry into fam_members, for parents of user
*/

// add father
$sql_entry = "INSERT INTO fam_members (id,first_name,last_name, birth_town,child_id)" .
    "VALUES('" . $new_id_father . "', '" . "Mr." . "', '" . $surname . "', '" . $_POST['city_born'] . "', '" . $user_id . "');";
$db->exec($sql_entry);

// add mother
$sql_entry = "INSERT INTO fam_members (id,first_name,last_name, birth_town,child_id)" .
    "VALUES('" . $new_id_mother . "', '" . "Mrs." . "', '" . $_POST['maiden_name'] . "', '" . $_POST['mother_city'] . "', '" . $user_id . "');";
$db->exec($sql_entry);



/*
 * Alternate method of storing data using txt files
 * -----------------------------------------------------------
 * Create a new table for user and insert all relevant info
 * this method creates users own table (in database 'profiles', and) in their own text file
*/

/*
// change empty cells in location array to null
function chEmptyToNull($loc) {
    if (sizeof($loc) < 4) {
        $loc[3] = "";
        if (sizeof($loc) < 3) {
            $loc[2] = "";
            if (sizeof($loc) == 2) {
                $loc[1] = "";
            }
        }
    }
    return $loc;
}

// format location for database cell
function formatLocation($location_name) {
    $loc_size = sizeof($location_name);
    $id_local = "";
    $comma = ", ";
    $i=0;
    while($i< $loc_size) {
        if ($i == $loc_size-1){
            $comma = "";
        }
        $id_local = $id_local . $location_name[$i] . $comma;
        $i++;
    }
    return $id_local;
}

// split location string into array
$location = explode(", ", $_POST['city_born']);
// change empty location slots to null
$location = chEmptyToNull($location);
// do same for location of mother
$location_mother = explode(", ", $_POST['mother_city']);
$location_mother = chEmptyToNull($location_mother);
// format location as a string for storage in one cell
$formatted_location = formatLocation($location);
$formatted_location_mother = formatLocation($location_mother);


// sql to create table for new user with all info
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

// add info into table of user name ex: TABLE tedcruz
$sql_line1 = "INSERT INTO " . $name . $surname . " (col1, col2, col3, col4, col5)" .
    " VALUES ('" . $surname . "', '" . $location[0] . "', '" .
    $location[1] . "', '" . $location[2] . "', '" . $location[3] . "');";

$location_mother = explode(", ", $_POST['mother_city']);
$location_mother = chEmptyToNull($location_mother);

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
*/
//----------------------------------------------
// temporarily in use for password verification
//----------------------------------------------
//add info to profiles.txt
$file_name = $_POST['name'] . "" . $_POST['surname'] . ".txt";
$file = fopen('profiles.txt','a');
// The new data to add to the file
$data = $_POST['name'] . "," . $_POST['surname'] . "," . $_POST['email'] . "," . $_POST['password'] . "," .  $file_name . PHP_EOL;

fwrite($file, $data);
fclose($file);
//-----------------------------------------------
//-----------------------------------------------
/*
//create profile txt file for new user
$file_name = "profiles/" . $_POST['name'] . "" . $_POST['surname'] . ".txt";
$my_file = fopen($file_name,"w");

$txt = $_POST['surname'] . "," . $_POST['maiden_name'] . "," . "0" . "," . "0" . "," . $_POST['surname'] . "," . "0" . "," . "0" .
    "\r\n" . $_POST['city_born'] . "," . $_POST['mother_city'] . "," . "0" . "," . "0" . "," . $_POST['city_born'] . "," . "0" . "," . "0";

*/
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
/*
fwrite($my_file, $txt);
fclose($my_file);
*/

include("bottom.html"); ?>