<?php include("../top.html");
/**
 * Created by PhpStorm.
 * User: Binny
 * Date: 7/30/2015
 * Time: 11:58 AM
 */

function error($msg) {
    ?>
    <html>
    <head>
        <script language="JavaScript">
            <!--
            alert("<?=$msg?>");
            history.back();
            //-->
        </script>
    </head>
    <body>
    </body>
    </html>
    <?
    exit;
}
?>