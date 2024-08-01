<?php include_once "base.php";
$dsn = "mysql:host=localhost;charset=utf8;dbname=db11";
$pdo = new PDO($dsn, 'root', '');

$old = q("SELECT * FROM `pictures` WHERE `order_id`= {$_POST['order_id']};");
unlink("../images/" . $old[0]['item']);

if (!empty($_FILES['file']['tmp_name'])) {
    move_uploaded_file($_FILES['file']['tmp_name'], "../images/" . $_FILES['file']['name']);
    $_POST['item'] = $_FILES['file']['name'];
    $sql = "UPDATE `pictures` SET `id`='{$_POST['id']}',`item`='{$_POST['item']}',`order_id`='{$_POST['order_id']}' WHERE `id`='{$_POST['id']}'";
    $pdo->exec($sql);
    to("../index.php");
}
