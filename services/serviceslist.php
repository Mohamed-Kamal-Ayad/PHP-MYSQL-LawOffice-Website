<?php include '../shared/header.php';
include '../shared/nav.php';
include '../general/env.php';
include '../general/functions.php';

$select = "select * from services";
$join = "select services.id servId, services.title title, lawyers.name lawyername, lawyers.image img from services join lawyers on services.lawyerid = lawyers.id";
$s = mysqli_query($connection, $select);
$ss = mysqli_query($connection, $join)
?>

<?php foreach ($ss as $servicess) : ?>
<div class="container col-5">
    <div class="card text-center" style="width: full;">
        <img src="<?= $servicess['img'] ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?= $servicess['title']; ?></h5>
            <h5 class="card-title"><?= $servicess['lawyername']; ?></h5>
            <button class="btn btn-info">Order</button>
            <p class="card-text"></p>
            <pre style="color:white ;"></pre>
        </div>
    </div>
</div>
<?php endforeach; ?>


<?php include '../shared/footer.php'; ?>