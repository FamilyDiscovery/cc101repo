<?php include("top.html"); ?>

<div class="container">
    <div class="row1">
        <h1><a id="head" href="index.php">Smart Matches Coming Soon</a></h1>
        <h2>Our algorithm can predict with 85% accuracy </h2>
        <h2>the likelihood that you have cousins on Campus</h2>
    </div>
    <div class="row2">
        <a class="button" href="logIn.php">Log In</a>
        <a class="button" href="signUp.php">Sign Up</a>
    </div>	

    <div class="row3">

    </div>

<?php

$members = file("members.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$profiles = file("profiles.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$total=0;

foreach($members as $member) {
    $total++;
}
foreach($profiles as $profile) {
    $total++;
}
echo "Current Users = " . $total;
?>
<!--
    <div>
        <form action="matches-submit.php" method="GET" class="basic-grey">
            <h1> Search Users </h1>
            <label>
                <span>Name:</span>
                <input type="text" name="searchName" placeholder="Surname to search" />
            </label>
            <label>
                <input class="button" type="submit" value="View Matches">
            </label>
        </form><br><br><br><br>
    </div>
-->

</div>

<?php include("bottom.html"); ?>