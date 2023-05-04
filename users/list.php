<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/env.php';
include '../general/functions.php';
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $select = "SELECT * FROM users WHERE id = $id ";
    $user = mysqli_query($connection, $select);
    $row = mysqli_fetch_assoc($user);
    $image = $row['image'];
    unlink($image);
    $delete = "DELETE FROM users WHERE id = $id";
    $d = mysqli_query($connection, $delete);
    header("location:list.php#?return");
    testMessage($d, "Delete user");
}

if (isset($_GET['search'])) {
    $searchName = $_GET['searchName'];
    $select = "SELECT * FROM users WHERE `name` LIKE '%$searchName%'";
    $filter = mysqli_query($connection, $select);
}


$selectUsers = "SELECT * FROM `users`";
$users = mysqli_query($connection, $selectUsers);
authAdmin(1, 2, 3);
?>
<h1 class="text-center">Users List</h1>

<div class="container-fluid col-md-6 text-center">
    <div class="card">
        <div class="card-body">

            <form method="GET" class="form-inline  my-2 my-lg-0">
                <input class="form-control mr-sm-2" name="searchName" type="search" placeholder="Search"
                       aria-label="Search">
                <input type="submit" class="btn btn-outline-primary mr-2 my-sm-0" value="Search" name="search">
                <input type="reset" class="btn btn-outline-danger mh-auto my-2 my-sm-1" value="Reset" name="reset">
            </form>
            <?php if (!isset($_GET['search'])) :
                ?>
                <table id="return" class="table table-dark">
                    <thead>
                    <tr>
                        <th> id</th>
                        <th> User Name</th>
                        <th> Email</th>
                        <th> Action</th>
                    </tr>

                    </thead>
                    <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td> <?php echo $user['id']; ?> </td>
                            <td> <?php echo $user['name']; ?> </td>
                            <td> <?php echo $user['email']; ?> </td>
                            <td>
                                <a href="delete.php?delete=<?php echo $user['id']; ?>"
                                   class="btn btn-danger">Delete</a>
                                <a href="edit.php?edit=<?php echo $user['id']; ?>"
                                   class="btn btn-info">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <table id="return" class="table table-dark">
                    <thead>
                    <tr>
                        <th> id</th>
                        <th> User Name</th>
                        <th> Email</th>
                        <th> Action</th>
                    </tr>

                    </thead>
                    <tbody>
                    <?php foreach ($filter as $user) : ?>
                        <tr>
                            <td> <?php echo $user['id']; ?> </td>
                            <td> <?php echo $user['name']; ?> </td>
                            <td> <?php echo $user['email']; ?> </td>
                            <td>
                                <a href="delete.php?delete=<?php echo $user['id']; ?>"
                                   class="btn btn-danger">Delete</a>
                                <a href="edit.php?edit=<?php echo $user['id']; ?>"
                                   class="btn btn-info">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include '../shared/footer.php'; ?>
