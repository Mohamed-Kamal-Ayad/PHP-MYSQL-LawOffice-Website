<?php
include '../general/env.php';
include '../general/functions.php';
include '../shared/header.php';
include '../shared/nav.php';
if (true) {
    $id = $_SESSION['lawyerid'];
    $select = "SELECT * FROM lawyers where id = $id";
    $lawyer = mysqli_query($connection, $select);
    $row = mysqli_fetch_assoc($lawyer);
}

authlawyer($_SESSION['lawyerid']);
?>
<h1 class="text-center">Your Profile</h1>
<div class="container-fluid col-md-5 text-center">
    <div class="card">
        <img src="/lawoffice/lawyers<?= $row['image'] ?>" class="card-img-top" alt="">
        <div class="card-body">
            <h1>Name: <?= $row['name']; ?></h1>
            <h1>Email: <?= $row['email']; ?></h1>
            <h1>Salary: <?= $row['salary']; ?></h1>
            <h1>Address: <?= $row['address']; ?></h1>
            <h1>Age: <?= $row['age']; ?></h1>
            <h1>Years ex: <?= $row['yearsEX']; ?></h1>
            <a href="/lawoffice/lawyers/update.php?edit=<?= $row['id']; ?>"><button
                    class="btn btn-info col-md-3">Edit</button></a>
        </div>
    </div>
</div>

<?php include '../shared/footer.php'; ?>