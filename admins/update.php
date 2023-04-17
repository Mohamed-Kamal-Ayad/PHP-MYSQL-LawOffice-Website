<?php
include '../general/env.php';
include '../general/functions.php';
include '../shared/header.php';
echo "<style>
  
.checkboxes label {
    display: inline-block;
    padding-right: 10px;
    white-space: nowrap;
  }
  .checkboxes input {
    vertical-align: middle;
  }
  
</style>";
include '../shared/nav.php';

$select = "SELECT * FROM roles";
$roles = mysqli_query($connection, $select);


if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $select = "SELECT * FROM admins WHERE id = $id";
    $admin = mysqli_query($connection, $select);
    $row = mysqli_fetch_assoc($admin);
    if (isset($_POST['update'])) {
        if (md5($_POST['oldpassword']) == $row['password']) {
            $name = $_POST['name'];
            if(isset($_POST['newpassword'])) {
                $password = md5($_POST['newpassword']);
            } else {
                $password = md5($_POST['oldpassword']);
            }
            $age = $_POST['age'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            if (empty($_FILES['image']['name'])) {
                $location = $row['image'];
            } else {
                $image_name = time() . $_FILES['image']['name'];
                $tmp_name = $_FILES['image']['tmp_name'];
                $location = "./upload/" . $image_name;
                move_uploaded_file($tmp_name, $location);
            }
            if (!$_SESSION['adminRole'] == 1) {
                $update = "UPDATE admins SET id = $id, `name` = '$name', `password` = '$password' , `image` = '$location' , phone = '$phone', age = '$age', `address` = '$address', email = '$email'  WHERE id = $id";
                $u = mysqli_query($connection, $update);
                testMessage($u, "Update Admin");
                header("location:list.php#?return");
            } else {
                $update = "UPDATE admins SET id = $id, `name` = '$name', `password` = '$password' , `image` = '$location', phone = '$phone', age = '$age', `address` = '$address', email = '$email' ,`role` = $role WHERE id = $id";
                $u = mysqli_query($connection, $update);
                if ($_SESSION['adminid'] == $id) {
                    session_unset();
                    session_destroy();
                }
                testMessage($u, "Update Admin");
                header("location:list.php#?return");
            }
        } else {
            echo "<div class='alert alert-danger col-4 mx-auto'>
            Wrong Old password!
            </div>";
        }
    }
}
authAdmin(1, $_SESSION['adminRole']);
?>
<h1 class="text-center"> Update Admin Data </h1>
<div class="container col-6">
    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">User Name</label>
                    <input type="text" class="form-control" value="<?= $row['name'] ?>" name="name" required>
                </div>
                <div class="form-group">
                    <label for="password">Old Password</label>
                    <input type="password" class="form-control" name="oldpassword" required>
                </div>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" class="form-control" name="newpassword">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" value="<?= $row['email'] ?>" name="email" required>
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" class="form-control" value="<?= $row['age'] ?>" name="age" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" value="<?= $row['address'] ?>" name="address" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" class="form-control" value="<?= $row['phone'] ?>" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" name="image">
                </div>
                <?php if ($_SESSION['adminRole'] == 1) : ?>
                <div class="form-row align-items-center">
                    <div class="col-auto my-1">
                        <label for="role">Admin role</label>
                        <select class="custom-select mr-sm-2" name="role">
                            <option selected required>Choose Admin role</option>
                            <?php foreach ($roles as $data) : ?>
                            <option value="<?= $data['id']; ?>">
                                <?= $data['description']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($_SESSION['adminid'] == $id) : ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" required>
                    <label class="form-check-label" for="defaultCheck1">
                        Please notice that you will need to login again!
                    </label>
                </div>
                <?php endif; ?>
                <button type="submit" name="update" class="btn btn-primary mt-0">Update Data</button>
            </form>

        </div>
    </div>
</div>
<?php include '../shared/footer.php'; ?>