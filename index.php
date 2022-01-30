<?php
include_once("function.php");
?>

	<form method="POST">
        <label>Label Name</label>
        <input type="text" name="label" required><br>
        <label>Select Parent</label>
        <select name="parent">
            <?php 
                foreach ($menus['items'] as $pid) {
            ?>
                <option value="<?php echo $pid["id"]; ?>"> <?php echo $pid["label"];  ?></option>
            <?php 
                }
            ?>
        </select>
        <br>
        <input type="submit" value="submit" name="submit">
    </form>


<?php echo createMenu(0, $menus); ?>
