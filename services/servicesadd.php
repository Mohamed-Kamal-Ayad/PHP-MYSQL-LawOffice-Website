<?php
//ob_start();
include '../shared/header.php';
include '../shared/nav.php';
include '../general/env.php';
include '../general/functions.php';
if (isset($_POST['add'])) {
    $title = $_POST['service'];
    $lawyerid = $_POST['lawyerid'];
    $insert = "INSERT INTO services VALUES(Null, '$title', $lawyerid)";
    $i = mysqli_query($connection, $insert);
    header("location: serviceslist.php");
}
$select = "SELECT * FROM lawyers";
$law = mysqli_query($connection, $select);
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
                <div class="form-row align-items-center">
                    <div class="col-auto my-1">
                        <label for="lawyer">Lawyer</label>
                        <select class="custom-select mr-sm-2" name="lawyerid">
                            <option selected>Choose Lawyer</option>
                            <?php foreach ($law as $data) : ?>
                            <option value="<?= $data['id']; ?>">
                                <?= $data['name']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <button type="submit" name="add" class="btn btn-primary mt-2">Add Services</button>
            </form>
        </div>
    </div>
</div>
<?php include '../shared/footer.php';
ob_end_flush();
?>