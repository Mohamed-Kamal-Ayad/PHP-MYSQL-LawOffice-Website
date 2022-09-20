<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/env.php';
include '../general/functions.php';
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $select = "SELECT * FROM lawyers WHERE id = $id ";
    $lawyer = mysqli_query($connection, $select);
    $row = mysqli_fetch_assoc($lawyer);
    $image = $row['image'];
    unlink($image);
    $delete = "DELETE FROM lawyers WHERE id = $id";
    $d = mysqli_query($connection, $delete);
    header("location:list.php#?return");
    testMessage($d, "Delete lawyer");
}

if (isset($_GET['search'])) {
    $searchName = $_GET['searchName'];
    if (isset($_GET['salary'])) {
        $select = "SELECT * FROM `lawyers` WHERE `name` LIKE '%$searchName%' ORDER BY salary DESC";
        $filter = mysqli_query($connection, $select);
    } else {
        $select = "SELECT * FROM `lawyers` WHERE `name` LIKE '%$searchName%'";
        $filter = mysqli_query($connection, $select);
    }
}


$selectUsers = "SELECT * FROM `lawyers`";
$lawyers = mysqli_query($connection, $selectUsers);
authAdmin(1, 2, 3);
?>
<h1 class="text-center">Lawyers List</h1>

<div class="container-fluid col-md-6 text-center">
    <div class="card">
        <div class="card-body">

            <form method="GET" class="form-inline  my-2 my-lg-0">
                <input class="form-control mr-sm-2" name="searchName" type="search" placeholder="Search"
                    aria-label="Search">
                <input type="submit" class="btn btn-outline-primary mr-2 my-sm-0" value="Search" name="search">
                <input type="reset" class="btn btn-outline-danger mh-auto my-2 my-sm-1" value="Reset" name="reset">
                <input type="checkbox" class="ml-auto mr-1" name="salary">
                <label for="salary" class="text-right">By salary</label>
            </form>
            <?php if (!isset($_GET['search'])) :
            ?>
            <table id="return" class="table table-dark">
                <thead>
                    <tr>
                        <th> id </th>
                        <th> lawyer Name</th>
                        <th> Action</th>
                    </tr>

                </thead>
                <tbody>
                    <?php foreach ($lawyers as $data) : ?>
                    <tr>
                        <td><?= $data['id']; ?></td>
                        <td><?= $data['name']; ?></td>
                        <td>
                            <?php if ($_SESSION['adminRole'] == 1 || $_SESSION['adminRole'] == 2) :
                                    ?>
                            <div class="dropdown">
                                <i type="button" data-toggle="dropdown" aria-expanded="false"
                                    class="fa-solid btn btn-light fa-ellipsis-vertical"></i>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item text-info"
                                        href="/lawoffice/lawyers/show.php?show=<?= $data['id'] ?>"><i
                                            class="fa-solid fa-eye"></i></a>
                                    <a class="dropdown-item text-primary"
                                        href="/lawoffice/lawyers/update.php?edit=<?= $data['id'] ?>"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                    <a class="dropdown-item text-danger"
                                        href="/lawoffice/lawyers/list.php?delete=<?= $data['id'] ?>"><i
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
            <?php else :
            ?>
            <table id="return" class="table table-dark">
                <thead>
                    <tr>
                        <th> id </th>
                        <th> lawyer Name</th>
                        <th> Action</th>
                    </tr>

                </thead>
                <tbody>
                    <?php foreach ($filter as $data) :
                        ?>
                    <tr>
                        <td><?= $data['id']; ?></td>
                        <td><?= $data['name']; ?></td>
                        <td>
                            <?php if ($_SESSION['adminRole'] == 1 || $_SESSION['adminRole'] == 2) :
                                    ?>
                            <div class="dropdown">
                                <i type="button" data-toggle="dropdown" aria-expanded="false"
                                    class="fa-solid btn btn-light fa-ellipsis-vertical"></i>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item text-info"
                                        href="/lawoffice/lawyers/show.php?show=<?= $data['id'] ?>"><i
                                            class="fa-solid fa-eye"></i></a>
                                    <a class="dropdown-item text-primary"
                                        href="/lawoffice/lawyers/update.php?edit=<?= $data['id'] ?>"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                    <a class="dropdown-item text-danger"
                                        href="/lawoffice/lawyers/list.php?delete=<?= $data['id'] ?>"><i
                                            class="fa-solid fa-trash-can"></i></a>
                                </div>
                            </div>
                            <?php else : echo '<p style="color:red">No Access</p>'
                                    ?>
                            <?php endif;
                                    ?>
                        </td>
                    </tr>
                    <?php endforeach;
                        ?>
                </tbody>
            </table>
            <?php endif;
            ?>
        </div>
    </div>
</div>

<?php include '../shared/footer.php'; ?>