<?php include("top.html");
/*
* This tree structure is built from the "First family chart" category on the primary how to page.
*/
    /*
    $members = file("profiles.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach($members as $info) {
        $info = explode(",", $info);

        if ($_POST['email'] !== null && $_POST['email'] ===  $info[2]) {
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

    <script type='text/javascript'>//<![CDATA[
        $(window).load(function () {
            var maximumId = 12;
            var options = new primitives.famdiagram.Config();

            var items = [
                { id: 1, parents: [2,4], title: "Baby", label: "Baby", description: "1, root child", image: "demo/images/photos/t.png" },
                { id: 2, parents: [6,8], spouses: [4], title: "Mother", label: "Mother", description: "2, Mother",image: "demo/images/photos/m.png" },
                { id: 4, parents: [10,12], spouses: [2], title: "Father", label: "Father", description: "4, Father", image: "demo/images/photos/b.png" },
                { id: 6, spouse: [8], title: "pFather", label: "pFather", description: "6, pFather", image: "demo/images/photos/b.png" },
                { id: 8, spouse: [6], title: "pMother", label: "pMother", description: "8, pMother", image: "demo/images/photos/b.png" },
                { id: 10, spouse: [12], title: "mFather", label: "mFather", description: "10, mmFather", image: "demo/images/photos/b.png" },
                { id: 12, spouse: [10], title: "mMother", label: "mMother", description: "12, mMother", image: "demo/images/photos/b.png" }
            ];
            options.items = items;
            options.cursorItem = 2;
            options.linesWidth = 1;
            options.linesColor = "black";
            options.normalLevelShift = 20;
            options.dotLevelShift = 20;
            options.lineLevelShift = 20;
            options.normalItemsInterval = 10;
            options.dotItemsInterval = 10;
            options.lineItemsInterval = 10;

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
                        var newItem1 = new primitives.orgdiagram.ItemConfig({
                            id: data.context.id,
                            spouse: data.context.id-2,
                            parents: [data.context.id+2,data.context.id+2],
                            title: "New Title",
                            description: "New Description",
                            image: "demo/images/photos/z.png"
                        });


                        var newItem2 = new primitives.orgdiagram.ItemConfig({
                            id: maximumId+2,
                            spouse: data.context.id+4,
                            title: "New Title",
                            description: "New Description",
                            image: "demo/images/photos/z.png"
                        });
                        var newItem3 = new primitives.orgdiagram.ItemConfig({
                            id: maximumId+4,
                            spouse: data.context.id+2,
                            title: "New Title",
                            description: "New Description",
                            image: "demo/images/photos/z.png"
                        });



                        /* add it to items collection and put it back to chart, actually it is the same reference*/
                        items.push(newItem1);
                        jQuery("#basicdiagram").orgDiagram({
                            items: items,
                            cursorItem: newItem1.id
                        });


                        /* add it to items collection and put it back to chart, actually it is the same reference*/


                        items.push(newItem2);
                        jQuery("#basicdiagram").orgDiagram({
                            items: items,
                            cursorItem: newItem2.id
                        });


                        /* add it to items collection and put it back to chart, actually it is the same reference*/

                        items.push(newItem3);
                        jQuery("#basicdiagram").orgDiagram({
                            items: items,
                            cursorItem: newItem3.id
                        });


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

                        /* updating chart options does not fire its referesh, so it should be call explicitly */
                        jQuery("#basicdiagram").orgDiagram("update", /*Refresh: use fast refresh to update chart*/ primitives.orgdiagram.UpdateMode.Refresh);





                        break;
                }
            };

                $("#basicdiagram").famDiagram(options);
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