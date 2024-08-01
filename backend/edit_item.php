<h3>更換圖片</h3>
<?php
include_once "../api/base.php";
$item = $_GET;
$data = $Pictures->find($item['id']);
$file = "../images/" . $data['item'];
?>
<hr>
<form action="../api/edit_item.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td style="width:50%;">
                圖片 : <img src="<?= $file; ?>" alt="" id="preview" style="width: 30%;">
            </td>
            <td><input type="file" name="file" id="fileInput"></td>
            <td><input type="number" name="order_id" readonly value="<?= $data['order_id']; ?>"></td>
            <td><input type="hidden" name="id" value="<?= $data['id']; ?>"></td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="更換">
                <input type="reset" value="重置">
            </td>
        </tr>
    </table>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#fileInput").change(function() {
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