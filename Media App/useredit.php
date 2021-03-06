<?php
$title = 'Edit Account';
include_once('header.php');

$ID = $_SESSION['id'];

if (isset($_POST['update'])) {
    $sql = "UPDATE user SET firstName = ?, lastName = ?, phoneNumber = ? WHERE id = ?";

    $statement = $connection->prepare($sql);

    $statement->bind_param('sssi', $_POST['firstName'], $_POST['lastName'], $_POST['phoneNumber'], $_SESSION['id']);
    $statement->execute();

    if ($statement->error) {
        header('Location: user.php');
        exit; // Add flash later.
    } else {
        header('Location: user.php');
        exit; // Add flash later.
    }
} else {

    $statement = "SELECT * FROM user WHERE id = ?";

    if ($pre = $connection->prepare($statement)) {
        $pre->bind_param('i', $id);
        $id = $ID;
        $pre->execute();
        $result = $pre->get_result();
        $rows = $result->fetch_assoc();
    }

?>

<div class='container-fluid mt-4'>
    <div class='row d-flex align-content-center justify-content-center h-100'>
        <div class='col-sm-12 col-md-8 col-xl-6'>
            <div class='card w-100 shadow'>
                <div class='card-header pb-0'>
                    <h1>Edit Account</h1>
                    <hr>
                </div>
                <div class='card-body'>
                    <div class='row d-flex'>
                        <div class='col-12'>
                            <form  method='post' action="<?php $_PHP_SELF ?>">
                                <div class="form-group">
                                    <label for="firstName">First Name</label>
                                    <input name="firstName" type="text" class="form-control" id="firstName" placeholder="First Name" value="<?= $rows['firstName'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Last Name</label>
                                    <input name="lastName" type="text" class="form-control" id="lastName" placeholder="Last Name" value="<?= $rows['lastName'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="phoneNumber">Phone Number</label>
                                    <input name="phoneNumber" type="text" class="form-control" id="lastName" placeholder="Last Name" value="<?= $rows['phoneNumber'] ?>">
                                </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-12 d-flex'>
                                <input name="update" type="submit" id="update" value="Update Form" class='btn btn-success rounded-0'>
                                <a href='user.php' class='btn btn-secondary rounded-0 ml-auto'>Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}
include_once('footer.php');
?>