<?php
//ob_start();
include '../shared/header.php';
include '../shared/nav.php';
include '../general/env.php';
include '../general/functions.php';
if (isset($_POST['add'])) {
    $title = $_POST['service'];
    $insert = "INSERT INTO services VALUES(Null, '$title')";
    $i = mysqli_query($connection, $insert);
    header("location: serviceslist.php");
}
authAdmin(1, 2);
?>
<h1 class="text-center"> Add Services </h1>
<div class="container col-6">
    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="service">Service</label>
                    <input type="text" class="form-control" name="service" required>
                </div>
                <button type="submit" name="add" class="btn btn-primary mt-2">Add Services</button>
            </form>
        </div>
    </div>
</div>
<?php include '../shared/footer.php';
ob_end_flush();
?>
