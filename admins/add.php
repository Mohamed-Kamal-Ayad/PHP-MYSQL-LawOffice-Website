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
    $image_name = time() . $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $location = "./upload/" . $image_name;
    move_uploaded_file($tmp_name, $location);
    $role = $_POST['role'];

    $insert = "INSERT INTO `admins`(`id`,`name`, `age`, `address`, `phone`, `email`, `password`, `image`, `role`) VALUES (NULL,'$name',$age,'$address','$phone','$email','$password','$location',$role)";
    $s = mysqli_query($connection, $insert);
    testMessage($s, "Insert Admin");
}
$select = "SELECT * FROM `roles`";
$roles = mysqli_query($connection, $select);
authAdmin(1);
?>
<h1 class="text-center"> Add Admin </h1>
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
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" name="image" required>
                </div>
                <div class="form-row align-items-center">
                    <div class="col-auto my-1">
                        <label for="role">Admin role</label>
                        <select class="custom-select mr-sm-2" name="role">
                            <option selected>Choose Admin role</option>
                            <?php foreach ($roles as $data) : ?>
                            <option value="<?= $data['id']; ?>">
                                <?= $data['description']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <button type="submit" name="add" class="btn btn-primary mt-2">Add Admin</button>
            </form>
        </div>
    </div>
</div>
<?php include '../shared/footer.php'; ?>
