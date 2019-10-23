$(document).ready(function () {
	$.ajax({
		type: "GET",
		url: "../includes/mashovim.php",
		datatype: "JSON",
		success: function (data) {
			var data = JSON.parse(data);
			
				var tr = $("<tr>");
				tr.addClass("text-center");
				tr.addClass("text-bold");
				var num = $("<td>");
				var name = $("<td>");
				var family = $("<td>");
				var phone = $("<td>");
				var email = $("<td>");
                var person = $("<td>");
				var date = $("<td>");
                var text = $("<td>");
				num.append("#");
				
				name.append("שם פרטי");
				family.append("שם משפחה");
				phone.append("טלפון");
                email.append("אימייל");
				person.append("שם העובד");
				date.append("תאריך הטיפול");
                text.append("תיאור משוב");
				
			
				tr.append(num);
				tr.append(name);
				tr.append(family);
				tr.append(phone);
				tr.append(email);
                tr.append(person);
				tr.append(date);
				tr.append(text);
				$('tbody').append(tr);
			for (var i = 0; i < data.length; i++) {
				var jsonObj = data[i];
				var tr = $("<tr>");
				tr.addClass("text-center");
				var num = $("<td>");
				var name = $("<td>");
				var family = $("<td>");
				var phone = $("<td>");
				var email = $("<td>");
                var person = $("<td>");
				var date = $("<td>");
                var text = $("<td>");
				num.append(++i);
				i--;
				name.append(jsonObj.name);
				family.append(jsonObj.family);
				phone.append(jsonObj.phone);
                email.append(jsonObj.email);
				person.append(jsonObj.person);
				date.append(jsonObj.date);
                text.append(jsonObj.text);
				
			
				tr.append(num);
				tr.append(name);
				tr.append(family);
				tr.append(phone);
				tr.append(email);
                tr.append(person);
				tr.append(date);
				tr.append(text);
				$('tbody').append(tr);
			}
		}
	});
});