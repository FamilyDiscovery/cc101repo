<?php include("top.html");
/**
 * Created by PhpStorm.
 * User: Binny
 * Date: 7/29/2015
 * Time: 3:28 PM
 */

/*
$members = file("profiles.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach($members as $info) {
    $info = explode(",", $info);
    if ($_POST['email'] ===  $info[2]) {
        $members = $info;
    }
}
*/
?>
    <div class="container">
        <div id="basicdiagram"></div>
    </div>

    <script type="text/javascript" src="primitives/primitives.min.js"></script>
    <link href="primitives/primitives.latest.css" media="screen" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="primitives/js/jquery/ui-lightness/jquery-ui-1.10.2.custom.css" />

    <script type="text/javascript">

        $(document).ready(function() {
            var maximumId = 3;
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
                })
            ];

            var buttons = [];
            buttons.push(new primitives.orgdiagram.ButtonConfig("delete", "ui-icon-close", "Delete"));
            buttons.push(new primitives.orgdiagram.ButtonConfig("properties", "ui-icon-gear", "Info"));
            buttons.push(new primitives.orgdiagram.ButtonConfig("add", "ui-icon-person", "Add"));

            options.items = items;
            options.cursorItem = 0;
            options.normalLevelShift = 20;
            options.dotLevelShift = 10;
            options.lineLevelShift = 10;
            options.normalItemsInterval = 10;
            options.dotItemsInterval = 10;
            options.lineItemsInterval = 6;
            options.buttons = buttons;
            options.hasButtons = primitives.common.Enabled.Auto;
            options.hasSelectorCheckbox = primitives.common.Enabled.True;
            options.leavesPlacementType = primitives.orgdiagram.ChildrenPlacementType.Matrix;
            options.onButtonClick = function (e, /*primitives.orgdiagram.EventArgs*/ data) {
                switch (data.name) {
                    case "delete":
                        if (/*parentItem: primitives.orgdiagram.ItemConfig*/data.parentItem == null) {
                            alert("You are trying to delete root item!");
                        }
                        else {
                            var items = jQuery("#basicdiagram").orgDiagram("option", "items");
                            var newItems = [];
                            /* collect all children of deleted items, we are going to delete them as well. */
                            var itemsToBeDeleted = getSubItemsForParent(items, /*context: primitives.orgdiagram.ItemConfig*/data.context);
                            /* add deleted item to that collection*/
                            itemsToBeDeleted[data.context.id] = true;

                            /* copy to newItems collection only remaining items */
                            for (var index = 0, len = items.length; index < len; index += 1) {
                                var item = items[index];
                                if (!itemsToBeDeleted.hasOwnProperty(item.id)) {
                                    newItems.push(item);
                                }
                            }
                            /* update items list in chart */
                            jQuery("#basicdiagram").orgDiagram({
                                items: newItems,
                                cursorItem: data.parentItem.id
                            });
                            jQuery("#basicdiagram").orgDiagram("update", /*Refresh: use fast refresh to update chart*/ primitives.orgdiagram.UpdateMode.Refresh);

                        }
                        break;
                    case "add":
                        /* get items collection */
                        var items = jQuery("#basicdiagram").orgDiagram("option", "items");
                        /* create new item */
                        var newItem = new primitives.orgdiagram.ItemConfig({
                            id: maximumId++,
                            parent: data.context.id,
                            title: "New Title",
                            description: "New Description",
                            image: "demo/images/photos/z.png"
                        });
                        /* add it to items collection and put it back to chart, actually it is the same reference*/
                        items.push(newItem);
                        jQuery("#basicdiagram").orgDiagram({
                            items: items,
                            cursorItem: newItem.id
                        });
                        /* updating chart options does not fire its referesh, so it should be call explicitly */
                        jQuery("#basicdiagram").orgDiagram("update", /*Refresh: use fast refresh to update chart*/ primitives.orgdiagram.UpdateMode.Refresh);
                        break;
                }
            };

            $("#basicdiagram").orgDiagram(options);
        });


        function getSubItemsForParent(items, parentItem) {
            var children = {},
                itemsById = {},
                index, len, item;
            for (index = 0, len = items.length; index < len; index += 1) {
                var item = items[index];
                if (children[item.parent] == null) {
                    children[item.parent] = [];
                }
                children[item.parent].push(item);
            }
            var newChildren = children[parentItem.id];
            var result = {};
            if (newChildren != null) {
                while (newChildren.length > 0) {
                    var tempChildren = [];
                    for (var index = 0; index < newChildren.length; index++) {
                        var item = newChildren[index];
                        result[item.id] = item;
                        if (children[item.id] != null) {
                            tempChildren = tempChildren.concat(children[item.id]);
                        }
                    }
                    newChildren = tempChildren;
                }
            }
            return result;
        };


    </script>


<?php include("bottom.html"); ?>