<?php
include '../general/env.php';
include '../general/functions.php';
include '../shared/header.php';
include '../shared/nav.php';
if (true) {
    $id = $_SESSION['adminid'];
    $select = "SELECT * FROM `admins`  JOIN `roles` ON admins.role = roles.id where admins.id = $id ";
    $admin = mysqli_query($connection, $select);
    $row = mysqli_fetch_assoc($admin);
}
if (isset($_GET['show'])) {
    $id = $_GET['show'];
    $select = "SELECT * FROM `admins` JOIN `roles` ON admins.role = roles.id where admins.id = $id";
    $admin = mysqli_query($connection, $select);
    $row = mysqli_fetch_assoc($admin);
}
authAdmin($_SESSION['adminid']);
?>
<h1 class="text-center">Your Profile</h1>
<div class="container-fluid col-md-4 text-center">
    <div class="card">
        <img src="/lawoffice/admins<?= $row['image'] ?>" class="card-img-top" alt="">
        <div class="card-body">
            <h1>Name: <?= $row['name']; ?></h1>
            <h1>Role: <?= $row['description']; ?></h1>
            <a href="/lawoffice/admins/update.php?edit=<?= $row['id']; ?>"><button
                    class="btn btn-info col-md-3">Edit</button></a>
        </div>
    </div>
</div>

<?php include '../shared/footer.php'; ?>