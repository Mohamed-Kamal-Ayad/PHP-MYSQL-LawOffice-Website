<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/env.php';
include '../general/functions.php';
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    $insert = "INSERT INTO `users`(`id`,`name`, `age`, `address`, `phone`, `email`, `password`) VALUES (NULL,'$name',$age,'$address','$phone','$email','$password')";
    $s = mysqli_query($connection, $insert);
    testMessage($s, "Insert User");
    header("location:list.php#?return");
}
authAdmin(1);
?>
    <h1 class="text-center"> Register </h1>
    <div class="container col-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">User Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" required>
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
                    <button type="submit" name="add" class="btn btn-primary mt-2">Register</button>
                </form>
            </div>
        </div>
    </div>
<?php include '../shared/footer.php'; ?>
