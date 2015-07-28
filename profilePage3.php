<?php include("top.html");

$members = file("profiles.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach($members as $info) {
    $info = explode(",", $info);
    if ($_POST['email'] ===  $info[2]) {
        $members = $info;
    }
}
?>

    <div id="basicdiagram">
    </div>

    <script type="text/javascript" src="primitives/primitives.min.js"></script>
    <link href="primitives/primitives.latest.css" media="screen" rel="stylesheet" type="text/css" />

    <script type="text/javascript">

        $(document).ready(function() {
            var options = new primitives.orgdiagram.Config();

            var items = [
                new primitives.orgdiagram.ItemConfig({
                    id: 0,
                    parent: null,
                    title: "Scott Aasrud",
                    description: "VP, Public Sector",
                    image: "user.jpg"
                }),
                new primitives.orgdiagram.ItemConfig({
                    id: 1,
                    parent: 0,
                    title: "Ted Lucas",
                    description: "VP, Human Resources",
                    image: "user.jpg"
                }),
                new primitives.orgdiagram.ItemConfig({
                    id: 2,
                    parent: 0,
                    title: "Joao Stuger",
                    description: "Business Solutions, US",
                    image: "user.jpg"
                }),
                new primitives.orgdiagram.ItemConfig({
                    id: 3,
                    parent: 1,
                    title: "Alice Example",
                    description: "An overused placeholder",
                    image: "user.jpg"
                }),
                new primitives.orgdiagram.ItemConfig({
                    id: 4,
                    parent: 1,
                    title: "Bob Example",
                    description: "An overused placeholder",
                    image: "user.jpg"
                }),
                new primitives.orgdiagram.ItemConfig({
                    id: 5,
                    parent: 2,
                    title: "Danny Poritz",
                    description: "Genius Extraordinaire",
                    image: "user.jpg"
                }),
                new primitives.orgdiagram.ItemConfig({
                    id: 5,
                    parent: 2,
                    title: "Binyamin 'Binny' Lewis",
                    description: "Dark Overlord",
                    image: "user.jpg"
                })
            ];

            options.items = items;
            options.cursorItem = 0;
            options.hasSelectorCheckbox = primitives.common.Enabled.True;

            $("#basicdiagram").orgDiagram(options);
        });
    </script>
    </div>


<?php include("bottom.html"); ?>