function sendReservation(){
	var startDate = document.getElementById('start-date').value;
	var finishDate = document.getElementById('finish-date').value;
	var countNights = document.getElementById('count-nights').value;
	var user = document.getElementById('user-name').value;
	var roomId = document.getElementById('room-select').value;
	var roomRate = document.getElementById('room-rate').value;
	var countGuests = document.getElementById('cantidad-huespedes').value;
	
	var data="startDate="+startDate+
	"&finishDate="+finishDate+
	"&countNights="+countNights+
	"&user="+user+
	"&roomId="+roomId+
	"&roomRate="+roomRate+
	"&countGuests="+countGuests;


	if(document.getElementById("input-identity-1").style.display=="block"){
		var docType,docNum,docDate,enterprise,fName,lName,
		phone,email,gender,birth,blood,rh,profession,nac;

		for (var i = 1; i <= countGuests; i++) {
			docType=document.getElementById('doc-type-'+i).value;
			docNum=document.getElementById('doc-num-'+i).value;
			docDate=document.getElementById('doc-date-'+i).value;
			enterprise=document.getElementById('enterprise-'+i).value;
			fName=document.getElementById('first-'+i).value;
			lName=document.getElementById('last-'+i).value;
			phone=document.getElementById('phone-'+i).value;
			email=document.getElementById('email-'+i).value;
			gender=document.getElementById('gender-'+i).value;
			birth=document.getElementById('birth-'+i).value;
			blood=document.getElementById('blood-'+i).value;
			rh=document.getElementById('rh-'+i).value;
			profession=document.getElementById('profession-'+i).value;
			nac=document.getElementById('nac-'+i).value;
			
			data+="&docType_"+i+"="+docType+
			"&docNum_"+i+"="+docNum+
			"&docDate_"+i+"="+docDate+
			"&enterprise_"+i+"="+enterprise+
			"&fName_"+i+"="+fName+
			"&lName_"+i+"="+lName+
			"&phone_"+i+"="+phone+
			"&email_"+i+"="+email+
			"&gender_"+i+"="+gender+
			"&birth_"+i+"="+birth+
			"&blood_"+i+"="+blood+
			"&rh_"+i+"="+rh+
			"&profession_"+i+"="+profession+
			"&nac_"+i+"="+nac;
		}
		data+="&aux=N";
	}else{
		var enterprise,fName,lName,phone,email,profession;

		for (var i = 1; i <= countGuests; i++) {
			enterprise=document.getElementById('enterprise-'+i).value;
			fName=document.getElementById('first-'+i).value;
			lName=document.getElementById('last-'+i).value;
			phone=document.getElementById('phone-'+i).value;
			email=document.getElementById('email-'+i).value;
			profession=document.getElementById('profession-'+i).value;
			
			data+="&enterprise_"+i+"="+enterprise+
			"&fName_"+i+"="+fName+
			"&lName_"+i+"="+lName+
			"&phone_"+i+"="+phone+
			"&email_"+i+"="+email+
			"&profession_"+i+"="+profession;
		}
		data+="&aux=Y";
	} 

	data+="&entity=reservation";

	$.ajax({
		type: 'post',
		url: '/includes/insert.php',
		data: data,
		success: function (ans) {
			var data=ans.split(";");
			showAlert(data[0],data[1]);
		},
		error: function (ans) {
			showAlert('alert-e','No se pudo conectar con la base de datos');
		}
	});

	return false;
}


function sendClient(i){
	var client=document.getElementsByClassName("card-client")[i];
	var rows=client.getElementsByClassName("row");
	var inputs=client.getElementsByTagName("input");
	var selects=client.getElementsByTagName("select");

	var docType,docNum,docDate,enterprise,fName,lName,
	phone,email,gender,birth,blood,rh,profession,nac;

	fName=inputs[0].value;
	lName=inputs[1].value;	
	docNum=inputs[2].value==""?"NULL":inputs[2].value;
	docDate=inputs[3].value==""?"NULL":inputs[3].value;
	phone=inputs[4].value;
	email=inputs[5].value==""?"NULL":inputs[5].value;
	birth=inputs[6].value==""?"NULL":inputs[6].value;

	docType=selects[0].value;
	docCity=selects[2].value==""?"NULL":selects[2].value;
	gender=selects[3].value;
	blood=selects[4].value;
	rh=selects[5].value;
	profession=selects[6].value;
	enterprise=selects[7].value;
	nac=selects[8].value;

	var data="entity=customer";

	if(rows[1].style.display == "flex"){
		data+="&type=A&docType="+docType+
		"&docNum="+docNum+
		"&docDate="+docDate+
		"&enterprise="+enterprise+
		"&fName="+fName+
		"&lName="+lName+
		"&phone="+phone+
		"&email="+email+
		"&gender="+gender+
		"&birth="+birth+
		"&blood="+blood+
		"&rh="+rh+
		"&profession="+profession+
		"&nac="+nac+
		"&docCity=30"+docCity;
	}else{
		data+="&type=B&enterprise="+enterprise+
		"&fName="+fName+
		"&lName="+lName+
		"&phone="+phone+
		"&email="+email+
		"&enterprise="+enterprise;
	}


	$.ajax({
		type: 'post',
		url: '/includes/insert.php',
		data: data,
		success: function (ans) {
			var data=ans.split(";");
			showAlert(data[0],data[1]);
		},
		error: function (ans) {
			showAlert('alert-d','No se pudo conectar con la base de datos');
		}
	});

	return false;
}