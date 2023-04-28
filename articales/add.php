<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/env.php';
include '../general/functions.php';

if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $auther = $_POST['auther'];
    $image_name1 = time() . $_FILES['image']['name'];
    $tmp_name1 = $_FILES['image']['tmp_name'];
    $location1 = "./upload/" . $image_name1;
    move_uploaded_file($tmp_name1, $location1);
    $insert = "INSERT INTO `articales`(`id`, `title`, `description`, `auther`, `image`, `create_time`, `update_time`) VALUES (Null,'$title','$description','$auther','$location1',DEFAULT,DEFAULT)";
    $i = mysqli_query($connection, $insert);
    //testMessage($i, "ssws");
    header("location:list.php");
}



?>

<h1 class="text-center"> Create Articale </h1>
<div class="container col-6">
    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="auther">Auther</label>
                    <input type="text" value="<?= $_SESSION['name']; ?>" class="form-control" name="auther" readonly>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" name="image" required>
                </div>
                <button type="submit" name="create" class="btn btn-primary mt-2">Create Articale</button>
            </form>
        </div>
    </div>
</div>

<?php include '../shared/footer.php'; ?>