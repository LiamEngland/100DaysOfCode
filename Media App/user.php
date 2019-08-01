<?php
$title = 'Account Management';
include_once('header.php');

$ID = $_SESSION['id'];

$statement = "SELECT * FROM user WHERE id = ?";

if ($pre = $connection->prepare($statement)) {
    $pre->bind_param('i', $id); // Binds parameter as an integer.
    $id = $ID;
    $pre->execute();
    $result = $pre->get_result();
    $rows = $result->fetch_assoc();
}

$target_dir = "uploads/profile-picture/";
$userPath = $target_dir . $rows['actualFileName'];

?>

<div class='container-fluid mt-4'>
    <div class='row d-flex align-content-center justify-content-center h-100'>
        <div class='col-sm-12 col-md-8 col-xl-6'>
            <div class='card w-100 shadow'>
                <div class='card-header pb-0'>
                    <h1>Account Details</h1>
                    <hr>
                </div>
                <div class='card-body'>
                    <div class='row'>
                        <div class='col-sm-12 col-md-8 col-lg-9'>
                            <label class='text-muted edit'>Profile Image : </label>
                        </div>
                        <div class='col-sm-12 col-md-4 col-lg-3'>
                            <img src="<?= $userPath ?>" class='w-100 shadow'>
                                <form action="upload-avi.php" method="post" enctype="multipart/form-data">
                                    <input type="file" style="opacity: 0.0; position: absolute; top: 0; left: 0; bottom: 0; right: 0; width: 100%; height:100%;" name="fileToUpload" id="fileToUpload">
                                    
                        </div>
                            <input type="submit" value="Upload Image" name="submit" class='btn btn-success'>
                        </form>
                    </div>
                    <hr>
                    <div class='row'>
                    <div class='col-12 d-flex'>
                            <label class='text-muted'>Username</label><h6 class='d-inline ml-auto'><?= $rows['username'] ?></h6>
                        </div>
                        <div class='col-12 d-flex'>
                            <label class='text-muted'>Email</label><h6 class='d-inline ml-auto'><?= $rows['email'] ?></h6>
                        </div>
                        <div class='col-12 d-flex'>
                            <label class='text-muted'>First Name</label><h6 class='d-inline ml-auto'><?= $rows['firstName'] ?></h6>
                        </div>
                        <div class='col-12 d-flex'>
                            <label class='text-muted'>Last Name</label><h6 class='d-inline ml-auto'><?= $rows['lastName'] ?></h6>
                        </div>
                        <div class='col-12 d-flex'>
                            <label class='text-muted'>Phone Number</label><h6 class='d-inline ml-auto'><?= $rows['phoneNumber'] ?></h6>
                        </div>
                    </div>
                    <hr>
                    <div class='row'>
                        <div class='col-12 d-flex'>
                            <a href='useredit.php' class='btn btn-primary rounded-0 mr-1'>Edit Account</a>
                            <a href='reset-password.php' class='btn btn-info rounded-0'>Change Password</a>
                            <input action="action" type="button" value="Cancel" class='btn btn-secondary ml-auto' onclick="window.history.go(-1); return false;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once('footer.php');
?>