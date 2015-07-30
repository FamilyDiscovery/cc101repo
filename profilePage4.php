<?php include("top.html");
/*
 * This tree structure is built from the "First family chart" category on the primary how to page.
 */

$members = file("profiles.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach($members as $info) {
    $info = explode(",", $info);
    if ($_POST['email'] !== null && $_POST['email'] ===  $info[2]) {
        $members = $info;

    }
    }
?>
<div id="basicdiagram">
</div>

<script type="text/javascript" src="primitives/primitives.min.js"></script>
<link href="primitives/primitives.latest.css" media="screen" rel="stylesheet" type="text/css" />

<script type='text/javascript'>//<![CDATA[
    $(window).load(function () {
        var options = new primitives.famdiagram.Config();

        var items = [
            { id: 1, parents: [2,4], title: "Thomas Williams", label: "Thomas Williams", description: "1, 1st husband", image: "demo/images/photos/t.png" },
            { id: 2, parents: [6,8], spouses: [4], title: "Mary Spencer", label: "Mary Spencer", description: "2, The Mary",image: "demo/images/photos/m.png" },
            { id: 4, parents: [10,12], spouses: [2], title: "Brad Williams", label: "Brad Williams", description: "4, 1st son", image: "demo/images/photos/b.png" },
            { id: 6, spouse: [8], title: "Brad Williams", label: "Brad Williams", description: "4, 1st son", image: "demo/images/photos/b.png" },
            { id: 8, spouse: [6], title: "Brad Williams", label: "Brad Williams", description: "4, 1st son", image: "demo/images/photos/b.png" },
            { id: 10, spouse: [12], title: "Brad Williams", label: "Brad Williams", description: "4, 1st son", image: "demo/images/photos/b.png" },
            { id: 12, spouse: [10], title: "Brad Williams", label: "Brad Williams", description: "4, 1st son", image: "demo/images/photos/b.png" },
        ];
        options.items = items;
        options.cursorItem = 2;
        options.linesWidth = 1;
        options.linesColor = "black";
        options.hasSelectorCheckbox = primitives.common.Enabled.False;
        options.normalLevelShift = 20;
        options.dotLevelShift = 20;
        options.lineLevelShift = 20;
        options.normalItemsInterval = 10;
        options.dotItemsInterval = 10;
        options.lineItemsInterval = 10;

            $("#basicdiagram").famDiagram(options);
        });
    </script>
    </div>

<?php include("bottom.html"); ?>