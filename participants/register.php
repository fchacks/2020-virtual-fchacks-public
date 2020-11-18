<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (md5($_POST["verification"]) == "a084780ee518ffc5c7a78af56b36b120") {

        // Validate username
        if (empty(trim($_POST["username"]))) {
            $username_err = "Please enter a username.";
        } else {
            $sql = "SELECT id FROM users WHERE username = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                // Set parameters
                $param_username = trim($_POST["username"]);

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    /* store result */
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $username_err = "This username is already taken.";
                    } else {
                        $username = trim($_POST["username"]);
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

        // if (file_exists("logindata/" . trim($_POST["username"]))) {
        //     $username_err = "Username taken.";
        // }

        // Validate password
        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter a password.";
        } elseif (strlen(trim($_POST["password"])) < 6) {
            $password_err = "Password must have atleast 6 characters.";
        } else {
            $password = trim($_POST["password"]);
        }

        // Validate confirm password
        if (empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "Please confirm password.";
        } else {
            $confirm_password = trim($_POST["confirm_password"]);
            if (empty($password_err) && ($password != $confirm_password)) {
                $confirm_password_err = "Password did not match.";
            }
        }
        $username = trim($_POST["username"]);
        $school = trim($_POST["school"]);
        $grade = trim($_POST["grade"]);
        $location = trim($_POST["location"]);
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);

        if (strlen($school) < 1 || strlen($grade) < 1 || strlen($location) < 1 || strlen($name) < 1 || strlen($email) < 1) {
            $gen_err = "Please complete all information";
        }

        // echo "RESP: ".$_POST["g-recaptcha-response"];

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => 'XXXXXXXXXXXX',
            'response' => $_POST["g-recaptcha-response"]
        );
        $options = array(
            'http' => array(
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captcha_success = json_decode($verify);

        if ($captcha_success->success == false) {
            // echo "<p style='color:red;'>Failed: You are a bot.</p>";
            $gen_err .= "<br>Failed: You are a bot.";
        } else if ($captcha_success->success == true) {
            // echo "<p>You are not not a bot!</p>";
        }

        // Check input errors before inserting in database
        if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($gen_err)) {
            // $myfile = fopen('logindata/'. $_POST['username'], "w");
            // $txt = md5(trim($_POST['password']));
            // fwrite($myfile, $txt);
            // fclose($myfile);


            // Prepare an insert statement
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

                // Set parameters
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Redirect to login page
                    // exec("cp -pr users/template users/" . $username);\



                    $myfile = fopen('logindata/' . $_POST['username'] . '.data.txt', "w");
                    $txt = "Name: " . $name . "\n" . "Email: " . $email . "\n" . "School: " . $school . "\n" . "Location: " . $location . "\n" . "Graduating Year: " . $grade;
                    fwrite($myfile, $txt);
                    fclose($myfile);

                    // Create linux login
                    exec("cp -pr users/template users/" . trim($_POST["username"]));

                    // exec("mkdir /var/www/fchacks/participants/users/".trim($_POST["username"]),"/home/");
                    // exec("sudo -S useradd -d /var/www/fchacks/participants/users/" . trim($_POST["username"]) . "/home -m -s /bin/bash " . trim($_POST["username"]));
                    // exec("echo '" . trim($_POST["username"]) . ":" . trim($_POST["password"]) . "' | sudo -S chpasswd");

                    header("location: login.php");




                    // header("location: login.php");
                } else {
                    echo "Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

        // Close connection
        mysqli_close($link);

    } else {
        echo "<br><b style='color:red'>Incorrect code</b><br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 350px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h2>Sign Up - Participants</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username (no spaces or special characters e.g. %,$,#)</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
            </div>

            <div class="form-group">
                <label>School</label>
                <input type="text" name="school" class="form-control" value="<?php echo $school; ?>">
            </div>

            <div class="form-group">
                <label>Graduating Year</label>
                <input type="number" name="grade" class="form-control" value="<?php echo $grade; ?>">
            </div>

            <div class="form-group">
                <label>Location (City, State/Province/Region, Country)</label>
                <input type="text" name="location" class="form-control" value="<?php echo $location; ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
            </div>
            <div class="form-group ">
                <label>Verification Code</label>
                <input type="password" name="verification" class="form-control" value="">
                <span class="help-block"></span>
            </div>
            <span class="help-block" style="color:red"><?php echo $gen_err; ?></span>

            <div class="g-recaptcha" data-sitekey="6Le8yK4ZAAAAAJkBLDKS-S1VkyWj3RG7vtLPm-PA"></div>


            <div class="form-group">
                <input type="submit" class="btn btn-danger" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>

            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</body>

</html>
