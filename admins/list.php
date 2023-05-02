<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/env.php';
include '../general/functions.php';
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $select = "SELECT * FROM admins WHERE id = $id ";
    $admin = mysqli_query($connection, $select);
    $row = mysqli_fetch_assoc($admin);
    $image = $row['image'];
    unlink($image);
    $delete = "DELETE FROM admins WHERE id = $id";
    $d = mysqli_query($connection, $delete);
    header("location:/lawoffice/admins/list.php");
    testMessage($d, "Delete Admin");
}

$selectAdmins = "SELECT admins.id As id, admins.name As `name`, roles.description As description FROM `admins` JOIN roles ON roles.id = admins.role";
$admins = mysqli_query($connection, $selectAdmins);
authAdmin(1, 2, 3);
?>
<h1 class="text-center">Admins List</h1>

<div class="container-fluid col-md-6 text-center">
    <div class="card">
        <div class="card-body">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th> id </th>
                        <th> Admin Name</th>
                        <th> Role </th>
                        <th> Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($admins as $data) : ?>
                    <tr>
                        <td><?= $data['id']; ?></td>
                        <td><?= $data['name']; ?></td>
                        <td><?= $data['description']; ?></td>
                        <td>
                            <?php if ($_SESSION['adminRole'] == 1) :
                                ?>
                            <div class="dropdown">
                                <i type="button" data-toggle="dropdown" aria-expanded="false"
                                    class="fa-solid btn btn-light fa-ellipsis-vertical"></i>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item text-info"
                                        href="/lawoffice/admins/profile.php?show=<?= $data['id'] ?>"><i
                                            class="fa-solid fa-eye"></i></a>
                                    <a class="dropdown-item text-primary"
                                        href="/lawoffice/admins/update.php?edit=<?= $data['id'] ?>"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                    <a class="dropdown-item text-danger"
                                        href="/lawoffice/admins/list.php?delete=<?= $data['id'] ?>"><i
                                            class="fa-solid fa-trash-can"></i></a>
                                </div>
                            </div>
                            <?php else : echo '<p style="color:red">No Access</p>'
                                ?>
                            <?php endif;
                                ?>

                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../shared/footer.php'; ?>
