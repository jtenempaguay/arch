<?php 
require 'include/dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Items Out</title>
</head>
<body>
    <div class="container">
        <div class="sideNav">
            <a href="index.php">Check In / Check Out</a>
            <a class="navActive" href="#">View All Checked-Out Items</a>
        </div>
        <div class="itemsOut-wrapper">
            <?php
    
            $itemsOut = "SELECT s.firstname, s.lastname, p.name, p.number, p.id, c.transaction_id, c.date_checked_out,
            c.date_checked_in, c.checked_out_by, s.emplid, c.checked_in_by, c.returned
            FROM checkout c
            INNER JOIN student s ON s.emplid = c.student_id_fk
            INNER JOIN product AS p ON p.id = item_id_fk
            WHERE returned = 0";
            $stmt = $conn->prepare($itemsOut);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if(!$result) 
            {
                echo "<div class='errors-empt'>";
                echo "<div class='text-center'>";
                echo "No Items Are Currently Checked Out";
                echo "</div>";
                echo "</div>";
                exit();
            }
            else 
            {
                echo "<div class='itemsOut border-btm'>";
                echo "<div class='text-center'>Transaction ID</div>";
                echo "<div class='text-center'>Item Name</div>";
                echo "<div class='text-center'>Item Number</div>";
                echo "<div class='text-center'v>Date Checkout Out</div>";
                echo "<div class='text-center'>Student Name</div>";
                echo "<div class='text-center'>Emplid</div>";
                echo "</div>";
                $count = count($result);
                foreach ($result as $transactions) {
                    echo "<div class='itemsOut'>";
                    echo "<div class='text-center'>".$transactions['transaction_id']."</div>";
                    echo "<div class='text-center'>".$transactions['name']."</div>";
                    echo "<div class='text-center'>".$transactions['number']."</div>";
                    echo "<div class='text-center'>".$transactions['date_checked_out']."</div>";
                    echo "<div class='text-center'>".$transactions['firstname']." ".$transactions['lastname']."</div>";
                    echo "<div class='text-center'>".$transactions['emplid']."</div>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>