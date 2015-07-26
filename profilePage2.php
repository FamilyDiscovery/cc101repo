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
    }
}
?>

    <div class="container">
        <h1>Cousin Connects</h1>
        <div class="row1">
            <a class="button" href="index.php">Log Out</a>
            <a class="button" href="matches.php">Check Matches</a>
        </div>

        <div class="row4">
            <a class="column" href="#">
                <h3><?= $members[1] ?></h3>
                <h4><?= $members[6] ?></h4>
            </a>
            <a class="column" href="#">
                <h3><?= $members[3] ?></h3>
                <h4><?= $members[7] ?></h4>
            </a>
        </div>

        <div class="row5">

            <div id="addOption"  style="display:none;">
                <button class="column">Add <br>Father</button>
                <button class="column">Add <br>Mother</button>
            </div>


            <form id="newInput" name="myForm" action="newSignUp.php" style="display:none;" method="POST" class="basic-grey">

                <p id="title"></p>
                <label id="dude">
                    <input type="text" name="email" placeholder="Surname" />
                </label>
                <label>
                    <input type="text" name="password" placeholder="Town Born" />
                </label>
                <label>
                    <input class="button" type="submit" value="Add Info">
                </label>
            </form>

            <button id="root" class="column">
                <p><?= $members[1] ?></p>
                <p><?= $members[5] ?></p>
            </button>

        </div>

        <div class="row2">
            <div id="chart_div"></div>
        </div>

    <script type="text/javascript">

        google.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Name');
            data.addColumn('string', 'Manager');
            data.addColumn('string', 'ToolTip');

            data.addRows([
                [{v:'child', f:'<div id="box1" class="column">Child</div>'}, '', 'The President'],
                [{v:'dad', f:'<div id="box2" class="column">Father</div>'}, 'child', 'VP'],
                [{v:'mom', f:'<div id="box3" class="column">Mother</div>'}, 'child', ''],
                [{v:'gdad', f:'<div id="box4" class="column">GrandFather</div>'}, 'dad', 'Bob Sponge'],
                [{v:'ggdad', f:'<div id="box5" class="column">GrearGrandFather</div>'}, 'gdad', '']
            ]);


            function blah(e) {
                var selectedItem = chart.getSelection()[0];
                if (selectedItem) {

                    var fath = {v:'father', f:'<form class="basic-grey">Father\'s Surname:<br><input type="text" name="firstname" id="fname" ' +
                    'size="10"><br>Town Born:<br><input type="text" name="lastname" size="10"><button id="button" class="button" ' +
                    'type="button" onclick="addPar()">Enter!</button></form>'};



                    alert('' + '');
                    var value = data.getValue(selectedItem.row, 0);
                    data.insertRows(data.length, [fath, value, '']);
                    chart.draw(data, {allowHtml:true});


                }
            }

            var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));

            google.visualization.events.addListener(chart, 'select', blah);


            function addPar() {
                var selectedItem = chart.getSelection()[0];
                var value = 'Alice';
                value = data.getValue(selectedItem.row, 0);
                data.removeRow(data.length-1);
                var x = document.getElementById("fname") +'';
                data.addRow([x, value, '']);

                chart.draw(data, {allowHtml:true});
            }



            chart.draw(data, {allowHtml:true});

        }


        $(document).ready(function () {
            $("#button").click(function () {
                $("#addOption").slideToggle('slow', function() {
                    //animation complete
                });
            });
            $("#addOption").click(function() {
                $("#addOption").html($("#newInput").html());
                });

        });
    </script>
    </div>


<?php include("bottom.html"); ?>