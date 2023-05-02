<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/env.php';
include '../general/functions.php';
if (isset($_POST['insert'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $salary = $_POST['salary'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $years = $_POST['yearsEx'];
    $phone = $_POST['phone'];
    $service_id = $_POST['service_id'];
    $password = sha1($_POST['password']);
    $image_name = time() . $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $location = "./upload/" . $image_name;
    move_uploaded_file($tmp_name, $location);
    $insert = "INSERT INTO `lawyers`(`id`, `name`, `age`, `address`, `salary`, `yearsEX`, `phone`, `email`, `password`, `image`, `service_id`) VALUES (NULL,'$name','$age','$address',$salary,'$years','$phone','$email','$password','$location',$service_id)";
    $s = mysqli_query($connection, $insert);
    testMessage($s, "Insert lawyer");
}

$selServices = "SELECT * FROM services";
$s = mysqli_query($connection, $selServices);
authAdmin(1, 2);

?>
<h1 class="text-center"> Add lawyer </h1>
<div class="container col-6">
    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" required>
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
                    <label for="salary">Salary</label>
                    <input type="number" class="form-control" name="salary" required>
                </div>
                <div class="form-group">
                    <label for="salary">years experience</label>
                    <input type="number" class="form-control" name="yearsEx" required>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" name="image" required>
                </div>
                <div class="form-row align-items-center">
                    <div class="col-auto my-1">
                        <label for="service">Service</label>
                        <select class="custom-select mr-sm-2" name="serviceid" required>
                            <option selected>Choose Service</option>
                            <?php foreach ($s as $data) : ?>
                                <option value="<?= $data['id']; ?>">
                                    <?= $data['title']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <button type="submit" name="insert" class="btn btn-primary mt-2">Insert lawyer</button>
            </form>
        </div>
    </div>
</div>
<?php include '../shared/footer.php'; ?>
