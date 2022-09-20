<?php
include '../general/env.php';
include '../general/functions.php';
include '../shared/header.php';
include '../shared/nav.php';
if (true) {
    $id = $_SESSION['userid'];
    $select = "SELECT * FROM users where id = $id";
    $user = mysqli_query($connection, $select);
    $row = mysqli_fetch_assoc($user);
}

?>
<h1 class="text-center">Your Profile</h1>
<div class="container-fluid col-md-4 text-center">
    <div class="card">

        <div class="card-body">
            <p>Name: <?= $row['name']; ?></p>
            <p>Email: <?= $row['email']; ?></p>
            <p>Phone: <?= $row['phone']; ?></p>
            <p>Address: <?= $row['address']; ?></p>
            <p>Age: <?= $row['age']; ?></p>
            <a href="/lawoffice/users/update.php?edit=<?= $row['id']; ?>"><button
                    class="btn btn-info col-md-3">Edit</button></a>
        </div>
    </div>
</div>

<?php include '../shared/footer.php'; ?>