<?php
ob_start();
session_start();
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('location:/lawoffice/');
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/lawoffice/index.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php if (isset($_SESSION)) : ?>
                <?php if (isset($_SESSION['adminid'])) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                           aria-expanded="false">
                            Lawyers
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/lawoffice/lawyers/add.php">Add lawyers</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/lawoffice/lawyers/list.php">Lawyers List</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                           aria-expanded="false">
                            Users
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/lawoffice/users/add.php">Add users</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/lawoffice/users/list.php">Users List</a>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if (isset($_SESSION['lawyerid']) || (isset($_SESSION['adminid'])) || (isset($_SESSION['userid']))) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                           aria-expanded="false">
                            Articales
                        </a>
                        <?php if (isset($_SESSION['lawyerid']) || (isset($_SESSION['adminid'])) || (isset($_SESSION['userid']))) : ?>
                            <div class="dropdown-menu">
                                <?php if (isset($_SESSION['lawyerid']) || (isset($_SESSION['adminid']))) : ?>
                                    <a class="dropdown-item" href="/lawoffice/articales/add.php">Create New</a>
                                <?php endif ?>
                                <?php if (isset($_SESSION['lawyerid']) || (isset($_SESSION['adminid'])) || (isset($_SESSION['userid']))) : ?>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/lawoffice/articales/list.php">Articales List</a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
                <?php if (isset($_SESSION['adminid'])) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                           aria-expanded="false">
                            Admins
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/lawoffice/admins/add.php">Add admin</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/lawoffice/admins/list.php">Admins List</a>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if (isset($_SESSION['userid']) || isset($_SESSION['lawyerid'])) : ?>
                    <li class="nav-item">
                        <a href="/lawoffice/services/serviceslist.php" class="nav-link">Our Services</a>
                    </li>
                <?php elseif (isset($_SESSION['adminid']) || isset($_SESSION['lawyerid']) || isset($_SESSION['userid'])) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown"
                           aria-expanded="false">
                            Our Srevices
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/lawoffice/services/servicesadd.php">Add Service</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/lawoffice/services/serviceslist.php">Services List</a>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if (isset($_SESSION['lawyerid']) || (isset($_SESSION['adminid'])) || (isset($_SESSION['userid']))) : ?>
                    <li class="nav-item">
                        <?php if (isset($_SESSION['adminid'])) : ?>
                            <a href="/lawoffice/admins/profile.php" class="nav-link">Profile</a>
                        <?php elseif (isset($_SESSION['lawyerid'])) : ?>
                            <a href="/lawoffice/lawyers/profile.php" class="nav-link">Profile</a>
                        <?php elseif (isset($_SESSION['userid'])) : ?>
                            <a href="/lawoffice/users/profile.php" class="nav-link">Profile</a>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['lawyerid']) || (isset($_SESSION['adminid']))): ?>
            <li class="nav-item">
                <a href="/lawoffice/orders/list.php" class="nav-link">Orders</a>
            </li>
            <?php endif; ?>
        </ul>
        <?php if (isset($_SESSION['adminid']) || isset($_SESSION['userid']) || isset($_SESSION['lawyerid'])) :
            ?>
            <form class="form-inline ml-2 my-2 my-lg-0" method="GET">
                <button name="logout" class="btn btn-danger"> Log Out</button>
            </form>
        <?php else :
            ?>
            <form class="form-inline ml-2 my-2 my-lg-0">
                <a href="/lawoffice/auth/loginAdmin.php" class="btn btn-outline-success my-2 my-sm-0" type="submit">Login
                    Admin</a>
            </form>
            <form class="form-inline ml-2 my-2 my-lg-0">
                <a href="/lawoffice/auth/loginLawyer.php" class="btn btn-outline-success my-2 my-sm-0" type="submit">Login
                    Lawyer</a>
            </form>
            <form class="form-inline ml-2 my-2 my-lg-0">
                <a href="/lawoffice/auth/loginUser.php" class="btn btn-outline-success my-2 my-sm-0" type="submit">Login
                    User</a>
            </form>
            <form class="form-inline ml-2 my-2 my-lg-0">
                <a href="/lawoffice/auth/register.php" class="btn btn-outline-primary my-2 my-sm-0" type="submit">Sign Up</a>
            </form>
        <?php endif; ?>
    </div>
</nav>
