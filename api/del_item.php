<?php include_once "base.php";
dd($_GET);
$item = $_GET;
$Pictures->del($item);
to("../index.php");
