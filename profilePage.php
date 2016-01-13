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
    if ($_POST['email'] ===  $info[2]) {
        $members = $info;
        break;
    }
    else {
        /*
        echo '<p style="color:red">This is the members variable</p>';
        print_r($members);
        echo '<p style="color:red"> this is the info variable</p>';
        print_r($info);
        */
    }
}
/*
echo '<p style="color:red">This is the members variable</p>';
print_r($members);
echo '<p style="color:red"> this is the info variable</p>';
print_r($info);
*/

    $nodes = [];
    $profile = file("profiles/". "$members[4]", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)  ;

    for($i = 0; $i < count($profile); $i++) {

        $profile[$i] = explode(",", $profile[$i]);
        if($profile[$i][1] != null) {
            //echo "True";
            array_push($nodes, $profile[$i]);
        }
    }

?>

    <div class="container">
        <div class="row2">
            <a class="button" href="index.php">Log Out</a>
            <a class="button" href="matches.php">Check Matches</a>
        </div>

    <table style="margin: auto; width: 65%;" dir="ltr" width="500" border="1" summary="purpose/structure for speech output">
        <caption>
            Upside-down ancestral chart for <?=$members[0] . " " . $nodes[0][0] ?>
        </caption>
        <thead>
        <tr>
            <th id="root" scope="col" colspan="4"><?=$members[0] . " " . $nodes[0][0] ?><br/><?= implode(", ",array($nodes[0][1],$nodes[0][2],$nodes[0][3]));  ?></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="2"><a href="#">Add Ancestors</a></td>
            <td colspan="2"><a href="#">Add Ancestors</a> </td>
        </tr>
        </tfoot>
        <tbody>
        <tr>
            <td colspan="2"><?= $nodes[1][0] ?><br/><?= implode(", ",array($nodes[1][1],$nodes[1][2],$nodes[1][3])); ?></td>
            <td colspan="2"><?= $nodes[2][0] ?><br/><?= implode(", ",array($nodes[2][1],$nodes[2][2],$nodes[2][3])); ?></td>
        </tr>
        <tr>
            <td>Grandfather</td>
            <td>grandmother</td>
            <td>Grandfather</td>
            <td>grandmother</td>
        </tr>

        </tbody>
    </table>

<?php include("bottom.html"); ?>