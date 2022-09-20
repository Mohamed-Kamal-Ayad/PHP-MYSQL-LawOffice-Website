<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/env.php';
include '../general/functions.php';
if (isset($_GET['show'])) {
    $id = $_GET['show'];
    $select = "SELECT * FROM lawyers WHERE id = $id";
    $lawyer = mysqli_query($connection, $select);
    $row =  mysqli_fetch_assoc($lawyer);
}
//auth(1, 2);
?>
<h2 class="text-center"> Show lawyer : <?= $row['name'] ?> </h2>

<div class="container-fluid col-md-3 text-center">
    <div class="card">
        <img src="/lawoffice/lawyers/<?= $row['image'] ?>" class="card-img-top" alt="">
        <div class="card-body">
            <p>Name: <?= $row['name']; ?></p>
            <p>Email: <?= $row['email']; ?></p>
            <p>Salary: <?= $row['salary']; ?></p>
            <p>Address: <?= $row['address']; ?></p>
            <p>Age: <?= $row['age']; ?></p>
            <p>Years ex: <?= $row['yearsEX']; ?></p>
        </div>
    </div>
</div>
<?php include '../shared/footer.php'; ?>