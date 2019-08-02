<?php
require_once "config.php";

$username = $password = $confirm_password = $email = $firstName = $lastName = "";
$usernameError = $passwordError = $confirmPasswordError = $emailError = $firstNameError = $lastNameError = "";
 
// Processing submitted form data.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $usernameError = "Please enter a username.";
    } else {
        $sql = "SELECT id FROM user WHERE username = ?";
        if ($stmt = mysqli_prepare($connection, $sql)) {
            // Bind variables to the prepared statement as parameters.
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            // Set parameters.
            $param_username = trim($_POST["username"]);
            // Attempt to execute the prepared statement.
            if(mysqli_stmt_execute($stmt)){
                // Store Result.
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $usernameError = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        unset($sql);
        mysqli_stmt_close($stmt);
        unset($stmt);
    }
    
    // Validate password
    if (empty(trim($_POST["password"]))) {
        $passwordError = "Please enter a password.";     
    } else if (strlen(trim($_POST["password"])) < 6) {
        $passwordError = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))){
        $confirmPasswordError = "Please confirm password.";     
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($passwordError) && ($password != $confirm_password)){
            $confirmPasswordError = "Password did not match.";
        }
    }

    if (empty(trim($_POST['email']))) {
        $emailError = 'Please enter your email.';
    } else {
        $sql = "SELECT id FROM user WHERE email = ?";

        if ($stmt = mysqli_prepare($connection, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            $email = trim($_POST["email"]);
            
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $emailError = "This email is already taken.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }
        unset($sql);
        mysqli_stmt_close($stmt);
        unset($stmt);
    }

    if (empty(trim($_POST['firstName']))) {
        $firstNameError = 'Please enter your first name.';
    } else {
        $firstName = trim($_POST["firstName"]);
    }

    if (empty(trim($_POST['lastName']))) {
        $lastNameError = 'Please enter your last name.';
    } else {
        $lastName = trim($_POST["lastName"]);
    }
    
    // Check input errors before inserting in database
    if (empty($usernameError) && empty($passwordError) && empty($confirmPasswordError) && empty($emailError) && empty($firstNameError) && empty($lastNameError) ){
        
        // Prepare an insert statement
        $sql = "INSERT INTO user (username, password, email, firstName, lastName) VALUES (?, ?, ?, ?, ?)";
         
        if ($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $email, $firstName, $lastName);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: login.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
    // Close connection.
    mysqli_close($connection);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel='stylesheet' href='assets/css/style.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-0c38nfCMzF8w8DBI+9nTWzApOpr1z0WuyswL4y6x/2ZTtmj/Ki5TedKeUcFusC/k" crossorigin="anonymous">
</head>

<body class='login'>
<div class='container-fluid h-100'>
    <div class='row d-flex align-items-center justify-content-center h-100'>
        <div class='col-sm-12 col-md-8'>
            <div class='card p-3'>
                <h2 class='text-center'>Sign Up</h2>
                <hr>
                <div class='row'>
                    <div class='col-sm-12 col-md-6'>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group <?php echo (!empty($usernameError)) ? 'has-error' : ''; ?>">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>"  placeholder='Username'>
                                <span class="help-block"><?php echo $usernameError; ?></span>
                            </div>    
                            <div class="form-group <?php echo (!empty($passwordError)) ? 'has-error' : ''; ?>">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" placeholder='Password'>
                                <span class="help-block"><?php echo $passwordError; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($confirmPasswordError)) ? 'has-error' : ''; ?>">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" placeholder='Confirmation'>
                                <span class="help-block"><?php echo $confirmPasswordError; ?></span>
                            </div>
                    </div>
                    <div class='col-sm-12 col-md-6'>
                            <div class="form-group <?php echo (!empty($emailError)) ? 'has-error' : ''; ?>">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" placeholder='example@email.com'>
                                <span class="help-block"><?php echo $emailError; ?></span>
                            </div>    
                            <div class="form-group <?php echo (!empty($firstNameError)) ? 'has-error' : ''; ?>">
                                <label>First Name</label>
                                <input type="text" name="firstName" class="form-control" value="<?php echo $firstName; ?>" placeholder='John'>
                                <span class="help-block"><?php echo $firstNameError; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($lastNameError)) ? 'has-error' : ''; ?>">
                                <label>Last Name</label>
                                <input type="text" name="lastName" class="form-control" value="<?php echo $lastName; ?>" placeholder='Johnson'>
                                <span class="help-block"><?php echo $lastNameError; ?></span>
                            </div>
                    </div>
                    <div class='col-12 mt-0'>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success w-100 m-0 rounded-0 shadow">Submit <i class="fas fa-sign-in-alt"></i></button>
                                <!--<input type="reset" class="btn btn-info w-100" value="Reset">-->
                            </div>
                            <p class='m-0'>Already have an account? <a href="login.php">Login here</a>.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>