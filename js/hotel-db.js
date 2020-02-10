function prepareReservation(user){
	showModal("ajax-loading");
	hideModal("confirm-modal");

	var main=document.getElementById("main-row");
	var primeCard=main.getElementsByClassName("card-prime")[0].getElementsByClassName("card-body")[0];
	var primeInputs=primeCard.getElementsByTagName("input");
	var holder, clients, rooms=[];
	var roomGroups=main.getElementsByClassName("room-group");
	var clientCards;


	for (var i = 0; i < roomGroups.length; i++) {
		clients=[];
		clientCards=roomGroups[i].getElementsByClassName("card-client");
		
		for (var j = 0; j < clientCards.length; j++) {
			if(clientCards[j].getElementsByClassName("id-container")[0].innerHTML=="")
				clients.push(fillClient(clientCards[j].getElementsByClassName("card-body")[0]));
			else
				clients.push(clientCards[j].getElementsByClassName("id-container")[0].innerHTML);
		}
		if(i==0)
			holder=clients[0];
		
		rooms.push(fillRoom(roomGroups[i].getElementsByClassName("card-room")[0].getElementsByClassName("card-body")[0],clients));
	}

	if(primeCard.parentElement.nextElementSibling){
		var holderContainer=primeCard.parentElement.nextElementSibling;
		var holderBodies=holderContainer.getElementsByClassName("card-body");

		if(holderBodies[0].style.display!="none"){
			if(holderContainer.getElementsByClassName("id-container")[0].innerHTML=="")
				holder=fillClient(holderBodies[0]);
			else
				holder=holderContainer.getElementsByClassName("id-container")[0].innerHTML;
			
		}else{
			holder=fillEnterprise(holderBodies[1].getElementsByTagName("select")[0].value);
		}
	}

	return new Booking(primeInputs[0].value,primeInputs[1].value,rooms,holder,user,
		document.getElementById("holder-check").checked,document.getElementById("total-label").innerHTML, 
		(document.getElementById("checkon-check").checked?"RE":"AC"),
		(document.getElementById("payment-check").checked?document.getElementById("payment-method").value:null));
}

function send(entity, extra){
	if(extra==undefined)
		extra="";

	var p= $.ajax({
		type: 'post',
		url: 'insert.php',
		data: (entity!=null?entity.getSendData():"")+extra
	});

	return p;
}

function sendUpdate(data){
	var p= $.ajax({
		type: 'post',
		url: '/includes/update.php',
		data: data
	});

	return p;
}

function sendBooking(booking){
	var p= (booking.holder instanceof Person ?
		send(booking.holder):(
			booking.holder instanceof Enterprise?
			new Promise(function(resolve){
				resolve(booking.holder.id+";Se ha insertado a una empresa existente;E");
			}):new Promise(function(resolve){
				resolve(booking.holder+";Se ha insertado a un usuario existente;T")
			}))
	).then(function(ans){
		var data=ans.split(";");
		 setMessageOnLoading(data[1],"Holder");

		 if(data[2]=="E")
		 	return send(booking,"&enterprise="+data[0]);
		 else
			return send(booking,"&holder="+data[0]);
	});

	return p;
}

function sendReservation(user){
	const booking=prepareReservation(user);

	return sendBooking(booking).then(function(ans){
		var data=ans.split(";");
		var promises=[];

		if(data[2]==''){
			setMessageOnLoading(data[1],"Booking");
			return null;
		}else
			setMessageOnLoading(data[2],"Booking");

		promises.push(sendRoom(booking.rooms[0], data[0], booking.isStaying, data[1]));

		for (var i = 1; i < booking.rooms.length; i++) {
			promises.push(sendRoom(booking.rooms[i], data[0], false));
		}

		return Promise.all(promises);
	}).then(function (ans2){
		if(ans2!=null){
			var promises=[];

			for (var i = 0; i < ans2.length; i++) {
				var data=ans2[i][0].split(";");
				var roomId=data[0];
				setMessageOnLoading(data[1],"Habitacion");

				for (var j = 1; j < ans2[i].length; j++) {
					data=ans2[i][j].split(";");
					setMessageOnLoading((data[1]==undefined?"Asignación del titular a la habitación.":data[1]),"Huesped");
					promises.push(send(null, 'entity=guestReg&roomReg='+roomId+'&guestId='+data[0]));
				}
			}

			return Promise.all(promises);
		}
	}).then(function(ans3){
		if(ans3!=undefined){
			var data;

			for (var i = 0; i < ans3.length; i++) {
				data=ans3[i].split(";");
				setMessageOnLoading(data[1],"Huesped");
			}

			setTimeout(function(){
				showAlert("alert-s","Se ha registrado una nueva reserva");
				hideModal("ajax-loading");
				
				setTimeout(function(){
 					var href;

					if(document.getElementById("checkon-check").checked)
						if(document.getElementById("payment-check").checked)
 							href='/facturas/registrar';
 						else
 							href='/control_diario?date='+getDate(0);
 					else
						href='/reservas';
					
 					location.href=href;
				}, 1000);	
			}, 2000);
		}else
			showAlert("alert-d","Surgió un error en la ejecución. Por favor, reinicie la pagina.");
	});
}

function updateReservation(user){
	const booking=prepareReservation(user);

	return sendBooking(booking).then(function(ans){
		var data=ans.split(";");
		var promises=[];

		if(data[2]==''){
			setMessageOnLoading(data[1],"Booking");
			return null;
		}else
			setMessageOnLoading(data[2],"Booking");

		promises.push(sendRoom(booking.rooms[0], data[0], booking.isStaying, data[1]));

		for (var i = 1; i < booking.rooms.length; i++) {
			promises.push(sendRoom(booking.rooms[i], data[0], false));
		}

		return Promise.all(promises);
	}).then(function (ans2){
		if(ans2!=null){
			var promises=[];

			for (var i = 0; i < ans2.length; i++) {
				var data=ans2[i][0].split(";");
				var roomId=data[0];
				setMessageOnLoading(data[1],"Habitacion");

				for (var j = 1; j < ans2[i].length; j++) {
					data=ans2[i][j].split(";");
					setMessageOnLoading((data[1]==undefined?"Asignación del titular a la habitación.":data[1]),"Huesped");
					promises.push(send(null, 'entity=guestReg&roomReg='+roomId+'&guestId='+data[0]));
				}
			}

			return Promise.all(promises);
		}
	}).then(function(ans3){
		if(ans3!=undefined){
			var data;

			for (var i = 0; i < ans3.length; i++) {
				data=ans3[i].split(";");
				setMessageOnLoading(data[1],"Huesped");
			}

			setTimeout(function(){
				showAlert("alert-s","Se ha registrado una nueva reserva");
				hideModal("ajax-loading");
				
				setTimeout(function(){
					var href;
					
					if(document.getElementById("checkon-check").checked)
						if(document.getElementById("payment-check").checked)
 							href='/facturas/registrar';
 						else
 							href='/control_diario?date='+getDate(0);
 					else
						href='/reservas';
					
 					location.href=href;

				}, 1000);	
			}, 2000);
		}else
			showAlert("alert-d","Surgió un error en la ejecución. Por favor, reinicie la pagina.");
	});
}

function sendRoom(room, bookingId, isStaying, holder){
	var promises=[];

	promises.push(send(room,"&bookingId="+bookingId));

	if(isStaying)
		promises.push(new Promise(function(resolve){
			resolve(holder);
		}));

	for (var i = (isStaying?1:0); i < room.guests.length; i++) {
		if(room.guests[i] instanceof Person)
			promises.push(send(room.guests[i]));
		else
			promises.push(new Promise(function(resolve){
				resolve(room.guests[i]);
			}));
	}
	
	return Promise.all(promises);
}

function fillEnterprise(id,enterpriseBody){
	if(enterpriseBody==undefined)
		return new Enterprise(id);
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
	constructor(startDate, finishDate,rooms, holder, user, isStaying, amount, isCheckon, paymentMethod){
		this.startDate=startDate;
		this.finishDate=finishDate;
		this.rooms=rooms;
		this.holder=holder;
		this.user=user;
		this.isStaying=isStaying;
		this.amount=amount;
		this.isCheckon=isCheckon;
		this.paymentMethod=paymentMethod;
	}

	getSendData(){
		var data="entity=reservation&startDate="+this.startDate+"&finishDate="+this.finishDate+"&user="+this.user+"&amount="+this.amount+"&state="+this.isCheckon;
		
		if(this.paymentMethod!=null)
			data+="&paymentMethod="+this.paymentMethod;

		return data;
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

class Enterprise{
	constructor(id,nit,name, phone, email){
		this.id=id;
		this.nit=nit;
		this.name=name;
		this.phone=phone;
		this.email=email;
	}

	getSendData(){
		var data="entity=enterprise&nit="+this.nit+"&name="+this.name+"&phone="+this.phone;
		
		if(this.email)
			data+="&email="+this.email;

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


 function confirmCheckOn(reservation){
 	sendUpdate("action=setCheckOn&idBooking="+reservation).then(function(ans){
 		var data=ans.split(";");
 		showAlert(data[0],data[1]);

 		if(document.getElementById("payment-check").checked)
 			href='/facturas/registrar';
 		else
 			href='/control_diario?date='+getDate(0);

 		location.href=href;
 	});
 }