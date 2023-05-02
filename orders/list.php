<?php include '../shared/header.php';
include '../shared/nav.php';
include '../general/env.php';
include '../general/functions.php';

$select = "
SELECT orders.title AS ortitle, orders.description AS ordescription, services.title AS sertitle, users.name AS username, lawyers.name AS lawyername
FROM orders
JOIN services ON orders.service_id = services.id
JOIN users ON orders.user_id = users.id
JOIN lawyers ON orders.lawyer_id = lawyers.id;
";
//get error messsage
$ss = mysqli_query($connection, $select);
echo mysqli_error($connection);


?>
<h1 class="text-center"> Orders List </h1>
<div class="container-fluid col-md-6 text-center">
    <div class="card">
        <div class="card-body">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">Order Title</th>
                        <th scope="col">Order Description</th>
                        <th scope="col">Service Title</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Lawyer Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ss as $orders) : ?>
                        <tr>
                            <td><?= $orders['ortitle']; ?></td>
                            <td><?= $orders['ordescription']; ?></td>
                            <td><?= $orders['sertitle']; ?></td>
                            <td><?= $orders['username']; ?></td>
                            <td><?= $orders['lawyername']; ?></td>
                        </tr>
                    <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>


<?php include '../shared/footer.php'; ?>
