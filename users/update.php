<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/env.php';
include '../general/functions.php';
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $select = "SELECT * FROM users WHERE id = $id";
    $user = mysqli_query($connection, $select);
    $row = mysqli_fetch_assoc($user);

    if (isset($_POST['update'])) {
        if (sha1($_POST['oldpassword']) == $row['password']) {
            $name = $_POST['name'];
            $password = sha1($_POST['newpassword']);
            $age = $_POST['age'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $update = "UPDATE users SET id = $id, `name` = '$name', phone = `$phone`, `address`='$address', age = $age, email = '$email', `password` = '$password' WHERE id = $id";
            $u = mysqli_query($connection, $update);
            header("location:list.php?#return");
            testMessage($u, "Update user");
        }
    }
}
if (isset($_SESSION['adminid'])) {
    authAdmin(1, 2);
} elseif (isset($_SESSION['userid'])) {
    authUser($_SESSION['userid']);
}
?>
<h1 class="text-center"> Upadate user </h1>
<div class="container col-6">
    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">User Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label for="password">Old Password</label>
                    <input type="password" class="form-control" name="oldpassword" required>
                </div>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" class="form-control" name="newpassword" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" class="form-control" name="age" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" class="form-control" name="phone" required>
                </div>
                <button type="submit" class="btn btn-info mt-2" name="update">Update Data</button>
            </form>
        </div>
    </div>
</div>
<?php include '../shared/footer.php'; ?>