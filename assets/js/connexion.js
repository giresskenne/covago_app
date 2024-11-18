$(document).ready(function(){
   $("#contactForm").submit(function(e){
   e.preventDefault();
     $(".error").empty();
    var postData=$("#contactForm").serialize();
       alert(postData);
       $.ajax({
       type: 'POST',
        url: 'index.php?page=connexion_process',
        data: postData,
        dataType: 'json',
        success: function(result){
                     alert(result);
           },
           
       
       });
   });

   
})
//