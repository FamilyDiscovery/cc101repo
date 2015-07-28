<?php include("top.html"); ?>
<div class="container">
	<strong>Thank you!</strong><br><br>
	Welcome to Cousin Connects <?= $_POST['name'] ?>!!<br>
	<br>
	Now <a class="button" href="matches.php">log in</a> to see your matches!<br>
	<br>
</div>
<?php 
$name = $_POST['surname'];

require_once 'Phonetic/Phonetic.php';
$phonetic = Phonetic::app()->run();   // can also be >run('sep'); or ash or gen (generic)
$soundkeys = $phonetic->BMSoundex->getNumericKeys($name);

$file = fopen('members.txt','a');
// The new data to add to the file
$data = "\n\n\n\n" . implode(",", $_POST) . "," . $soundkeys[0][0] . PHP_EOL;

//for ($i = 0; $i < count($soundkeys[0]); $i++) {
	//$data .= "," . $soundkeys[0][0]; 
//}

// Write the contents to the file, 
// using the FILE_APPEND flag to append the content to the end of the file
// and the LOCK_EX flag to prevent anyone else writing to the file at the same time
//file_put_contents($file, $data, FILE_APPEND | LOCK_EX);fwrite($file, $data);

?>
	
<?php include("bottom.html"); ?>