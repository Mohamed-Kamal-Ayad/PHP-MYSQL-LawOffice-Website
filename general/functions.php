<?php
function testMessage($conn, $message)
{
    if ($conn) {
        echo " <div class='alert alert-success col-4 mx-auto'>
        $message Done Successfuly
        </div>";
    } else {
        echo " <div class='alert alert-danger col-4 mx-auto'>
        $message Falied Proccess
        </div>";
    }
}
function authAdmin($num1 = "", $num2 = "", $num3 = "")
{
    if (isset($_SESSION['adminid'])) {
        if (
            $_SESSION['adminRole'] == $num1 || $_SESSION['adminRole'] == $num2
            || $_SESSION['adminRole'] == $num3
        ) {
        } else {
            header("location:/lawoffice/404.php/");
        }
    } else {
        header("location:/lawoffice/auth/loginAdmin.php");
    }
}

function authUser($num1 = "")
{
    if (isset($_SESSION['userid'])) {
        if (
            $_SESSION['userid'] == $num1
        ) {
        } else {
            header("location:/lawoffice/404.php");
        }
    } else {
        header("location:/lawoffice/auth/loginUser.php");
    }
}

function authLawyer($num1 = "")
{
    if (isset($_SESSION['lawyerid'])) {
        if (
            $_SESSION['lawyerid'] == $num1
        ) {
        } else {
            header("location:/lawoffice/404.php");
        }
    } else {
        header("location:/lawoffice/auth/loginLawyer.php");
    }
}