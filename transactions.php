<?php 
    require 'include/dbconnect.php';
    $checkoutQuery = "SELECT s.emplid, p.name, p.number, p.id, c.transaction_id, c.date_checked_out,
                     c.date_checked_in, c.checked_out_by, c.checked_in_by, c.returned
                     FROM checkout c
                     INNER JOIN student s ON s.emplid = c.student_id_fk
                     INNER JOIN product AS p ON p.id = item_id_fk 
                     WHERE '".$student['emplid']."' = c.student_id_fk
                     AND c.returned = 0
                     ORDER BY c.transaction_id DESC
                     LIMIT 5";
     $checkstmt = $conn->prepare($checkoutQuery);
     $checkstmt->execute();
     $cResult = $checkstmt->get_result()->fetch_all(MYSQLI_ASSOC);
     $count = count($cResult);
     if(!$cResult) 
     { 
       echo "<div class='no-transactions'>";
       echo "<div>";

       
                echo "<h2 class='text-center'>Items</h2>";
                //echo "<form action='check.php'>"; don't remove comment
                include 'checkout.php';
                echo "</div>";
                echo "<button id=".$student['emplid']." class='c-btn'>Checkout</button>";
                echo "</div>";
                //echo "</form>"; don't remove comment
       
       $checkstmt->close();
     }
     else 
     {
      //echo "<div class='transactions'>";
      echo "<div class='transactionsGrid headers'>";
      echo "<div class='text-center'>Transaction Id</div>";
      echo "<div class='text-center'>Item Name</div>";
      echo "<div class='text-center'>Number</div>";
      echo "<div class='text-center'>Checkout Date</div>";
      echo "<div class='text-center'>Check-In Date</div>";
      echo "<div class='text-center'>Checked Out By</div>";
      echo "<div class='text-center'>Checked In By</div>";
      echo "<div class='text-center'>Action</div>";
      echo "</div>";
     foreach ($cResult as $transactions){
         if ($transactions['returned']=='0'){
            echo "<div class='transactionsGrid headers margintop-1'>";
            echo "<div class='text-center'>".$transactions['transaction_id']."</div>";
            echo "<div class='text-center'>".$transactions['name']."</div>";
            echo "<div class='text-center'>".$transactions['number']."</div>";
            echo "<div class='text-center'>".$transactions['date_checked_out']."</div>";
            echo "<div>";
            //echo "<form id='returnForm' action='return.php' method='POST'>";
            echo "<input type='hidden' name='transaction_id' id='transaction_id' value='".$transactions['transaction_id']."'/>";
            echo "<input type='hidden' name='emplid ".$transactions['transaction_id']."' id='t_Emplid ".$transactions['transaction_id']."' value='".$student['emplid']."'/>";
            echo "<input type='hidden' name='productID' id='tProductID ".$transactions['transaction_id']."' value='".$transactions['id']."'/>";
            echo "<input class='inputClass text-center' type='date' id='date_checked_in ".$transactions['transaction_id']."' name='date_checked_in' placeholder='yyyy-mm-dd' required/>";
            echo "</div>";
            echo "<div class='text-center'>".$transactions['checked_out_by']."</div>";
            echo "<div class='text-center'>";
            echo "<input type='text' id='checked_in_by ".$transactions['transaction_id']."' name='checked_in_by' maxlength='2' size='2' required />";
            echo "</div>";
            echo "<div class='text-center'>";
            echo "<button id='".$transactions['transaction_id']."' class='returnBtn'>Return</button>";
            echo "</div>";
            //echo "</form>";
            echo "</div>";
            echo "<div class='text-center margin-15' id='buttonModal'><button class='checkout-btn' id='btn-ck ".$student['emplid']."'>Checkout</button>";
                echo "<div id='checkoutModal' class='modal'>";
                echo "<div class='modal-content'>";
                echo "<div class='modal-header'>";
                echo "<span class='close'>&times;</span>";
                echo "</div>";
                echo "<div class='modal-body'>";
                echo "<h2 class='text-center'>Items Availible</h2>";
                //echo "<form action='check.php'>"; don't remove comment
                include 'checkout.php';
                echo "</div>";
                echo "<div class='modal-footer text-center'>";
                echo "<button id=".$student['emplid']." class='c-btn'>Checkout</button>";
                echo "</div>";
                //echo "</form>"; don't remove comment
                echo "</div>";
                echo "</div>";
                echo "</div>";
            
         }
 
     }
   
    }
    echo "</div>";
?>