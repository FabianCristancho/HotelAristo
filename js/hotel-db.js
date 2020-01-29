function sendReservation(){
	var cards = document.getElementsByClassName("card");
	console.log(cards);
	return false;
}


function sendClient(i){
	var client=document.getElementsByClassName("card-client")[i];
	var rows=client.getElementsByClassName("row");
	var inputs=client.getElementsByTagName("input");
	var selects=client.getElementsByTagName("select");

	var docType,docNum,docDate,enterprise,fName,lName,
	phone,email,gender,birth,blood,rh,profession,nac;

	fName=inputs[0].value==""?"NULL":inputs[0].value;
	lName=inputs[1].value==""?"NULL":inputs[1].value;
	docNum=inputs[2].value==""?"NULL":inputs[2].value;
	docDate=inputs[3].value==""?"NULL":inputs[3].value;
	phone=inputs[4].value==""?"NULL":inputs[4].value;
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

	console.log(data);
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

function sendEnterprise(){
	var card=document.getElementsByClassName("card-enterprise")[0];
	var inputs=card.getElementsByTagName("input");
	var select=card.getElementsByTagName("select")[0];

	var nit=inputs[0].value==""?"NULL":inputs[0].value;
	var name=inputs[1].value==""?"NULL":inputs[1].value;
	var phone=inputs[2].value==""?"NULL":inputs[2].value;
	var email=inputs[3].value==""?"NULL":inputs[2].value;
	var ret=inputs[4].checked?"1":"0";
	var other=select.value;

	var data="entity=enterprise&nit="+nit+
	"&name="+name+
	"&phone="+phone+
	"&email="+email+
	"&ret="+ret+
	"&other="+other;

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
}

function sendProfession(){
	var card=document.getElementsByClassName("card-profession")[0];

	$.ajax({
		type: 'post',
		url: '/includes/insert.php',
		data: "entity=profession&name="+card.getElementsByTagName("input")[0].value,
		success: function (ans) {
			var data=ans.split(";");
			showAlert(data[0],data[1]);
		},
		error: function (ans) {
			showAlert('alert-d','No se pudo conectar con la base de datos');
		}
	});
}