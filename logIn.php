<?php include("top.html"); ?>

	<div class="container">
        <form id ="myForm" name="myForm" action="profilePage4.php" method="POST" class="basic-grey">
            <h1>Log In</h1>
            <label id="dude">
                <span>Email:</span>
                <input type="text" name="email" placeholder="Enter Email" />
            </label>
            <label>
                <span>Password:</span>
                <input type="password" name="password" placeholder="Enter Password" /> 
            </label>
            <label>
                <input class="button" type="submit" value="View Profile">
            </label>
            <br>
            <span id="error"></span>
        </form>

        <script type="text/javascript">
                
                $('#myForm').on('submit', function() {
                    var check = false;
                    
                    var email = $('input[name=email]').val();
                    var password = $('input[name=password]').val();

                    //check that email is not blank
                    if (!email) {
                        $('#error').html("*Please Enter Email");
                        return false;
                    }

                    //check that its a YU email
                    var reg = /^[a-z.]+@(mail\.)?yu\.edu$/;
                    if (!reg.test(email)) {
                        $('#error').html("*Email Must Contain yu.edu or mail.yu.edu");
                        return false;
                    }

                    //check that password is not blank
                    if (!password) {
                        $('#error').html("*Please Enter Password");
                        return false;
                    }

                    // without this, the below callback gets executed *after* this function returns
                    $.ajaxSetup({
                        async: false
                    });
                    // read files to string
                    $.get("profiles.txt", function(txtFile) {  // 
                        //split file string to array of lines
                        var lines = txtFile.split('\n');

                        for (var i = 0; i < lines.length; i++) {

                            //split each line into values
                            lines[i] = lines[i].split(',');

                            // Check email
                            if (lines[i][2] === email) {
                                //check password
                                if ($.trim(lines[i][3]) === $.trim(password)) {
                                    check = true;
                                    $('#error').html("*Password Is A Match");
                                    break;
                                }
                                $('#error').html("*Password Does Not Match");
                            }
                        }
                    });

                    return check;
                });

        </script>
    </div>

<?php include("bottom.html"); ?>