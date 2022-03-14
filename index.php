<!DOCTYPE html>
<html>

<head>
    <style>
        .error {
            color: #FF0001;
        }
    </style>
    <link rel="stylesheet" href="st.css">

</head>

<body>

    <?php
    // define variables to empty values  
    $fnameErr = $lnameErr = $emailErr = $mobilenoErr = $genderErr = $websiteErr  = $dateErr = "";
    $fname = $lname = $email = $mobileno = $gender = $website  = $date = "";

    //Input fields validation  
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //String Validation  
        if (empty($_POST["fname"])) {
            $fnameErr = "Name is required";
        } else {
            $fname = input_data($_POST["fname"]);
            // check if name only contains letters and whitespace  
            if (!preg_match("/^[a-zA-Z ]*$/", $fname)) {
                $fnameErr = "Only alphabets and white space are allowed";
            }
        }
        if (empty($_POST["lname"])) {
            $lnameErr = "Name is required";
        } else {
            $lname = input_data($_POST["lname"]);
            // check if name only contains letters and whitespace  
            if (!preg_match("/^[a-zA-Z ]*$/", $lname)) {
                $lnameErr = "Only alphabets and white space are allowed";
            }
        }

        //Email Validation   
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = input_data($_POST["email"]);
            // check that the e-mail address is well-formed  
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        //Number Validation  
        if (empty($_POST["mobileno"])) {
            $mobilenoErr = "Mobile no is required";
        } else {
            $mobileno = input_data($_POST["mobileno"]);
            // check if mobile no is well-formed  
            if (!preg_match("/^[0-9]*$/", $mobileno)) {
                $mobilenoErr = "Only numeric value is allowed.";
            }
            //check mobile no length should not be less and greator than 10  
            if (strlen($mobileno) != 10) {
                $mobilenoErr = "Mobile no must contain 10 digits.";
            }
        }

        //pass Validation      
        $password = $_POST['website'];

        $number = preg_match('@[0-9]@', $password);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
            $websiteErr = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
        }

        // dob validation
        if (empty($_POST["date"])) {
            $dateErr = "DOB is required";
        }


        //Empty Field Validation  
        if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
        } else {
            $gender = input_data($_POST["gender"]);
        }

        
    }
    function input_data($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <h2 align="center" id="head">Student Registration Form</h2>
    <br><br>
    <div class="container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h4 align="right" class="error">* required field </h4>
            First Name:
            <input type="text" name="fname">
            <span class="error">* <?php echo $fnameErr; ?> </span>
            <br><br>
            Last Name:
            <input type="text" name="lname">
            <span class="error">* <?php echo $lnameErr; ?> </span>
            <br><br>
            E-mail:
            <input type="text" name="email">
            <span class="error">* <?php echo $emailErr; ?> </span>
            <br><br>
            Mobile No:
            <input type="text" name="mobileno">
            <span class="error">* <?php echo $mobilenoErr; ?> </span>
            <br><br>
            Password:
            <input type="password" name="website">
            <span class="error">*<?php echo $websiteErr; ?> </span>
            <br><br>
            Date of Birth:
            <input type="date" name="date">
            <span class="error">*<?php echo $dateErr; ?> </span>
            <br><br>
            Gender:
            <input type="radio" name="gender" value="male"> Male
            <input type="radio" name="gender" value="female"> Female
            <input type="radio" name="gender" value="other"> Other
            <span class="error">* <?php echo $genderErr; ?> </span>
            <br><br>
           
            <center><input class="button" type="submit" name="submit" value="Submit"></center>
            <br><br>
        </form>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        if ($fnameErr == "" && $lnameErr == "" && $emailErr == "" && $mobilenoErr == "" && $genderErr == "" && $websiteErr  == "" && $dateErr == "") {
            echo "<h3 align=center color = #FF0001> <b>You have sucessfully registered.</b> </h3>";
            echo "<h4 align=center>Your Input</h4>";
            echo " <h5 align=center> First Name :".$fname."</h3>";
            echo" <h5 align=center>Last Name :" .$lname."</h3>";
            
            echo" <h5 align=center>Email :" .$email."</h3>";
         
            echo" <h5 align=center>Mobile Number :" .$mobileno."</h3>";
           
            echo " <h5 align=center>Gender :".$gender."</h3>";
        
           
       
        } else {
            echo "<h3 align=center > <b>You didn't filled up the form correctly.</b> </h3>";
        }
    }
    ?>
</body>

</html>