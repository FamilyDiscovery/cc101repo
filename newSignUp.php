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
    <div id="error"></div>
  </div>

<?php
require_once 'Phonetic/Phonetic.php';
$file = fopen('profiles.txt','a');
// The new data to add to the file
$data = implode(",", $_POST) . PHP_EOL;

fwrite($file, $data);

include("bottom.html"); ?>