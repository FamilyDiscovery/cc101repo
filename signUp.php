<?php include("top.html"); ?>

<div class="container">

    <form name="myForm" action="newSignUp.php" onsubmit="return passWord()" method="POST" class="basic-grey">
        <h1> New User Signup </h1>
        <label>
            <span>First Name:</span>
            <input id="name" type="text" name="name" placeholder="Your First Name" />
        </label>
        <label>
            <span>Last Name:</span>
            <input id="surname" type="text" name="surname" placeholder="Your Surname" />
        </label>
        <label>
            <span>Email:</span>
            <input id="email" type="text" name="email" placeholder="Valid Email Address"/>
        </label>
        <label>
            <span>Mothers Maiden Name:</span>
            <input id="maiden_name" type="text" name="maiden_name" placeholder="Mother's Original Last Name" />
        </label>
        <label>
            <span>New Password:</span>
            <input id="password" type="password" name="password" placeholder="Input Valid Password" />
        </label>
        <label>
            <input type="submit" class="button" value="Submit" />
        </label>
        <br>
        <span id="error">
            </span>
    </form>

    <script type="text/javascript">
        function passWord() {
            

            var err = document.getElementById("error");
            var reg = /^[a-z.]+@(mail\.)?yu\.edu$/;

            var x = document.forms["myForm"]["name"].value;
            if (!x) {  //x == null || x == ""
                err.innerHTML = "*Must Include First Name";
                return false;
            }
            x = document.forms["myForm"]["surname"].value;
            if (!x) {
                err.innerHTML = "*Must Include Your Surname";
                return false;
            }
            x = document.forms["myForm"]["email"].value;
            if (x.length == 0) {
                err.innerHTML = "*Please Enter A Valid Email";
                return false;
            }
            if (!reg.test(document.forms["myForm"]["email"].value.toLowerCase())) {
                err.innerHTML = "*Email Must Contain yu.edu or mail.yu.edu";
                return false;
            }
            x = document.forms["myForm"]["maiden_name"].value;
            if (!x) {  
                err.innerHTML = "*Must Include Your Mothers Surname";
                return false;
            }
            x = document.forms["myForm"]["password"].value;
            if (x.length < 6) { 
                err.innerHTML = "*Password Must Be At Least 6 Characters";
                return false;
            }
        return true;
        }
    </script>
</div>

<?php include("bottom.html"); ?>