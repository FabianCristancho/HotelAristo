function sendReservation(){
	const booking=prepareReservation();

	return sendBooking(booking).then(function(ans){
		var data=ans.split(";");
		var promises=[];

		for (var i = 0; i < booking.rooms.length; i++) {
			promises.push(sendRoom(booking.rooms[i], data[0], booking.isStaying, data[1]));
		}

		return promises;
	}).then(function (ans2){
		for (var i = 0; i < ans2.length; i++) {
			ans2[i].then(function(ans){
				var data=ans[0].split(";");
				var roomId=data[0];
				var clientId;

				for (var j = 1; j < ans.length; j++) {
					data=ans[j].split(";");
					clientId=data[0];

					$.ajax({
						type: 'post',
						url: 'insert.php',
						data: 'entity=guestReg&roomReg='+roomId+'&guestId='+clientId
					}).then(function(ans3){
						var data=ans3.split(";");
					});
				}
			});
		}
	});
}

function sendRoom(room, bookingId, isStaying, holder){
	var promises=[];

	promises.push($.ajax({
		type: 'post',
		url: 'insert.php',
		data: room.getSendData()+"&bookingId="+bookingId
	}));

	if(isStaying)
		promises.push(new Promise(function(resolve){
			resolve(holder);
		}));

	for (var i = (isStaying?1:0); i < room.guests.length; i++) {
		promises.push(sendClient(room.guests[i]));
	}
	
	return Promise.all(promises);
}

function sendBooking(booking){
	var p= sendClient(booking.holder).then(function(ans){
		var data=ans.split(";");

		return $.ajax({
			type: 'post',
			url: 'insert.php',
			data: booking.getSendData()+"&holder="+data[0]+"&state=AC"
		});
	});

	return p;
}

function sendClient(client){
	var p= $.ajax({
		type: 'post',
		url: 'insert.php',
		data: client.getSendData()
	});
	return p;
}

function prepareReservation(){
	var main=document.getElementById("main-row");
	var primeCard=main.getElementsByClassName("card-prime")[0].getElementsByClassName("card-body")[0];
	var primeInputs=primeCard.getElementsByTagName("input");
	var holder, clients=[], rooms=[];

	var roomGroups=main.getElementsByClassName("room-group");
	var clientCards;


	for (var i = 0; i < roomGroups.length; i++) {
		clientCards=roomGroups[i].getElementsByClassName("card-client");
		
		for (var j = 0; j < clientCards.length; j++) {
			clients.push(fillClient(clientCards[j].getElementsByClassName("card-body")[0]));
		}
		
		rooms.push(fillRoom(roomGroups[i].getElementsByClassName("card-room")[0].getElementsByClassName("card-body")[0],clients));
	}

	if(primeCard.parentElement.nextElementSibling)
		holder=fillClient(primeCard.parentElement.nextElementSibling.getElementsByClassName("card-body")[0]);
	else
		holder=clients[0];

	return new Booking(primeInputs[0].value,primeInputs[1].value,rooms,holder,1,true);
}

function fillClient(clientBody){
	var inputs = clientBody.getElementsByTagName("input");
	var selects = clientBody.getElementsByTagName("select");
	
	var email=inputs[5].value==""?null:inputs[5].value;
	var profession=selects[6].value=="NULL"?null:selects[6].value;

	if(inputs[2].value=="")
		return new Person(
			inputs[0].value,
			inputs[1].value,
			inputs[4].value,
			email
		);
	else{
		return new Person(
			inputs[0].value,
			inputs[1].value,
			inputs[4].value,
			email,
			new Document(inputs[2].value,
				selects[0].value,
				inputs[3].value,
				selects[2].value),
			selects[3].value,
			inputs[6].value,
			selects[4].value+selects[5].value,
			profession,
			selects[7].value
		);
	}
}

function fillRoom(roomBody,clients){
	var selects=roomBody.getElementsByTagName("select");

	return new Room(
		clients,
		selects[2].value,
		selects[3].value,
		selects[3].value=="O"?roomBody.getElementsByTagName("input")[0].value:getSelectedOptionNameFrom(selects[3])
	);
}

class Booking{
	constructor(startDate, finishDate,rooms, holder, user, isStaying){
		this.startDate=startDate;
		this.finishDate=finishDate;
		this.rooms=rooms;
		this.holder=holder;
		this.user=user;
		this.isStaying=isStaying;
	}

	getSendData(){
		return "entity=reservation&startDate="+this.startDate+"&finishDate="+this.finishDate+"&user="+this.user;
	}
}

class Room{
	constructor(guests,roomNumber,idTariff,tariff){
		this.guests=guests;
		this.roomNumber=roomNumber;
		this.idTariff=idTariff;
		this.tariff=tariff;
	}

	getSendData(){
		return "entity=room&roomNumber="+this.roomNumber+"&tariff="+this.idTariff;
	}
}

class Person {
	constructor(firstSecondName, lastName,phone, email, identificationDocument, gender, bornDate, bloodRh, profession,nationality){
		this.firstSecondName=firstSecondName;
		this.lastName=lastName;
		this.phone=phone;
		this.email=email;
		this.id=identificationDocument;
		this.gender=gender;
		this.bornDate=bornDate;
		this.bloodRh=bloodRh;
		this.profession=profession;
		this.nationality=nationality;
	}

	getSendData(){
		var data="entity=person&firstSecondName="+this.firstSecondName+"&lastName="+this.lastName+"&phone="+this.phone;
		
		if(this.email)
			data+="&email="+this.email;

		if(this.id!=undefined){
			data+="&"+this.id.getSendData()+"&gender="+this.gender+"&bornDate="+this.bornDate
			+"&bloodRh="+this.bloodRh+"&nationality="+this.nationality;
			
			if(this.profession)
				data+="&profession="+this.profession;
		}

		return data;
	}
}

class Document{
	constructor(number,type,expeditionDate,expeditionCity){
		this.number=number;
		this.type=type;
		this.expeditionDate;
		this.expeditionCity=expeditionCity;
	}


	getSendData(){
		return "docNumber="+this.number+"&docType="+this.type+"&docDate="+this.expeditionDate+"&docCity="+this.expeditionCity;
	}
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