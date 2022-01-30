<?php
include_once("connection.php");
$query = "SELECT id, label, parent FROM employee";
$result = mysqli_query($conn, $query) or die("database error:" . mysqli_error($conn));
$menus = array(
    'items' => array(),
    'parents' => array()
);

while ($items = mysqli_fetch_assoc($result)) {
    $menus['items'][$items['id']] = $items;
    $menus['parents'][$items['parent']][] = $items['id'];
}

//print_r($menus);

if(isset($_POST['submit']))
    {
        $name = $_POST['label'];         
        $id = $_POST['parent'];          
        $sql_insert ="INSERT INTO `employee`(`label`, `parent`) VALUES ('$name','$id')" ;  
        if(mysqli_query($conn,$sql_insert))
        {
           header('Location: '.$_SERVER['PHP_SELF']);
        }
    }

function createMenu($parent, $menu)
{
    $list = "";
    if (isset($menu['parents'][$parent])) {
        $list .= '<ul>';
        foreach ($menu['parents'][$parent] as $itemId) {
            if (!isset($menu['parents'][$itemId])) {
                $list .= "<li>" . $menu['items'][$itemId]['label'] . "</li>";
            }
            if (isset($menu['parents'][$itemId])) {
                $list .= "<li>" . $menu['items'][$itemId]['label'];                
                $list .= "<ul>" . createMenu($itemId, $menu) . "</ul>";
                $list .= "</li>";
            }
        }
        $list .= "</ul>";
    }
    return $list;
}
