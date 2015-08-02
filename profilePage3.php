<?php include("top.html");

$members = file("profiles.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$member = "user info";
foreach($members as $info) {
    $info = explode(",", $info);
    if ($_POST['email'] ===  $info[3]) {
        $member = $info;
    }
}
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

            <?php
                $profile = implode("",file("profiles/". "$member[8]", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES))  ;

             ?>

            var items = <?=$profile?>;


            var buttons = [];
            buttons.push(new primitives.orgdiagram.ButtonConfig("delete", "ui-icon-close", "Delete"));
            buttons.push(new primitives.orgdiagram.ButtonConfig("edit", "ui-icon-gear", "Edit"));
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
                    case "edit":




                        /*
                        b.dlgItemConfig.bpDlgItemConfig("option",{
                            cancel:function(){},update:function(){
                                var a=b.dlgItemConfig.bpDlgItemConfig("option","children"),c,d={},f;
                                e=0;for(c=a.length;e<c;e+=1)f=a[e],d[f.id]=!0;
                                i=[];e=0;for(c=b.options.items.length;
                                             e<c;e+=1)f=b.options.items[e],
                                d.hasOwnProperty(f.id)||i.push(f);
                                b.options.items=i.concat(a);b.orgDiagram.orgDiagram("option",{
                                    items:b.options.items});b.orgDiagram.orgDiagram("update",primitives.common.UpdateMode.Refresh);
                                b._trigger("onSave")},itemConfig:c.context,children:
                                b._getChildrenForParent(c.context)});b.dlgItemConfig.bpDlgItemConfig("open");break;


                        primitives.orgeditor.DlgConfig.prototype._createLayout=function(){
                            var a,c,b;
                            a='<p class="validateTips">All form fields are required.</p>' +
                                '<form><fieldset>';
                            for(c in this.enums)this.enums.hasOwnProperty(c)&&(b=this.enums[c],a+='<br/>' +
                                    '<label for="+c+">b.title+</label>' +
                                    '<select class="text ui-widget-content ui-corner-all" style="padding:2px; margin:5px;" name="+c+"></select>');
                                a=jQuery(a+'<br/><label for="labelWidth">Label width</label><input type="text" ' +
                                'name="labelWidth" class="text ui-widget-content ui-corner-all" /><br/>' +
                                '<label for="labelHeight">Label height</label><input type="text" name="labelHeight" ' +
                                'class="text ui-widget-content ui-corner-all" /><br/>' +
                                '<label for="itemTitleFirstFontColor">Title first font color</label>' +
                                '<input type="text" name="itemTitleFirstFontColor" class="text ui-widget-content ui-corner-all" /><br/>' +
                                '<label for="itemTitleSecondFontColor">Title second font color</label>' +
                                '<input type="text" name="itemTitleSecondFontColor" class="text ui-widget-content ui-corner-all" />' +
                                '</fieldset></form>').addClass(this.widgetEventPrefix);
                            this.element.append(a);
                            this.element.addClass("dialog-form");
                            this._createWidgets(this.element)};
                        primitives.orgeditor.DlgConfig.prototype._createWidgets=function() {
                            var a, c, b, d;
                            d = [];
                            this.tips = this.element.find(".validateTips");
                            this.labelWidth = this.element.find("[name=labelWidth]");
                            this.labelHeight = this.element.find("[name=labelHeight]");
                            this.itemTitleFirstFontColor = this.element.find("[name=itemTitleFirstFontColor]");
                            this.itemTitleSecondFontColor = this.element.find("[name=itemTitleSecondFontColor]");
                            for (c in primitives.common.Colors)primitives.common.Colors.hasOwnProperty(c) && d.push(c);
                            this.itemTitleFirstFontColor.autocomplete({source: d});
                        }





                        */



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

            jQuery("#basicdiagram").orgDiagram(options);
        });//]]>


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