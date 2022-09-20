<?php
include './shared/header.php';
include './shared/nav.php';
?>

<div class="home ">
    <h1 class="pt-5 display-1 text-center"> Welcome At Home Page
        <?php if (isset($_SESSION['name']))
            echo "<br>" . $_SESSION['name'];


        ?> </h1>
</div>

<?php include './shared/footer.php'; ?>