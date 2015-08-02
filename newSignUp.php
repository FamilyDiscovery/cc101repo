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

//add info to profiles.txt
$file_name = $_POST['name'] . "" . $_POST['surname'] . ".txt";
$file = fopen('profiles.txt','a');
// The new data to add to the file
$data = implode(",", $_POST) . "," . $_POST['city_born'] . "," . $file_name . PHP_EOL;


fwrite($file, $data);
fclose($file);

//create profile txt file for new user
$file_name = "profiles/" . $_POST['name'] . "" . $_POST['surname'] . ".txt";
$my_file = fopen($file_name,"w");

$txt = "[
    new primitives.orgdiagram.ItemConfig({
                    id: 0,
                    parent: null,
                    title:\" ". $_POST['surname'] . "\",
                    description: \"city,state\",
                    image: \"user.jpg\"
                }),
                new primitives.orgdiagram.ItemConfig({
                    id: 1,
                    parent: 0,
                    title:\" ". $_POST['surname'] . "\",
                    description: \"city,state\",
                    image: \"user.jpg\"
                }),
                new primitives.orgdiagram.ItemConfig({
                    id: 2,
                    parent: 0,
                    title:\" ". $_POST['maiden_name'] . "\",
                    description: \"city,state\",
                    image: \"user.jpg\"
                })
            ];";

fwrite($my_file, $txt);
fclose($my_file);

include("bottom.html"); ?>