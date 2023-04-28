<?php
//ob_start();
include '../shared/header.php';
include '../shared/nav.php';
include '../general/env.php';
include '../general/functions.php';
$select = "SELECT * FROM services WHERE id = " . $_GET['id'];
$s = mysqli_query($connection, $select);
if (isset($_POST['order'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    if (isset($_SESSION['userid'])) {
        $userid = $_SESSION['userid'];
    }
    $insert = "INSERT INTO orders VALUES(Null, '$title', '$description', " . $userid . ", " . $_GET['id'] . ")";
    $i = mysqli_query($connection, $insert);
    testMessage($i, "Order");
}
?>
    <h1 class="text-center"> Add Order </h1>
    <div class="container col-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="service">Order Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="service">Order Description</label>
                        <textarea class="form-control" name="description" required></textarea>
                    </div>
                    <button type="submit" name="order" class="btn btn-primary mt-2">Order</button>
                </form>
            </div>
        </div>
    </div>
<?php include '../shared/footer.php';
ob_end_flush();
?>
