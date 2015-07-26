<?php include("top.html");
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 4/17/2015
 * Time: 2:57 AM
 */

$members = file("profiles.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach($members as $info) {
    $info = explode(",", $info);
    if ($_POST['password'] ===  $info[4]) {
        $members = $info;
    }
}
?>

    <div class="container">
        <div class="row2">
            <a class="button" href="index.php">Log Out</a>
            <a class="button" href="matches.php">Check Matches</a>
        </div>
        <div class="row3">
            <a class="column" href="#">
                <h3><?= $members[1] ?></h3>
                <h4><?= $members[6] ?></h4>
            </a>
            <a class="column" href="#">
                <h3><?= $members[3] ?></h3>
                <h4><?= $members[7] ?></h4>
            </a>
        </div>
        <div class="row4">
            <a id="root" class="column" href="#">
                <h3><?= $members[1] ?></h3>
                <h4><?= $members[5] ?></h4>
            </a>
        </div>
    </div>


<?php include("bottom.html"); ?>