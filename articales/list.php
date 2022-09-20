<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/env.php';
include '../general/functions.php';

$select = "select * from articales";
$s = mysqli_query($connection, $select);

?>

<?php foreach ($s as $articales) : ?>
<div class="container col-5">
    <div class="card text-center" style="width: full;">
        <img src="<?= $articales['image'] ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?= $articales['title']; ?></h5>
            <p class="card-text"><?= $articales['description']; ?></p>
            <pre style="color:white ;">Written By: <?= $articales['auther'] ?></pre>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?php include '../shared/footer.php'; ?>