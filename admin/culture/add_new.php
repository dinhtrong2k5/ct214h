<?php
include("../../includes/db-connect.php");
?>

<form method="POST">

    <input name="title" placeholder="Title"><br>
    <input name="slug" placeholder="Slug"><br>
    <input name="event_date" type="date"><br>
    <input name="location" placeholder="Location"><br>

    <select name="culture_category_id">
        <?php
        $cats = $conn->query("SELECT * FROM culture_categories");
        while ($c = $cats->fetch_assoc()) {
        ?>
            <option value="<?= $c['culture_category_id'] ?>">
                <?= $c['name'] ?>
            </option>
        <?php } ?>
    </select><br>

    <textarea name="content"></textarea><br>

    <select name="status">
        <option value="1">Active</option>
        <option value="0">Hidden</option>
    </select>

    <button name="add">Save</button>

</form>

<?php
if (isset($_POST['add'])) {

    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $date = $_POST['event_date'];
    $loc = $_POST['location'];
    $content = $_POST['content'];
    $cat = (int)$_POST['culture_category_id'];
    $status = (int)$_POST['status'];

    $conn->query("
INSERT INTO cultures(title,slug,event_date,location,content,culture_category_id,status)
VALUES('$title','$slug','$date','$loc','$content',$cat,$status)
");

    echo "<script>alert('Added');location='list.php';</script>";
}
?>