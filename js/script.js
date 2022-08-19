
 


jQuery(document).ready(function() {
   
    preventEnter(); //prevent user from pressing enter keyword
    var searchStudent = $('#studentName');

    //$("#studentName").val("");
    searchStudent.keyup(function() {
        searchStudentFun(searchStudent); 
    });
});

function preventEnter(){
$(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
}

    
function searchStudentFun() {

    var searchStudent = $('#studentName');
  //Below here keyup code
    //searchStudent.keyup(function() {
        var name = searchStudent.val();
        //Assigning search box value to javascript variable named as "name".
        //Validating, if "name" is empty.
       
            //AJAX is called.
            $.ajax({
 
                type: "POST",
   
                url: "search.php",
              
                data: {

                    searchStudent: name
                },
                //If result found, this funtion will be called.
                success: function(html) {
                    //Assigning result to "display" div in "search.php" file.
                    //$(".studentsOnHold").hide();
                    $(".studentLoad").html(html).show();
                    $(".no").addClass('noHold');
                    $(".yes").addClass('onHold');
                    $(".studentGrid").click(function(e) {
                        var studentID = this.id;
                        if (studentID != ''){
                        e.preventDefault();
                        $(this).next().slideToggle("slow");
                        }
                
                    });
                    getItems2();
                    returnItem();
                }
                
            });
        
   // });
}


function testThis() {
var modalsTest = document.getElementsByClassName('checkout-btn');
for (var i = 0; i < modalsTest.length; i++) {
    modalsTest[i].addEventListener('click',redirect,false);
}
function redirect(e){
    alert(e.target.id);
}
}

function modalT() {
    var modalTest = document.getElementsByClassName("checkout-btn")
    modalTest[0].addEventListener("click", function() {alert(modalTest)});

    /*function doSomething(e) {
     if (e.target !== e.currentTarget) {
            var clickedItem = e.target.id;
            alert("Hello " + clickedItem);
        }
        e.stopPropogation();
    }*/
}

    function getModal() {   
        var modals = document.getElementsByClassName('modal');
        var modalBody = document.getElementsByClassName("modal-content");
        // Get the button that opens the modal
        var btns = document.getElementsByClassName("checkout-btn");
        var spans = document.getElementsByClassName("close");
        
        for(let i=0;i<btns.length;i++){
        
        /*btns[i].onclick = function() {*/
            btns[i].addEventListener("click", function(e) { 
                e.stopImmediatePropagation(); modals[i].style.display = "block";
               
        /*$(modals[i]).addClass("showModal");*/});
            /*modals[i].style.display = "block";*/
        /* }*/
        }

        for(let i=0;i<spans.length;i++){
            
            spans[i].addEventListener("click", function(e) { e.stopImmediatePropagation(); //$(modalBody[i]).stop().hide(500);
                modals[i].style.display = "none";
            //$(modals[i]).addClass("modalHidden");   
        
            
                //$(modals[i]).removeClass("showModal");
                
        });
        window.onclick = function(event) {
            if (event.target == modals[i]) {
                modals[i].style.display = "none";
            }
        }
        
        /* spans[i].onclick = function() {
            //modals[i].classList.add('modal-fade');
            modals[i].style.display = "none";
            }/*
            window.onclick = function(event) {
            if (event.target == modals[i]) {
                modals[i].style.display = "none";
            }
            }*/
        }
        
    }

     // checkout item
     function getItems() {
     $(".itemDiv").click(function () {
      $(this).toggleClass("selected");  
      });

      $(".c-btn").click(function () {
          var selected_activities =$(".selected");
         // var studentID = $(".student_eID").attr('id');
          var ids = [];
          selected_activities.each(function(){
                var id_str   =  this.id;
                var id_arr	  =	 id_str.split("_");
                var selval       =  id_arr[0];
              if(selval!='undefined' && selval!='' && selval!=null){
                  ids.push(selval);
              }
          });

        
          var selectItem = ids;
          var student_emplid = this.id;
          var checkoutBy = $('input[name^="checkedBy[]"]').serialize();
          //var checkoutBy = $("#checkedBy").val();
         // alert(checkoutBy);
        
         $.post('check.php', {postselectItem:selectItem, postEMPLID:student_emplid, postCheckoutBy:checkoutBy}, function (response) {
            //alert(response);
         // });
         // alert(ids);
          $(".itemDiv").removeClass("selected");
          location.reload(true);
          //ids.empty();
        });
      });
    }

    function getItems2() {
        var searchStudent = $('#studentName').val();
        $(".itemDiv").click(function () {
         $(this).toggleClass("selected");  
         });
   
         $(".c-btn").click(function () {
            //.preventDefault();
             var selected_activities =$(".selected");
            // var studentID = $(".student_eID").attr('id');
             var ids = [];
             selected_activities.each(function(){
                   var id_str   =  this.id;
                   var id_arr	  =	 id_str.split("_");
                   var selval       =  id_arr[0];
                 if(selval!='undefined' && selval!='' && selval!=null){
                     ids.push(selval);
                 }
             });

             var selectItem = ids;
             var student_emplid = this.id;
             var checkoutBy = $('input[name^="checkedBy[]"]').serialize();
             $.ajax({

                //AJAX type is "Post".
                type: "POST",
                //Data will be sent to "ajax.php".
                url: "check.php",
                //Data, that will be sent to "ajax.php".
                data: {
                    //Assigning value of "name" into "search" variable.
                    postselectItem:selectItem, 
                    postEMPLID:student_emplid, 
                    postCheckoutBy:checkoutBy
                },
                //If result found, this funtion will be called.
                success: function() {
                    //Assigning result to "display" div in "search.php" file.
                    $(".itemDiv").removeClass("selected");
                    $("#loadStudentDiv").load(" #loadStudentDiv > *");
                    //$("#loadStudentDiv").load(location.url+" #loadStudentDiv>*","");
                    //location.reload(true);
                    searchStudentFun(searchStudent);
              
                }
            });
           
      
         });
       }

function returnItem() {

    var searchStudent = $('#studentName').val();
    
    $(".returnBtn").click (function(e) { e.stopImmediatePropagation(); //$(modalBody[i]).stop().hide(500);
        
        var transID = this.id;
        var t_Emplid = document.getElementById('t_Emplid '+transID);
        var tProductID = document.getElementById('tProductID '+transID);
        var tdate_checked_in = document.getElementById('date_checked_in '+transID);
        var tchecked_in_by = document.getElementById('checked_in_by '+transID);
        t_Emplid = t_Emplid.value;
        tProductID = tProductID.value;
        tdate_checked_in = tdate_checked_in.value;
        tchecked_in_by = tchecked_in_by.value;
        
        $.ajax({
            
            type: "POST",
            
            url: "return.php",

            data: {
                    transaction_id:transID,
                    emplid:t_Emplid,
                    productID:tProductID,
                    date_checked_in:tdate_checked_in,
                    checked_in_by:tchecked_in_by
            },
            success: function() {
                //Assigning result to "display" div in "search.php" file.
                $("#loadStudentDiv").load(" #loadStudentDiv > *");
                searchStudentFun(searchStudent);
            }
        });

    });

   
}

    function clearStudent (){

  var searchStudent = $('#studentName');

    
    var checkName = searchStudent.val();
    if (checkName == "") {
        //Assigning empty value to "display" div in "search.php" file.
        $.ajax({
            //AJAX type is "Post".
            type: "POST",
            //Data will be sent to "ajax.php".
            url: "search.php",
            //Data, that will be sent to "ajax.php".
            data: {
                //Assigning value of "name" into "search" variable.
                searchStudent: checkName
            },
            //If result found, this funtion will be called.
            success: function(html) {
                //Assigning result to "display" div in "search.php" file.
                $(".studentsOnHold").html(html).show();
                $(".studentBox").hide();
            }
             });
    }
 
    }


