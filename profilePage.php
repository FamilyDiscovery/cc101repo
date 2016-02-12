<?php include("top.html");
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 4/17/2015
 * Time: 2:57 AM
 */

    /*
     * Alternative method of storing data using txt files
     * -----------------------------------------------------------
     *
     *
    // check email from txt file
    $members = file("members.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach($members as $info) {
        $info = explode(",", $info);
        if ($_POST['email'] ===  $info[2]) {
            $members = $info;
            break;
        }
        else {
        }
    }
    // get info from txt file for user
    $nodes = [];
    $profile = file("profiles/". "$members[4]", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)  ;
    for($i = 0; $i < count($profile); $i++) {
        $profile[$i] = explode(",", $profile[$i]);
        if($profile[$i][1] != null) {
            //echo "True";
            array_push($nodes, $profile[$i]);
        }
    }
    */

    // open connection to the database
    $db = new PDO("mysql:dbname=profiles;host=localhost","root","binnil");

    // get info from database and display in chart
    $rows = $db->query("SELECT first_name,last_name,father_id,mother_id,birth_town FROM members WHERE email LIKE \"" . $_POST['email'] . "\" limit 1");
    $data= [];
    $user_last_name ="";
    $user_birth_town = "";
    $user_given_name="";
    $father_location = "";
    $father_surname = "";
    foreach($rows as $row) {
        $user_given_name = $row["first_name"];
        $user_last_name = $row["last_name"];
        $user_birth_town = $row["birth_town"];
        $query_name = $user_given_name . $user_last_name;
        $father_id = $row["father_id"];
        $mother_id = $row["mother_id"];

        //get info on father
        //$father_surname = "";
        //$father_location = "";
        $query_fam_members_father = "SELECT last_name,birth_town FROM fam_members WHERE id = " . $father_id;
        $father_info = $db->query($query_fam_members_father);
        foreach ($father_info as $f_info) {
            $father_surname = $f_info["last_name"];
            $father_location = $f_info["birth_town"];
        }
        // get info on mather
        $mother_surname = "";
        $mother_location = "";
        $query_fam_members_mother = "SELECT last_name,birth_town FROM fam_members WHERE id = " . $mother_id;
        $mother_info = $db->query($query_fam_members_mother);
        foreach ($mother_info as $m_info) {
            $mother_surname = $m_info["last_name"];
            $mother_location = $m_info["birth_town"];

        }
    }

?>

    <br/><br/>
    <!--<div class="container">-->
        <div class="row2">
            <a class="button" href="index.php">Log Out</a>
            <a class="button" href="matches.php">Check Matches</a>
        </div>

    <table style="margin: auto; width: 65%;" dir="ltr" width="500" border="1" summary="purpose/structure for speech output">
        <caption>
            <h2>Ancestral chart for <?=strtoupper($user_given_name) . " " . strtoupper($user_last_name) ?></h2>
        </caption>
        <!--
        <thead>
            <tr>
                <th id="root" scope="col" colspan="4">Stuff to say!!</th>
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
            <?php
                for ($i = 0; $i < 4; $i++) {
            ?>
            <td><p id="node<?= $i ?>"><a class="button" href="#">Add Grandparent</a></p>
                <div id="new_node<?= $i ?>" style="display: none;">
                    <p class="mssg" style="display: none;">Still in Progress</p>
                    <form id="myForm<?= $i ?>" name="myForm<?= $i ?>" class="basic-grey" style="width:80%;" action="profilePage.php" onsubmit="return passWord(<?= $i ?>)" method="POST" >

                        <label hidden>
                            <input type="hidden" name="email" value="<?= $_POST['email'] ?>"><br>
                        </label>

                        <label hidden>
                            <input id="gender" type="hidden" name="gender" value="<?= $i ?>"><br>
                        </label>

                        <label>
                            <span>Surname:</span><br/>
                            <input id="surname" type="text" name="surname" placeholder="Grandparent's Birth Surname"><br>
                        </label>
                        <label>
                            <span>City of Birth:</span>
                            <input id="autocomplete<?= $i ?>" class="autocomplete<?= $i ?>" type="text" name="city_born" placeholder="Born In Which City" />
                        </label>
                        <label>
                            <input id="button" class="button" type="submit" value="Submit" ><br/>
                        </label>
                        <br/>
                        <span id="error<?= $i ?>"></span>
                    </form>
                </div>
            </td>
            <?php
            }
            ?>
        </tr>
        <tr>
            <td colspan="2">
                <!-- father -->
                <?= strtoupper($father_surname) ?><br/>
                <?= $father_location ?><br/>
                <p><a class="button" href="#">Edit</a></p>
            </td>
            <td colspan="2">
                <!-- mother -->
                <?= strtoupper($mother_surname) ?><br/>
                <?= $mother_location ?>
                <p><a class="button" href="#">Edit</a></p>
            </td>
        </tr>
        <tr>
            <td id="root" scope="col" colspan="4">
                <!-- child/root -->
                <?= strtoupper($user_given_name) . " " . strtoupper($user_last_name) ?><br/>
                <?= $user_birth_town  ?>
                <p><a class="button" href="#">Edit</a></p>
            </td>
        </tr>
        <tr>
            <td id="lastCell" scope="col" colspan="4">
                <h2> Client example </h2>
                <h3>Output: </h3>
                <div id="output">this element will be accessed by jquery and this text replaced</div>
            </td>
        </tr
        </tbody>
    </table>

    <br/><br/><br/><br/><br/><br/>


    <!--<script type="text/javascript" src="prototype/src/prototype/prototype.js"></script>-->

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
    <script src="googleAutocomplete.js"></script>

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

        /*
        $("form").on('submit', function() {
            $( this ).slideUp();
            $(" .mssg " ).delay( 2000 ).show();
            //return false;
        });
        */

        function passWord(num) {
            var myForm = "myForm" + num;
            var error = "error" + num;
            var err = document.getElementById(error);
            var x = document.forms[myForm]["surname"].value;
            if (!x) {
                err.innerHTML = "*Must Include Your Surname";
                return false;
            }
            x = document.forms[myForm]["city_born"].value;
            if (!x) {
                err.innerHTML = "*Must Include city of residence ";
                return false;
            }
            //showUser(<?= $i ?>,<?= $_POST['email'] ?>);
            return true;
        }


        /*
        // ATTEMPT #1
        //ajax to update database
        $("#button").click(function() {
            window.alert("ajax was clicked");
            //in here we can do the ajax after validating the field isn't empty.
            //if($("#surname").val()!="") {
                $.ajax({
                    url: "addFam.php",
                    type: "POST",
                    async: true,
                    data: { surname:$("#surname").val(), gender:$("#gender").val(), cityborn:$("#autocomplete").val()}, //your form data to post goes here as a json object
                    dataType: "html"


                });
            //}
        //else {
                //notify the user they need to enter data
        //        $.("error0").html("there was an error");
            //}
        });

        // ATTEMPT #2
        // ajax submit info to mysql db
        function showUser(int,email) {
            window.alert("showuser function was reached");
            if (int == "") {
                document.getElementById("txtHint").innerHTML = "";
                //return;
            } else {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                    }
                };
                var filename = "addFam.php?gender="+int+"?email="+email;
                xmlhttp.open("POST", filename, true);
                xmlhttp.send();
            }
        }

        */

        //
        //

        /*
        window.onload = function() {
            //document.getElementById("load").onclick = displayTranscriptClickAsync;
        };


        * ATTEMPT #3
        * an asynchronous ajax call to load data from txt file
        */

        /*
        function loadClick() {
            // remove button
            var el = document.getElementById('almostLastCell');
            el.nextElementSibling.remove();

            // read from txt file
            var text = downloadTextAsync("members.txt", ajaxCompleted);
            var lines = text.split("\n");

            // write from txt file and print
            var ul = document.createElement('ul');
            for (var i = 0; i < lines.length; i++) {
                    if(lines[i].length > 0) {
                        var li = document.createElement('li');
                        li.innerHTML = lines[i];
                        ul.appendChild(li);
                    }
            }
            document.getElementById("output").appendChild(ul);
        }

         // takes the name of a txt file and returns the contents
         function downloadTextAsync(url, fn) {
         var ajax = new XMLHttpRequest();
         ajax.onreadystatechange = function() {
         if (ajax.readyState == 4) {
         if (ajax.status == 200) {
         fn(ajax);
         } else {
         alert("Error fetching text of " + url + ":\n"
         + ajax.status + " " + ajax.statusText);

         }
         }
         };
         ajax.open("GET",url,false);
         ajax.send(null);

         // warn user if there was an Ajax error
         if (ajax.status != 200) {
         alert("Error fetching text of " + url + ":\n" + ajax.status + " " + ajax.statusText);
         }
         return ajax.responseText;
         }

        */

        /*
        * ATTEMPT #4
        *
         */

        /*

        //function displayTranscriptClickAsync() {
            $("#load").click( function(){
            window.alert("first method reached");
            new Ajax.Request(
                "members.txt",
                {
                    method: 'get',
                    onSuccess: ajaxTempSex,
                    onFailure: ajaxTemp,
                    onException: ajaxTemp
                }
            );
            window.alert("bottom of first section method reached");
        });

        function ajaxTempSex(){
            alert('Something went right!...');
        }

        function ajaxTemp(){
            alert('Something went wrong...');
        }

        function ajaxFailed(ajax,exception) {
            var msg = "Error making Ajax request: \n\n";
            if (exception) {
                msg += "Exception: " + exception.message;
            } else {
                msg += "Server status:\n" + ajax.status + " " + ajax.statusText +
                        "\n\nServer response text:\n" + ajax.responseText;
            }
            alert(msg);
        }

        function ajaxCompleted(ajax) {
            alert("second method reached");
            var lines = ajax.responseText.split("\n");
            window.alert(ajax);
            window.alert(lines);
            //convert the lines of text into DOM items in an unordered list
            var ul = document.createElement("ul");
            for (var i = 0; i < lines.length; i++) {
                var li = document.createElement("li");
                li.innerHTML = lines[i];
                ul.appendChild(li);
            }
            window.alert(ul);
            // place the list onto the page in the output div
            $("output").appendChild(ul);

            }



         */

        /*
        // ATTEMPT #5
           $(document).ready(function(){
                $("#bttn").click(function(){

                      var name=$("#surname").val();
                      var message=$("#autocomplete").val();

                      $.ajax({
                          method: "POST",
                          url: "addFam.php",
                          data: { name: name, location: message}
                          username: root,
                          password: binnil
                      })
                });
           });
           */


        // ATTEMPT #6
        $(function ()
        {
            //-----------------------------------------------------------------------
            // 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
            //-----------------------------------------------------------------------
            $.ajax({
                url: 'addFam.php',                  //the script to call to get data
                data: "",                        //you can insert url argumnets here to pass to api.php
                                                 //for example "id=5&parent=6"
                dataType: 'json',                //data format
                success: function(data)          //on recieve of reply
                {
                    var id = data[0];              //get id
                    var vname = data[1];           //get name
                    //--------------------------------------------------------------------
                    // 3) Update html content
                    //--------------------------------------------------------------------
                    $('#output').html("<b>id: </b>"+id+"<b> name: </b>"+vname); //Set output element html
                    //recommend reading up on jquery selectors they are awesome
                    // http://api.jquery.com/category/selectors/
                }
            });
        });




    </script>

<?php include("bottom.html"); ?>