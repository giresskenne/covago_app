$(document).ready(function (){
$(".next1").click(function(e){
e.preventDefault();
$("label").css("color","black");
$("#oblig").css("color","red");  
var succes=false;
succes=true;
var dateTravel= $("#dateTravel").val ();
var heureDep= $("#heureDep").val ();
var nbPlaces= $("#nbPlaces").val ();
     if(dateTravel==""){
    $(".dateTravel").css ("display","flex"); 
    succes=false;
     }
     else{
     $(".dateTravel").css ("display","none");     
     succes=true;
     }
     
      
    if(heureDep==""){
     $(".heureDep").css ("display","flex"); 
    succes=false;
     }
     else{
     $(".heureDep").css ("display","none");     
     succes=true;
     }
     
     
      if(nbPlaces==""){
         $(".nbPlaces").css ("display","flex");  
         succes=false;
     }
     else{
     $(".nbPlaces").css ("display","none");     
     succes=true;
     }
     
     if(succes==true){
        $(".form-card0").hide (); 
        $(".form-card1").show (); 
        alert("fine thanks and you"+ dateTravel+nbPlaces+heureDep); 
     }
 }); 
$(".next2").click(function (e){
    e.preventDefault();
     succes=true;
var immat= $("#immat").val ();
var marque= $("#marque").val ();
var model= $("#model").val ();
var couleur= $("#couleur").val ();
     if(immat==""){
    $(".immat").css ("display","flex"); 
    succes=false;
     }
     else{
     $(".immat").css ("display","none");     
     succes=true;
     }
     
     
    if(marque==""){
     $(".marque").css ("display","flex"); 
    succes=false;
     }
     else{
     $(".marque").css ("display","none");     
     succes=true;
     }
     
     
     if(model==""){
         $(".model").css ("display","flex");  
         succes=false;
     }
     else{
     $(".model").css ("display","none");     
     succes=true;
     }
    
    if(couleur==""){
         $(".couleur").css ("display","flex");  
         succes=false;
     }
     else{
     $(".couleur").css ("display","none");     
     succes=true;
     }
     
     if(succes==true){
        e.preventDefault();
        $(".form-card1").hide (); 
        $(".form-card2").show (); 
        $(".photo_1").css ("display","none");
        $(".photo_2").css ("display","none");
        $(".photo_3").css ("display","none");
        var photo_1= $("#photo_1").val ();
        var photo_2= $("#photo_2").val ();
        var photo_3= $("#photo_3").val ();
        if (photo_1=="") {
            $(".photo_1").css ("display","flex");  
            succes=false;
        }
        else{
            $(".photo_1").css ("display","none");  
            succes=true;
        }
        
       /* if (photo_2=="") {
            $(".photo_2").css ("display","flex");  
            succes=false;
        }
        else{
            $(".photo_2").css ("display","none");  
            succes=true;
        }

        if (photo_3=="") {
            $(".photo_3").css ("display","flex");  
            succes=false;
        }
        else{
            $(".photo_3").css ("display","none");  
            succes=true;
        }*/
         //index.php?page=post_process
         /*var postData=$("#msform").serialize();
         alert(postData);
       $.ajax({
       type: 'POST',
        url: 'index.php?page=post_process',
        data: postData,
        dataType: 'json',
        success: function(result){
           alert("result");
           }
       });   */
     }
 });
    
})