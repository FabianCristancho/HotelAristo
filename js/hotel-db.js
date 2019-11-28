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
			console.log(ans);
		}
	});

	return false;
}

function x(){

    
}