<?php
include_once "config/arrays.php";
include_once root."/modal/user.php";
$user = new user();
$r = ["receiver"=> 2403002, "sender"=>$_SESSION["clientSession"]];
echo "<pre>";
//print_r();
$user->users_html($user->getUsers());