$(document).ready(function () {
	$.ajax({
		type: "GET",
		url: "../includes/getCustomers.php",
		datatype: "JSON",
		success: function (data) {
			var data = JSON.parse(data);
			
				var tr = $("<tr>");
				tr.addClass("text-center");
				tr.addClass("text-bold");
				var num = $("<td>");
				var fullname = $("<td>");
				var username = $("<td>");
				var email = $("<td>");
				var phone = $("<td>");
                var address = $("<td>");
				var gender = $("<td>");
                var yearOfBirth = $("<td>");
                
				num.append("#");
				fullname.append("שם מלא");
				username.append("שם משתמש");
                email.append("אימייל");
				phone.append("טלפון");
				address.append("כתובת");
				gender.append("מין");
                yearOfBirth.append("שנת לידה");
				
			
				tr.append(num);
				tr.append(fullname);
				tr.append(username);
				tr.append(email);
				tr.append(phone);
                tr.append(address);
				tr.append(gender);
				tr.append(yearOfBirth);
				$('tbody').append(tr);
			for (var i = 0; i < data.length; i++) {
				var jsonObj = data[i];
				var tr = $("<tr>");
				tr.addClass("text-center");
				var num = $("<td>");
				var fullname = $("<td>");
				var username = $("<td>");
				var email = $("<td>");
				var phone = $("<td>");
                var address = $("<td>");
				var gender = $("<td>");
                var yearOfBirth = $("<td>");
				num.append(++i);
				i--;
				
				fullname.append(jsonObj.fullName);
				username.append(jsonObj.username);
				email.append(jsonObj.email);
                phone.append(jsonObj.user_phone);
				address.append(jsonObj.address);
				if(jsonObj.gender=="female"){
				    gender.append("נקבה");
				}
				else{
				     gender.append("זכר");
				}
			
                yearOfBirth.append(jsonObj.yearOfBirth);
				
			
				tr.append(num);
				tr.append(fullname);
				tr.append(username);
				tr.append(email);
				tr.append(phone);
                tr.append(address);
				tr.append(gender);
				tr.append(yearOfBirth);
				$('tbody').append(tr);
			}
		}
	});
});