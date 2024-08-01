<h3>刪除圖片</h3>
<?php
include_once "../api/base.php";
$data = $Pictures->all();
foreach ($data as $key => $value) {
    $file = "../images/" . $value['item'];
?>
    <hr>
    <table>
        <tr>
            <td style="width:50%;">
                圖片 : <img src="<?= $file; ?>" alt="" id="preview" style="width: 49%;">
            </td>
            <td><input type="number" name="order_id" readonly value=<?= $value['order_id'] ?>>圖片順序</td>
            <td><input type="hidden" name="id" value="" tyle="width: 2%;"></td>
        </tr>
        <tr>
            <td>
                <button><a href="../api/del_item.php?id=<?= $value['id'] ?>" style="text-decoration: none;color:black;">確認刪除</a></button>
                <button><a href="../index.php" style="text-decoration: none;color:black;">返回首頁</a></button>
            </td>
        </tr>
    </table>
<?php
}
?>