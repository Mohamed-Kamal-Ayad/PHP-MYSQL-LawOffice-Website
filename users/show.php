<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/env.php';
include '../general/functions.php';
if (isset($_GET['show'])) {
    $id = $_GET['show'];
    $select = "SELECT * FROM users WHERE id = $id";
    $user = mysqli_query($connection, $select);
    $row =  mysqli_fetch_assoc($user);
}
authAdmin(1, 2);
?>
<h2 class="text-center"> Show user : <?= $row['name'] ?> </h2>

<div class="container-fluid col-md-3 text-center">
    <div class="card">
        <div class="card-body">
            <p>Name: <?= $row['name']; ?></p>
            <p>Email: <?= $row['email']; ?></p>
            <p>Phone: <?= $row['phone']; ?></p>
            <p>Address: <?= $row['address']; ?></p>
            <p>Age: <?= $row['age']; ?></p>
        </div>
    </div>
</div>
<?php include '../shared/footer.php'; ?>