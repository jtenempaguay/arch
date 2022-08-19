<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Item Checkout</title>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

</head>
<body>
    <div class="container">
        <div class="wrapper">
            <div class="sideNav">
                <a class="navActive" href="#">Check In / Check Out</a>
                <a href="itemsout.php">View All Checked-Out Items</a>
            </div>
            <div class="searchBox">
                <h3 class="text-center">Search Student</h3>
                <form class="searchForm" action= "index.php" method = 'POST'>
                    <div class ="formStyle">
                        <p class="text-center">
                        <label class="labelClass" for="studentName"></label>
                        </p>
                    </div>
                    <div class="flexDisplay">
                        <div class="inLine">
                            <input class="search-input" id="studentName" type ="text" name="studentName" />
                        </div>
                        <div class="inLine">
                            <button class ="search-btn" id="delBtn" type="clear" name ="searchStudent">Clear</button>
                        </div>  
                    </div>
                </form>
            </div>
                <div class="studentLoad" id="loadStudentDiv">
                    <?php 
                        include 'search.php';
                    ?>
                </div>
        </div>
    </div>
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>