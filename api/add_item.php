<?php include_once "base.php";
$dsn = "mysql:host=localhost;charset=utf8;dbname=db11";
$pdo = new PDO($dsn, 'root', '');

$data = $Pictures->all();
// dd($data);
$existNum = [];
foreach ($data as $datium) {
    $existNum[] = $datium['order_id'];
}
if (in_array($_POST['order_id'], $existNum)) {
    to("../backend/add_item.php?existNum={$_POST['order_id']}");
    exit();
}


if (!empty($_FILES['item']['tmp_name'])) {
    move_uploaded_file($_FILES['item']['tmp_name'], "../images/" . $_FILES['item']['name']);
    $sql = "insert into `pictures` (`item`, `order_id`) values('{$_FILES['item']['name']}','{$_POST['order_id']}')";
    dd($sql);
    $pdo->exec($sql);
    to("../index.php");
}
// INSERT INTO `pictures` (`id`, `item`, `order_id`) VALUES (NULL, 'img17.jpg', '7');