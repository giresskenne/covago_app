$(document).ready(function(){
   $("#msform").submit(function(e){
   e.preventDefault();
   $(".coments").empty();   
   var postData = $("#msform").serialize();
       alert(postData);
       $.ajax({
       type: 'POST',
       url: 'index.php?page=registrationProcess',
       data: postData,
       dataType: 'json',
       success: function(result){
           //alert(result);
       },
       error: function(result){
           alert(result);
       }
        
       });
   });
})