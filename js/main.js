$(document).ready(function() {
    
    
    
    
    
    $(".menu-icon").on("click", function() {
          $("nav ul").toggleClass("showing");
    });
    
});

        jQuery(document).ready(function(){
    // This button will increment the value
    $('[data-quantity="plus"]').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('data-field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
    // This button will decrement the value till 0
    $('[data-quantity="minus"]').click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('data-field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
});


// Scrolling Effect

$(window).on("scroll", function() {
    if($(window).scrollTop()) {
          $('nav').addClass('black');
    }

    else {
          $('nav').removeClass('black');
    }
})

// owl

$('.owl-carousel').owlCarousel({
    loop:true,
    margin:0,
    nav:false,
    autoplay:true,
    lazyLoad: true,
    dots:false,
    autoplayTimeout:2500,
    autoplayHoverPause:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})

$(document).ready(function(){
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});


function login(){
                var request=new XMLHttpRequest();
    
                request.onreadystatechange=function(){
                    if (request.readyState==4 & request.status==200){
                        var myObj = JSON.parse(this.responseText);
                        if (myObj.code == 1)
                            window.location.href = "../index.php";
                        else
                            document.getElementById("loginError1").innerHTML=myObj.loginError;
                    }
                }
                
                request.open("POST",'../includes/include/LoginPHP.php',true);
                request.setRequestHeader('Content-type','application/json');
                var user_data = { 
                  "userName" : document.getElementById("userName").value,
                  "password": document.getElementById("password").value,
                  "rememberMe": document.getElementById("remember").checked,
                }
                
                var data= JSON.stringify(user_data);
                request.send(data);
            }
            
            function goBack() {
  window.history.back();
}

function addProductToCart(productId,username){
    var request=new XMLHttpRequest();
    
                request.onreadystatechange=function(){
                    if (request.readyState==4 & request.status==200){
                        var myObj = JSON.parse(this.responseText);
                        if(myObj.code=="3"){
                            $('#add-to-cart-modal').modal('show');
                        }
                        else if(myObj.code=="2"){
                             $('#not-in-stock-modal').modal('show');
                        }
                        else if(myObj.code=="1"){
                             $('#on-cart-modal').modal('show');
                        }
                        
                        
                    }
                }
              
              var amountValue = "quantity" + productId.toString();
              
                request.open("POST",'../includes/include/add_product_to_cart.php',true);
                request.setRequestHeader('Content-type','application/json');
                var user_data = { 
                  "userName" : username,
                  "productId": productId,
                  "amount": document.getElementById(amountValue).value
                }
                
                var data= JSON.stringify(user_data);
                request.send(data);
            }
            
function pleaseLogInShowModal(){
    $('#not-login-modal').modal('show');
}

function removeFromShoppingCart(productId,username){
      var request=new XMLHttpRequest();
    
                request.onreadystatechange=function(){
                    if (request.readyState==4 & request.status==200){
                        var myObj = JSON.parse(this.responseText);
                        window.location.href = "my_shopping_cart.php";
                    }
                }
              
                request.open("POST",'../includes/include/remove_product_from_cart.php',true);
                request.setRequestHeader('Content-type','application/json');
                var user_data = { 
                  "userName" : username,
                  "productId": productId
                }
                
                var data= JSON.stringify(user_data);
                request.send(data);
}

function removeFromOrderCart(productId,username){
      var request=new XMLHttpRequest();
    
                request.onreadystatechange=function(){
                    if (request.readyState==4 & request.status==200){
                        var myObj = JSON.parse(this.responseText);
                        window.location.href = "submit_order.php";
                    }
                }
              
                request.open("POST",'../includes/include/remove_product_from_cart.php',true);
                request.setRequestHeader('Content-type','application/json');
                var user_data = { 
                  "userName" : username,
                  "productId": productId
                }
                
                var data= JSON.stringify(user_data);
                request.send(data);
}


function changeAmount(id){
    var request=new XMLHttpRequest();
    
                request.onreadystatechange=function(){
                    if (request.readyState==4 & request.status==200){
                        var myObj = JSON.parse(this.responseText);
                        window.location.href = "my_shopping_cart.php";
                    }
                }
              
                request.open("POST",'../includes/include/change_product_amount.php',true);
                request.setRequestHeader('Content-type','application/json');
                var user_data = { 
                  "productInCartId" : id,
                  "amount": document.getElementById(id).value
                }
                
                var data= JSON.stringify(user_data);
                request.send(data);
    
}

function changeAmountOnOrder(id){
    var request=new XMLHttpRequest();
    
                request.onreadystatechange=function(){
                    if (request.readyState==4 & request.status==200){
                        var myObj = JSON.parse(this.responseText);
                        window.location.href = "submit_order.php";
                    }
                }
              
                request.open("POST",'../includes/include/change_product_amount.php',true);
                request.setRequestHeader('Content-type','application/json');
                var user_data = { 
                  "productInCartId" : id,
                  "amount": document.getElementById(id).value
                }
                
                var data= JSON.stringify(user_data);
                request.send(data);
    
}


function selectedTypeDeliverySection() {
    if (document.getElementById("self_type").checked) {
        document.getElementById("self").style.display = "block";
        document.getElementById("delivery").style.display = "none";
    }
   
    if (document.getElementById("delivery_type").checked) {
        document.getElementById("delivery").style.display = "block";
        document.getElementById("self").style.display = "none";
        
    }
    
}

$("#orders").on("click","a",function(e) {
    e.preventDefault();
    $(this).closest("tr").nextUntil(".parent").toggle("slow");
    if($(this).text() == 'לחץ לצפייה במוצרי ההזמנה'){
           $(this).text('סגור פרטי מוצרי הזמנה');
       } else {
           $(this).text('לחץ לצפייה במוצרי ההזמנה');
       }
});


function payByCreditCard(){
	var credit = document.getElementById("cardNumber").value;
	var cvc = document.getElementById("cardCVC").value;
	var mm = document.getElementById("MM").value;
	var yy = document.getElementById("YY").value;
	var id = document.getElementById("payerId").value;
	
	if(credit == ""){
		document.getElementById("demo").innerHTML = "אנא הכנס מספר כרטיס אשראי";
	}
	else if(isNaN(credit)){
		document.getElementById("demo").innerHTML = "אנא הזן מספרים בלבד";
	}
	else if(mm == "" || yy == ""){
		
		document.getElementById("demo").innerHTML = "אנא הכנס תוקף"
  }
  else if(mm  != "01" && mm != "02" && mm != "03" && mm != "04" && mm != "05" && mm != "06" && mm != "07" && mm != "08" && mm != "09" && mm != "10" && mm != "11" && mm != "12"){
		
		document.getElementById("demo").innerHTML = "אנא הכנס חודש תקין"
	}
	else if(isNaN(mm) || isNaN(yy)){
		document.getElementById("demo").innerHTML = "אנא הזן מספרים בלבד"
	}
	else if(cvc == ""){
		document.getElementById("demo").innerHTML = "אנא הכנס קוד CVC";
  }
  else if(cvc.length!=3){
		document.getElementById("demo").innerHTML = "קוד CVC צריך לכלול 3 ספרות";
	}
	else if(isNaN(cvc)){
		document.getElementById("demo").innerHTML = "אנא הזן מספרים בלבד";
	}
	else if(id == ""){
		document.getElementById("demo").innerHTML = "אנא הכנס תעודת זהות";
	}
	else if(isNaN(id)){
		document.getElementById("demo").innerHTML = "אנא הזן מספרים בלבד";
	}
	else{
		document.getElementById("demo").innerHTML = "";
		var url_string = window.location.href;
		var url = new URL(url_string);
		var orderId = url.searchParams.get("orderId");
		window.location = '../includes/order_final.php?orderId=' + orderId;
	}
  }

function payForOrder(totalPayment){
    
    if(!document.getElementById("self_type").checked && !document.getElementById("delivery_type").checked){
        document.getElementById("order_error_message").innerHTML="אנא בחר סוג משלוח";
    }
    else if(!document.getElementById("creditCard").checked && !document.getElementById("payPal").checked){
        document.getElementById("order_error_message").innerHTML="אנא בחר סוג תשלום";
    }
    else{
        document.getElementById("order_error_message").innerHTML="";
    }
    
    if(document.getElementById("self_type").checked){
        var fullName=document.getElementById("fullNameSelf").value;
        var phone=document.getElementById("phoneSelf").value;
        var notes=document.getElementById("notesSelf").value;
        
        var request=new XMLHttpRequest();
    
        request.onreadystatechange=function(){
            if (request.readyState==4 & request.status==200){
                var myObj = JSON.parse(this.responseText);
                if (myObj.code == 1){
                    if(document.getElementById("creditCard").checked){
            	        window.location = '../includes/pay_with_creditCard.php?totalPay=' + totalPayment + '&orderId='+ myObj.orderId;
                    }
                    else if(document.getElementById("payPal").checked){
                        window.location = '../includes/payByPayPal.php?totalPay=' + totalPayment + '&orderId='+ myObj.orderId;
                    }
                }
            }
        }
      
        request.open("POST",'../includes/include/pay_for_order.php',true);
        request.setRequestHeader('Content-type','application/json');
        var user_data = { 
          "fullName" : fullName,
          "phone": phone,
          "notes": notes,
          "totalPayment": totalPayment,
          "deliveryType": "איסוף עצמי",
          "address": ""
        }
        
        var data= JSON.stringify(user_data);
        request.send(data);

        
        
         
    }
    else if(document.getElementById("delivery_type").checked){
        var fullName=document.getElementById("fullNameDelivery").value;
        var phone=document.getElementById("phoneDelivery").value;
        var address=document.getElementById("addressDelivery").value;
        var notes=document.getElementById("notesDelivery").value;
        
        var request=new XMLHttpRequest();
    
        request.onreadystatechange=function(){
            if (request.readyState==4 & request.status==200){
                var myObj = JSON.parse(this.responseText);
                if (myObj.code == 1){
                    if(document.getElementById("creditCard").checked){
            	        window.location = '../includes/pay_with_creditCard.php?totalPay=' + totalPayment + '&orderId='+ myObj.orderId;
                    }
                    else if(document.getElementById("payPal").checked){
                        window.location = '../includes/payByPayPal.php?totalPay=' + totalPayment + '&orderId='+ myObj.orderId;
                    }
                }
            }
        }
      
        request.open("POST",'../includes/include/pay_for_order.php',true);
        request.setRequestHeader('Content-type','application/json');
        var user_data = { 
          "fullName" : fullName,
          "phone": phone,
          "notes": notes,
          "totalPayment": totalPayment,
          "deliveryType": "משלוח",
          "address": address
        }
        
        var data= JSON.stringify(user_data);
        request.send(data);
        
        
    }
   
    
}


function cancelOrder(orderId){
    var request=new XMLHttpRequest();
    
    
    request.onreadystatechange=function(){
        if (request.readyState==4 & request.status==200){
            var myObj = JSON.parse(this.responseText);
            window.location.href = "my_orders.php";
        }
    }
  
    request.open("POST",'../backoffice/includes/change_order_status.php',true);
    request.setRequestHeader('Content-type','application/json');
    var user_data = { 
      "orderId" : orderId,
      "status": "בוטלה"
    }
    
    var data= JSON.stringify(user_data);
    request.send(data);
}


function getInStock(){
    
    var productName=document.getElementById("getInStock").value;
    
    var request=new XMLHttpRequest();
    
    
    request.onreadystatechange=function(){
        if (request.readyState==4 & request.status==200){
            var myObj = JSON.parse(this.responseText);
            document.getElementById("amount_to_fill").innerHTML=myObj.code;
            
        }
    }
  
    request.open("POST",'include/get_amount_in_stock.php',true);
    request.setRequestHeader('Content-type','application/json');
    var user_data = { 
      "productName" : productName
    }
    
    var data= JSON.stringify(user_data);
    request.send(data);
}
