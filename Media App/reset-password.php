<?php
$title = 'Change Password';
require_once "config.php";
include_once('header.php');

$newPassword = $confirmPassword = $existingPassword = "";
$newPasswordError = $confirmPasswordError =  $existingPasswordError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["existingPassword"]))) {
        $existingPasswordError = "Please enter your password.";     
    } else {
        $existingPassword = trim($_POST["existingPassword"]);
    }

    $ID = $_SESSION['id'];

    $statement = "SELECT * FROM user WHERE id = ?";

    if ($pre = $connection->prepare($statement)) {
        $pre->bind_param('i', $id);
        $id = $ID;
        $pre->execute();
        $result = $pre->get_result();
        $rows = $result->fetch_assoc();

        $pre->close();
    }

    if (password_verify($existingPassword, $rows['password']) == true) {
        if (empty(trim($_POST["newPassword"]))) {
            $newPasswordError = "Please enter the new password.";     
        } else if (strlen(trim($_POST["newPassword"])) < 6) {
            $newPasswordError = "Password must have atleast 6 characters.";
        } else {
            $newPassword = trim($_POST["newPassword"]);
        }
        // Validate confirm password
        if (empty(trim($_POST["confimPassword"]))) {
            $confirmPasswordError = "Please confirm the password.";
        } else {
            $confirmPassword = trim($_POST["confimPassword"]);
            if(empty($newPasswordError) && ($newPassword != $confirmPassword)){
                $confirmPasswordError = "Password did not match.";
            }
        }
    
        // Check input errors before updating the database
        if (empty($newPasswordError) && empty($confirmPasswordError) && empty($existingPasswordError)) {
            // Prepare an update statement
            $sql = "UPDATE user SET password = ? WHERE id = ?";
            
            if ($stmt = mysqli_prepare($connection, $sql)) {
            
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
                
                // Set parameters
                $param_password = password_hash($newPassword, PASSWORD_DEFAULT);
                $param_id = $_SESSION["id"];
                
                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Password updated successfully. Destroy the session, and redirect to login page
                    header("location: user.php");
                    exit();
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                    header("location: user.php");
                    exit;
                }
                mysqli_stmt_close($stmt);
            }
        }
        // Close connection
        mysqli_close($connection);
        // flash for working.
    } else {
        $existingPasswordError = 'Existing password not correct.';
    }
}

?>
<div class='container-fluid h-100'>
    <div class='row justify-content-center align-items-center h-100'>
        <div class='col-sm-12 col-md-6 col-xl-4'>
            <div class='card p-2 shadow'>
                <h2 class='text-center'>Change Password</h2>
                <hr>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($existingPasswordError)) ? 'has-error' : ''; ?>">
                        <label>Existing Password</label>
                        <input type="password" name="existingPassword" class="form-control" placeholder='Enter your Password'>
                        <span class="help-block"><?php echo $existingPasswordError; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($newPasswordError)) ? 'has-error' : ''; ?>">
                        <label>New Password</label>
                        <input type="password" name="newPassword" class="form-control" value="<?php echo $newPassword; ?>">
                        <span class="help-block"><?php echo $newPasswordError; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($confirmPasswordError)) ? 'has-error' : ''; ?>">
                        <label>Confirm Password</label>
                        <input type="password" name="confimPassword" class="form-control">
                        <span class="help-block"><?php echo $confirmPasswordError; ?></span>
                    </div>
                    <div class="form-group mb-0">
                        <input type="submit" class="btn btn-primary w-100 mb-1" value="Submit">
                        <input action="action" type="button" value="Cancel" class='btn btn-info w-100' onclick="window.history.go(-1); return false;">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once('footer.php'); ?>