<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/env.php';
include '../general/functions.php';
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $select = "SELECT * FROM lawyers WHERE id = $id";
    $lawyer = mysqli_query($connection, $select);
    $row = mysqli_fetch_assoc($lawyer);

    if (isset($_POST['update'])) {
        if (sha1($_POST['oldpassword']) == $row['password']) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            if(isset($_POST['newpassword'])) {
                $password = md5($_POST['newpassword']);
            } else {
                $password = md5($_POST['oldpassword']);
            }
            $salary = $_POST['salary'];
            $address = $_POST['address'];
            $age = $_POST['age'];
            $years = $_POST['yearsEx'];
            $phone = $_POST['phone'];
            if (empty($_FILES['image']['name'])) {
                $location = $row['image'];
            } else {
                $image_name = time() . $_FILES['image']['name'];
                $tmp_name = $_FILES['image']['tmp_name'];
                $location = "./upload/" . $image_name;
                move_uploaded_file($tmp_name, $location);
            }

            $update = "UPDATE lawyers SET id = $id, `name` = '$name', salary = $salary, `address`='$address', age = $age, `image` = '$location', email = '$email', `password` = $password, yearsEX = $years WHERE id = $id";
            $u = mysqli_query($connection, $update);
            //header("location:list.php?#return");
            testMessage($u, "Update lawyer");
        }
    }
}

if (isset($_SESSION['adminid'])) {
    authAdmin(1, 2);
} elseif (isset($_SESSION['lawyerid'])) {
    authLawyer($_SESSION['lawyerid']);
}
?>
<h1 class="text-center"> Upadate lawyer </h1>
<div class="container col-6">
    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" value="<?= $row['name'] ?>" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" value="<?= $row['email'] ?>" name="email" required>
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
                    <label for="salary">Salary</label>
                    <input type="number" class="form-control" value="<?= $row['salary'] ?>" name="salary" required>
                </div>
                <div class="form-group">
                    <label for="salary">years experience</label>
                    <input type="number" class="form-control" value="<?= $row['yearsEX'] ?>" name="yearsEx" required>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" name="image" required>
                </div>
                <button type="submit" class="btn btn-info mt-2" name="update">Update Data</button>
            </form>
        </div>
    </div>
</div>
<?php include '../shared/footer.php'; ?>