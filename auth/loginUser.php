<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/env.php';
include '../general/functions.php';
if (isset($_POST['loginUser'])) {
    $name = $_POST['name'];
    $password = sha1($_POST['password']);
    $email = $_POST['email'];
    $select = "SELECT * FROM users where `name`= '$name' and `password` = '$password' and email = '$email'";
    $user = mysqli_query($connection, $select);
    $row = mysqli_fetch_assoc($user);
    $count = mysqli_num_rows($user);
    if ($count == 1) {
        $_SESSION['userid'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        header("location: /lawoffice/");
    } else {
        echo "<div class='alert alert-danger col-4 mx-auto'>
        Wrong Data
        </div>";
    }
}
?>
<h1 class="text-center">Login User</h1>

<div class="container col-6">
    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">User Name</label>
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
                <button type="submit" name="loginUser" class="btn btn-primary mt-2">Login</button>
            </form>
        </div>
    </div>
</div>

<?php include '../shared/footer.php'; ?>