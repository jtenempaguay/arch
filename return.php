<?php 
require 'include/dbconnect.php';


    $transactionID = $_POST['transaction_id'];
    $studentID = $_POST['emplid'];
    $productID = $_POST['productID'];
    $checkInDate = $_POST['date_checked_in'];
    $checkInBy = $_POST['checked_in_by'];

        $return_query = "UPDATE checkout, product SET checkout.date_checked_in = '$checkInDate', 
                        checkout.checked_in_by = '$checkInBy', checkout.returned = '1', product.qty = '1' 
                        WHERE checkout.transaction_id = '$transactionID' 
                        AND checkout.student_id_fk = '$studentID' 
                        AND product.id = '$productID'";
    
        $stmt = $conn->prepare($return_query);
        if ($stmt->execute()) 
        {
            header('location: index.php');
            $alerts['returned'] = "Item Succesfully Returned";
            $alerts['alert-class'] = "alert-success";
            $checkHold = "SELECT * FROM checkout WHERE returned = '0' AND student_id_fk = $studentID LIMIT 1";
            $stmt2 = $conn->prepare($checkHold);
            $stmt2->execute();
            $Hresult = $stmt2->get_result();
            $returnCount = $Hresult->num_rows;
            $stmt2->close();

            if ($returnCount == 0)
                {
                    $holdStatus = "UPDATE student
                    SET student.hold = 'no'
                    WHERE emplid = $studentID";
                    $stmt2 = $conn->prepare($holdStatus);
                    $stmt2->execute();

                }
           
            exit();
                }
                else
                {
                    $errors['db_error'] = "Failed to checkout";
                }

?>