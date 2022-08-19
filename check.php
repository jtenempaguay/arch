<?php 
require 'include/dbconnect.php';

    $itemsID = $_POST['postselectItem'];
    $studentEMPLID = $_POST['postEMPLID'];
    $checkedOutBy = $_POST['postCheckoutBy'];
    var_dump($itemsID);
    parse_str($checkedOutBy,$newcheckedOutBy);
    //var_dump($newcheckedOutBy);
    foreach ($newcheckedOutBy as $intial => $intials){
        foreach ($intials as $insertedValue) {
            if($insertedValue!=''){
                $Cintials = $insertedValue;
                //echo "Your intials: ".$Cintials;
            }
        }
    }
    echo "Your intials: ".$Cintials;
    echo "</br>";
    foreach ($itemsID as $key => $value) {
        //echo $value." ";
        $query = $conn->prepare("INSERT INTO checkout (item_id_fk, student_id_fk, checked_out_by) VALUES (".$value.", '$studentEMPLID', '$Cintials')");
        $transaction_id = $conn->insert_id;
        if ($query->execute()) {
        header('location: index.php');
        $updateProduct = "UPDATE product SET qty = '0' WHERE id = ".$value."";
        $stmt2 = $conn->prepare($updateProduct);
        $stmt2->execute();
        }
    }

?>