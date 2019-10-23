$("#orders").on("click","a",function(e) {
    e.preventDefault();
    $(this).closest("tr").nextUntil(".parent").slideToggle("slow");
    if($(this).text() == 'צפייה במוצרי ההזמנה'){
           $(this).text('סגור פרטי מוצרים');
       } else {
           $(this).text('צפייה במוצרי ההזמנה');
       }
});


function changeOrderStatus(orderId,status){
    var request=new XMLHttpRequest();
    
    if(status=="accepted"){
        var stat="התקבלה";
    }
    if(status=="preparation"){
        var stat="בהכנה";
    }
    if(status=="completed"){
        var stat="הסתיימה";
    }
    
    request.onreadystatechange=function(){
        if (request.readyState==4 & request.status==200){
            var myObj = JSON.parse(this.responseText);
            window.location.href = "index.php";
        }
    }
  
    request.open("POST",'../includes/change_order_status.php',true);
    request.setRequestHeader('Content-type','application/json');
    var user_data = { 
      "orderId" : orderId,
      "status": stat
    }
    
    var data= JSON.stringify(user_data);
    request.send(data);
}