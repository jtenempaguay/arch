<?php 
    require 'include/dbconnect.php';
    $errors = array();
    $alerts = array();

    //echo "<div class='mainStudentBox' id='mainBox'>";

if (!empty($_POST['searchStudent']))
{   
    $studentName = $_POST['searchStudent'];
    $studentName = stripcslashes($studentName);

    $studentQuery = "SELECT * FROM student WHERE firstname LIKE '%$studentName%' ";
    //$studentQuery .= "'%".$studentName."%' OR lastname LIKE '%".$studentName."%'";
    $stmt = $conn->prepare($studentQuery);
    //$stmt->bind_param('s', $studentName);
    $stmt->execute();
    $result = $stmt->get_result();
    $studentNames = $result->fetch_assoc();
    $stmt->close();


    if (count($errors) === 0)
    {
        echo "<div class='searchedStudents' id='test1'>";
        if (!$studentNames)
        {
            echo "<div class='errors'>";
            echo "<div class='text-center'>";
            echo "Please enter a valid name.";
            echo "<br>";
            echo "Hit the refresh button to update the database when necessary.";
            echo "</div>";
        }
        else
        {
            echo "<div class='studentBox' id='idStudentBox'>";
            echo "<div class='studentGrid border-btm'>";
            echo "<div><b>First Name</b></div>";
            echo "<div><b>Last Name</b></div>";
            echo "<div><b>Emplid</b></div>";
            echo "</div>";
            $sql = "SELECT * FROM student WHERE firstname LIKE '%$studentName%'";
            $holdStatus = "UPDATE student
            JOIN checkout
            ON student.emplid = checkout.student_id_fk
            SET student.hold = 'yes' 
            WHERE checkout.returned = '0'";
            $stmt2 = $conn->prepare($holdStatus);
            $stmt2->execute();
            $stmt = $conn->prepare($sql);
            //$stmt->bind_param('s', $studentName);
            $stmt->execute();
            $result2 = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            foreach ($result2 as $student) {
                echo "<div class='studentGrid ".$student['hold']. "' id='studentID'[".$student['emplid']."]>";
                echo "<div class='studentInfo'>".$student['firstname']."</div>";
                echo "<div class='studentInfo'>".$student['lastname']."</div>";
                echo "<div class='studentInfo'>".$student['emplid']."</div>";
                echo "</div>";
                echo "<div class='transactions'>";
                include 'transactions.php';
                /*echo "<div class='text-center margin-15' id='buttonModal'><button class='checkout-btn' id='btn-ck ".$student['emplid']."'>Checkout</button>";
                echo "<div id='checkoutModal' class='modal'>";
                echo "<div class='modal-content'>";
                echo "<div class='modal-header'>";
                echo "<span class='close'>&times;</span>";
                echo "</div>";
                echo "<div class='modal-body'>";
                echo "<h2 class='text-center'>Items".$student['emplid']."</h2>";
                //echo "<form action='check.php'>"; don't remove comment
                include 'checkout.php';
                echo "</div>";
                echo "<div class='modal-footer text-center'>";
                echo "<button id=".$student['emplid']." class='c-btn'>Checkout</button>";
                echo "</div>";
                //echo "</form>"; don't remove comment
                echo "</div>";
                echo "</div>";
                echo "</div>";*/
                //echo "</div>";
            }  
            echo "</div>";     
        }
        echo "</div>";
    }
}
else {
    echo "<div class='studentsOnHold'>";
    $sql0 = "SELECT * FROM student WHERE hold = 'yes'";
    $stmt0 = $conn->prepare($sql0);
    //$stmt->bind_param('s', $studentName);
    $stmt0->execute();
    $result0 = $stmt0->get_result()->fetch_all(MYSQLI_ASSOC);
    foreach ($result0 as $student) {
    echo "<div class='studentGrid onHold' id='studentID'[".$student['emplid']."]>";
                echo "<div class='studentInfo'>".$student['firstname']."</div>";
                echo "<div class='studentInfo'>".$student['lastname']."</div>";
                echo "<div class='studentInfo'>".$student['emplid']."</div>";
                echo "</div>";
                echo "<div class='transactions'>";
                include 'transactions.php';
    }
    echo "</div>";
}
//echo "</div>";

?>
