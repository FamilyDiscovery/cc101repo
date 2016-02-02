<?php include("top.html");
/**
 * Created by PhpStorm.
 * User: Binny
 * Date: 1/24/2016
 * Time: 2:13 AM
 *
 * This php file is called by profilePage to use ajax to add
 * grandparents to the database
 */


?>

<script>

    window.alert("file was opened");

</script>

<?php
// open connection to the database
$db = new PDO("mysql:dbname=profiles;host=localhost","root","binnil");

// get info from database and display in chart
$rows = $db->query("SELECT first_name,last_name,father_id,mother_id,birth_town FROM members WHERE email LIKE \"" . $_POST['email'] . "\" limit 1");

foreach($rows as $row) {
    $father_id = $row["father_id"];
    $mother_id = $row["mother_id"];

// create new id for grandparents based on id of child/root
$grandparent_id = 1 ;
$which_parent = "";

// set correct gender
$gender = $_POST['gender'] . "";
$child_id = 0;

// if male
if ($gender % 2 == 0) {
    $gender = "Mr.";
    $grandparent_id = ($father_id*2) + 1001;
    $which_parent = "father_id";
}

// else female
else {
    $gender = "Mrs.";
    $grandparent_id = ($mother_id*2) + 1002;
    $which_parent = "mother_id";
}

// see if maternal or paternal grandfather
if ($gender < 2) {
    $child_id = $father_id;
}
else {
    $child_id = $mother_id;
}

$sql = "INSERT INTO fam_members (id,first_name,last_name,birth_town,child_id) VALUES ('" . $grandparent_id . "', '" . $gender . "', '" .
    $_POST['surname'] . "', '" . $_POST['city_born'] . "', '" . $child_id . "');";
print_r($sql);
$db->exec($sql);
$sql = "UPDATE fam_members SET " . $which_parent . " = ". $grandparent_id .
    " WHERE id= " . $child_id . ";";
$db->exec($sql);
}

 include("bottom.html"); ?>
