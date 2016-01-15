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

    }
}
/*
 * Bug check whats in the variables
 *
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

    $given_name="";
    $db = new PDO("mysql:dbname=profiles;host=localhost","root","binnil");
    $rows = $db->query("SELECT first_name,last_name FROM members WHERE email LIKE \"" . $_POST['email'] . "\" limit 1");
    $data= [];
    foreach($rows as $row) {
        $given_name = $row["first_name"];
        $query_name = $given_name . $row["last_name"];
        $query_name = "SELECT * FROM " . strtolower($query_name);
        $new_table = $db->query($query_name);

        foreach ($new_table as $info) {
            array_push($data, $info["col1"], $info["col2"], $info["col3"], $info["col4"]);
        }
    }
?>

    <!--<div class="container">-->
        <div class="row2">
            <a class="button" href="index.php">Log Out</a>
            <a class="button" href="matches.php">Check Matches</a>
        </div>

    <table style="margin: auto; width: 65%;" dir="ltr" width="500" border="1" summary="purpose/structure for speech output">
        <caption>
            Ancestral chart for <?=$members[0] . " " . $nodes[0][0] ?>
        </caption>
        <!--
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
        -->
        <tbody>
        <tr>
            <td><p id="node0"><a class="button" href="#">Add Grandfather</a></p>
                <div id="new_node0" style="display: none;">
                    <form>
                        <label>
                            <span>Surname:</span><br/>
                            <input type="text" name="surname"><br>
                        </label>
                        <label>
                            <span>City Where Born:</span><br/>
                            <input type="text" name="city"><br/>
                        </label>
                        <label>
                            <input class="button" type="submit" value="Submit"><br/>
                        </label>
                    </form>
                </div>
            </td>
            <td><p id="node1"><a class="button" href="#">Add Grandmother</a></p>
                <div id="new_node1" style="display: none;">
                    <form>
                        <label>
                            <span>Surname:</span><br/>
                            <input type="text" name="surname"><br>
                        </label>
                        <label>
                            <span>City Where Born:</span><br/>
                            <input type="text" name="city"><br/>
                        </label>
                        <label>
                            <input class="button" type="submit" value="Submit">
                        </label>
                    </form>
                </div>
            </td>
            <td><p id="node2"><a class="button" href="#">Add Grandfather</a></p>
                <div id="new_node2" style="display: none;">
                    <form>
                        <label>
                            <span>Surname:</span><br/>
                            <input type="text" name="surname"><br>
                        </label>
                        <label>
                            <span>City Where Born:</span><br/>
                            <input type="text" name="city"><br/>
                        </label>
                        <label>
                            <input class="button" type="submit" value="Submit">
                        </label>
                    </form>
                </div>
            </td>
            <td><p id="node3"><a class="button" href="#">Add Grandmother</a></p>
                <div id="new_node3" style="display: none;">
                    <form>
                        <label>
                            <span>Surname:</span><br/>
                            <input type="text" name="surname"><br>
                        </label>
                        <label>
                            <span>City Where Born:</span><br/>
                            <input type="text" name="city"><br/>
                        </label>
                        <label>
                            <input class="button" type="submit" value="Submit">
                        </label>
                    </form>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2"><?= $data[16]?><br/><?= implode(", ",array($data[17],$data[18],$data[19])); ?></td>
            <td colspan="2"><?= $data[4] ?><br/><?= implode(", ",array($data[5],$data[6],$data[7])); ?></td>
        </tr>
        <tr>
            <td id="root" scope="col" colspan="4"><?= $row["first_name"] . " " . $data[0] ?><br/><?= implode(", ",array($data[1],$data[2],$data[3]));  ?></td>
        </tr>

        </tbody>
    </table>
    <br/><br/><br/><br/><br/><br/>

    <!-- test table using mysql database 'profiles' -->


    <script type="text/javascript">

        $("#node0").click(function() {
            $( this ).slideUp();
            $("#new_node0").show();
        });
        $("#node1").click(function() {
            $( this ).slideUp();
            $("#new_node1").show();
        });
        $("#node2").click(function() {
            $( this ).slideUp();
            $("#new_node2").show();
        });
        $("#node3").click(function() {
            $( this ).slideUp();
            $("#new_node3").show();
        });

        $("form").on('submit', function() {
            return false;
        });
    </script>

<?php include("bottom.html"); ?>