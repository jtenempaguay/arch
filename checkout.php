<?php 
require 'include/dbconnect.php';
echo "<h3>Scissors</h3>";
$query = "SELECT id, name, number, location, qty FROM product WHERE name = 'Scissor' 
          AND qty > 0";
$stmt = $conn->prepare($query);
$stmt->execute();
$itemsResult = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$count = count($itemsResult);
if ($count === 0) 
{ 
    echo "No Items Available";
    $stmt->close();
}
if ($count != 0 )
{
    foreach ($itemsResult as $items){
        echo "<div class='itemDiv' id='".$items['id']."'>";
        echo '<img class="itemIMG" src="images/scissor.png" alt="car icon" height="45" width="45"/>';
        echo "<p>".$items['number']."</p>";
        echo "</div> ";
    }
}
echo "<h3>Glue</h3>";
$query2 = "SELECT id, name, number, location, qty FROM product WHERE name = 'Glue' 
          AND qty > 0";
$stmt2 = $conn->prepare($query2);
$stmt2->execute();
$itemsResult2 = $stmt2->get_result()->fetch_all(MYSQLI_ASSOC);
$count2 = count($itemsResult2);
if ($count2 === 0)
{ 
    echo "No Items Available";
    $stmt2->close();
}
if ($count2 != 0){
    foreach ($itemsResult2 as $items){
        echo "<div class='itemDiv' id='".$items['id']."'>";
        echo '<img class="itemIMG" src="images/scissor.png" alt="car icon" height="45" width="45"/>';
        echo "<p>".$items['number']."</p>";
        echo "</div> ";
    }
}
echo "<div class='text-center'>";
echo "<label for='checkedBy'>Checked out By: </label>";
echo "<input type='text' name='checkedBy[]' maxlength='2' size='2' required />";
echo "</div>";

?>