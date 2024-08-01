<h3>新增圖片</h3>
<hr>
<?php
include_once "../api/base.php";
$data = $Pictures->all();
// $name = ;
// dd($data);
// $existNum = [];
// foreach ($data as $datium) {
//     $existNum[] = $datium['order_id'];
// }
// in_array($)

// $count = "select count([`id`]) from `$data`";
// SELECT COUNT(id) FROM `pictures`
// dd($count);
foreach ($data as $key => $value) {
}
?>
<form action="../api/add_item.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td style="width:50%;">
                圖片 :<img src="" alt="" id="preview">
            </td>
            <td><input type="file" name="item" id="item"></td>
            <td><input type="number" name="order_id" max="10" min="1"></td>
            <?php
            if (!empty($_GET['existNum'])) {
                $data = $Pictures->all();
                $existNum = [];
                foreach ($data as $datium) {
                    $existNum[] = $datium['order_id'];
                }
                echo "<h3 style='color:red'>order_id: {$_GET['existNum']}已存在</h3>";
                echo "<h3 style='color:red'>order_id: " . join(", ", $existNum) . "已存在</h3>";
            }
            ?>
        </tr>
        <tr>
            <td>
                <input type="submit" value="新增">
                <input type="reset" value="重置">
            </td>
        </tr>
    </table>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#item").change(function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $("#preview").attr("src", e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>