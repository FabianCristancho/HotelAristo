function initPage(){
	updateRoom(document.getElementById("rooms-quantity"));
}

function updateRoom(input){
	if(input.value>10)
		input.value=10;
	else if(input.value<1)
		input.value=1;

	var content=document.getElementById("main-row");
	var groups=content.getElementsByClassName('room-group');
	var res=input.value-groups.length;

	if(res>0){
		var base=document.getElementById("room-group");
		var group;

		for (var i = 0; i < res; i++) {
			group = document.createElement("div");
			group.classList=base.classList;
			group.innerHTML=base.innerHTML;
			content.appendChild(group);
		}
	}else{
		var length= groups.length;

		for (var i = length - 1; i >= res+length; i--) {
			content.removeChild(groups[i]);
		}
	}
	assignAttributes();
}

function updateGuest(index,input){
	var content=document.getElementsByClassName('room-group')[index].getElementsByClassName("client-cards")[0];
	var cards=content.getElementsByClassName("card-client");
	var res=evaluateRoomNameQuantity(input.value)-cards.length;

	if(res>0){
		var base=document.getElementById("room-group").getElementsByClassName("card-client")[0];
		var card;

		for (var i = 0; i < res; i++) {
			card = document.createElement("div");
			card.classList=base.classList;
			card.innerHTML=base.innerHTML;
			content.appendChild(card);
		}
	}else{
		var length= cards.length;

		for (var i = length - 1; i >= res+length; i--) {
			content.removeChild(cards[i]);
		}
	}
	assignAttributesToClients(index);
}

function assignAttributes(){
	var groups=document.getElementsByClassName('room-group');

	for (var i = 0; i < groups.length; i++) {
		assignAttributesToGroup(i);
	}
}

function assignAttributesToGroup(i){
	var group=document.getElementsByClassName('room-group')[i].getElementsByClassName('card-room')[0];
	var selects=group.getElementsByTagName('select');
	var input=group.getElementsByTagName('input')[0];
	var title=group.getElementsByClassName("card-header")[0].getElementsByTagName("strong")[0];
	title.innerHTML="Habitación "+(1+i);
	selects[0].setAttribute('onchange','updateGuest('+i+',this); updateRoomTypes('+i+'); updateRoomTariff('+i+');');
	selects[1].setAttribute('onchange','updateRooms('+i+'); updateRoomTariff('+i+');');
	selects[3].setAttribute('onchange','showCustomTariff('+i+',this);');
	input.setAttribute('onchange','applyDiscount('+i+',this);');
	assignAttributesToClients(i);
}

function assignAttributesToClients(index){
	var roomGroup=document.getElementsByClassName('room-group')[index];
	var clientCards=roomGroup.getElementsByClassName('client-cards')[0];
	var cards=clientCards.getElementsByClassName("card-client");
	var chkButtons=clientCards.getElementsByClassName("btn-check-in");
	var selectRoom=roomGroup.getElementsByClassName("card-room")[0].getElementsByTagName("select")[2];
	var roomNumber=getSelectedOptionNameFrom(selectRoom);
	var title;
	var header;

	if(roomNumber)
		for (var i = 0; i < cards.length; i++) {
			header=cards[i].getElementsByClassName("card-header")[0];
			title= header.getElementsByTagName("strong")[0];
			title.innerHTML="Información personal "+(1+i)+" ("+roomNumber+")";

			if(index==0&&i==0){
				if(document.getElementById("holder-check")==null){
					title.innerHTML="Información personal del titular "+(1+i)+" ("+roomNumber+")";
					var div= document.createElement("div");
					var switchIcon=document.createElement("label");
					var switchLabel=document.createElement("label");
					div.classList.add("switch-group");
					div.classList.add("switch-group-margin");
					switchIcon.classList.add("switch");
					switchIcon.classList.add("switch-container");
					switchIcon.innerHTML="<input id='holder-check' type='checkbox' onchange='changeHolderPosition(this)' checked><span class='slider slider-gray round green'></span>";
					switchLabel.id="holder-label";
					switchLabel.classList.add("switch-label");
					switchLabel.innerHTML="El titular se hospedará";
					div.appendChild(switchIcon);
					div.appendChild(switchLabel);
					header.appendChild(div);
				}else{
					if(document.getElementById("holder-check").checked)
						title.innerHTML="Información personal del titular "+(1+i)+" ("+roomNumber+")";
				}
			}

			chkButtons[i].setAttribute("onClick","showAllInputs("+index+","+i+");");
		}
	else
		showAlert("alert-i","No hay habitaciones disponibles para ese tipo de habitacion");

}

function reducePrimeInfoCard(){
	var card=document.getElementsByClassName("card-prime")[0];
	changeStateCard(card.getElementsByClassName("btn-done")[0].innerHTML=="Editar",card);
}

function reduceRoomCard(index){
	var card=document.getElementsByClassName("card-room")[index];
	changeStateCard(card.getElementsByClassName("btn-done")[0].innerHTML=="Editar",card);
}

function reduceClientCard(index,value){
	var card=document.getElementsByClassName('room-group')[index].getElementsByClassName("card-client")[value];
	var state=card.getElementsByClassName("btn-done")[0].innerHTML=="Editar";
	var chkLabel=card.getElementsByClassName("card-header")[0].getElementsByTagName("label")[0];
	changeStateCard(state,card);
	reduceCard(state,card,3);

	if(card.getElementsByClassName("row")[1].style.display == "flex")
		chkLabel.innerHTML="Check in";
	else
		chkLabel.innerHTML="Sin Check in";

	if(state){
		card.getElementsByClassName("btn-check-in")[0].style.display="inline-block";
		chkLabel.style.display="none";
	}else{
		card.getElementsByClassName("btn-check-in")[0].style.display="none";
		chkLabel.style.display="inline-block";
	}
}

function showAllInputs(index,value){
	var rows=document.getElementsByClassName('room-group')[index].getElementsByClassName("card-client")[value].getElementsByClassName("row");

	if(rows[1].style.display == "flex"){
		setRequired(rows[1],false);
		setRequired(rows[2],false);
		setRequired(rows[4],false);
		rows[1].style.display="none";
		rows[2].style.display="none";
		rows[4].style.display="none";
		rows[5].getElementsByClassName("form-group")[0].style.display="none";
		rows[5].getElementsByClassName("form-group")[2].style.display="none";
	}else{
		setRequired(rows[1],true);
		setRequired(rows[2],true);
		setRequired(rows[4],true);
		rows[1].style.display="flex";
		rows[2].style.display="flex";
		rows[4].style.display="flex";
		rows[5].getElementsByClassName("form-group")[0].style.display="initial";
		rows[5].getElementsByClassName("form-group")[2].style.display="initial";
	}
}

function setRequired(row, bool){
	var inputs=row.getElementsByTagName("input");
	var selects=row.getElementsByTagName("select");
	if(bool){
		for (var i = 0; i < inputs.length; i++) {
			inputs[i].setAttribute("required","");
		}

		for (var i = 0; i < selects.length; i++) {
			selects[i].setAttribute("required","");
		}
	}else{
		for (var i = 0; i < inputs.length; i++) {
			inputs[i].removeAttribute("required");
		}

		for (var i = 0; i < selects.length; i++) {
			selects[i].removeAttribute("required");
		}
	}
}

function setPreviewBook(){
	var mainRow=document.getElementById("main-row");
	var confirm= document.getElementById("confirm-modal").getElementsByClassName("card-body")[0];
	var switches= document.getElementById("confirm-modal").getElementsByClassName("card-body")[1];
	var primeInputs=mainRow.getElementsByClassName('card-prime')[0].getElementsByTagName("input");
	var roomGroups= mainRow.getElementsByClassName("room-group");
	var clientCards=mainRow.getElementsByClassName("card-client");

	var holderCard=clientCards[0];
	var holderInputs=holderCard.getElementsByTagName("input");

	confirm.innerHTML="";

	var row =document.createElement("div");
	row.classList.add("row");
	row.appendChild(createFormGroupLabel("Fecha de llegada",convertDate(primeInputs[0].value),"calendar"));
	row.appendChild(createFormGroupLabel("Fecha de salida",convertDate(primeInputs[1].value),"calendar"));
	row.appendChild(createFormGroupLabel("Cantidad de habitaciones",primeInputs[3].value,"bed"));
	confirm.appendChild(row);
	
	
	if(!holderInputs[0].checked){
		row =document.createElement("div");
		row.classList.add("row");
		var bodies=holderCard.getElementsByClassName("card-body");

		if(bodies[1].style.display=="")
			row.appendChild(createFormGroupLabel("Titular",holderInputs[1].value+" "+holderInputs[2].value,"user"));
		else
			row.appendChild(createFormGroupLabel("Empresa",getSelectedOptionNameFrom(bodies[1].getElementsByTagName("select")[0]),"user"));
		
		confirm.appendChild(row);
	}

	var roomSelects;
	var roomInput;
	var guests;
	var guestsNames;
	var tariff;
	var totalTariffs=0;
	var clientsQuantity=0;

	for (var i = 0; i < roomGroups.length; i++) {
		guestsNames="";
		row =document.createElement("div");
		row.classList.add("row");
		roomSelects=roomGroups[i].getElementsByClassName("card-room")[0].getElementsByTagName("select");
		roomInput=roomGroups[i].getElementsByClassName("card-room")[0].getElementsByTagName("input")[1];
		row.appendChild(createFormGroupLabel("Habitación "+(i+1),getSelectedOptionNameFrom(roomSelects[2])+" ("+getSelectedOptionNameFrom(roomSelects[1])+")","bed"));
		tariff=getSelectedOptionNameFrom(roomSelects[3]);
		
		if(tariff=="Otro")
			tariff=roomInput.value;
		
		totalTariffs+=parseInt(tariff);
		row.appendChild(createFormGroupLabel("Tarifa",tariff,"dollar"));
		guests=roomGroups[i].getElementsByClassName("client-cards")[0].getElementsByClassName("card-body");
		
		for (var j = 0; j < guests.length; j++) {
			if(guests[j].id!="enterprise-holder"){
				guestsNames+=guests[j].getElementsByTagName("input")[0].value;
				clientsQuantity++;

				if(j!=guests.length-1)
					guestsNames+=",";
			}
		}

		row.appendChild(createFormGroupLabel("Huespedes",guestsNames,"group"));
		confirm.appendChild(row);
	}

	row =document.createElement("div");
	row.classList.add("row");
	row.appendChild(createFormGroupLabel("Total (Habitaciones)",totalTariffs,"dollar"));
	confirm.appendChild(row);

	if(clientsQuantity==1)
		switches.getElementsByClassName("switch-label")[0].innerHTML="El huesped realiza check on";
	else
		switches.getElementsByClassName("switch-label")[0].innerHTML="Los huespedes realizan check on";
}

function convertDate(date){
	var date= new Date(date);
	return ('0' + date.getDate()).slice(-2)+ '/' + ('0' + (date.getMonth() + 1)).slice(-2) + '/' + date.getFullYear();
}

function changeHolderPosition(guest){
	var primeZone = document.getElementById("main-row").getElementsByTagName("div")[0];
	var enterpriseBody=document.getElementById("enterprise-holder");
	var selectHolder=document.getElementById("select-holder");
	var roomGroup=document.getElementsByClassName("room-group")[0];
	var clientCards = roomGroup.getElementsByClassName("client-cards")[0];
	var holder= document.getElementsByClassName("card-client")[0];
	var holderCheckIn=holder.getElementsByClassName("btn-check-in")[0];


	if(guest.checked){
		primeZone.removeChild(holder);
		clientCards.insertBefore(holder,clientCards.firstElementChild);
		document.getElementById("holder-label").innerHTML="El titular se hospedará";
		selectHolder.style.display="none";
		holderCheckIn.style.display="inline-block";
		showPersonHolder();
	}else{
		if(holder.getElementsByClassName("card-body").length==1){
			var parent=holder.getElementsByClassName("card-body")[0].parentElement;
			enterpriseBody.parentElement.removeChild(enterpriseBody);
			selectHolder.parentElement.removeChild(selectHolder);
			parent.appendChild(enterpriseBody);
			parent.insertBefore(selectHolder,parent.firstElementChild);
		}else{
			selectHolder.style.display="inline-block";
		}

		holderCheckIn.style.display="none";
		clientCards.removeChild(holder);
		holder.getElementsByClassName("card-header")[0].getElementsByTagName("strong")[0].innerHTML="Información (Titular)";
		primeZone.insertBefore(holder,primeZone.firstElementChild.nextElementSibling);
		document.getElementById("holder-label").innerHTML="El titular no se hospedará";
	}

	assignAttributes();
	var guestSelect=roomGroup.getElementsByClassName("card-room")[0].getElementsByTagName("select")[0];
	var clientQuantity=clientCards.getElementsByClassName("card-client").length;
	guestSelect.value=evaluateRoomQuantity((clientQuantity==0?1:clientQuantity));;
	updateGuest(0,guestSelect);
}

function evaluateRoomQuantity(value){
	switch(value){
		case 1:
			return 'S';
		case 2:
			return 'P';
		case 3:
			return 'T';
		case 4:
			return 'TS';
	}
}

function evaluateRoomNameQuantity(value){
	switch(value){
		case 'S':
			return 1;
		case 'P':
			return 2;
		case 'D':
			return 2;
		case 'T':
			return 3;
		case 'TS':
			return 4;
	}
}

function createFormGroupLabel(title,value,icon){
	var base =document.getElementById("form-group");
	var formGroup=document.createElement("div");
	formGroup.classList=base.classList;
	formGroup.innerHTML=base.innerHTML;
	var labels=formGroup.getElementsByTagName("label");
	var iconLabel= formGroup.getElementsByTagName("i")[0];
	labels[0].innerHTML=title;
	labels[1].innerHTML=value;
	iconLabel.classList.add("fa-"+icon);

	return formGroup;
}

function getSelectedOptionNameFrom(select){
	var option=select.getElementsByTagName("option")[select.selectedIndex];
	if(option)
		return option.innerHTML;
	return false;
}

function showPayments(input){
	var p=document.getElementById("payment-methods");
	if(input.checked)
		p.style.display="block";
	else
		p.style.display="none";
}

function showInPlace(input){
	var p=document.getElementById("in-place-form");
	if(input.checked)
		p.style.display="block";
	else
		p.style.display="none";
}

function showCustomTariff(index,input){
	var formGroup=document.getElementsByClassName('room-group')[index].getElementsByClassName('card-room')[0].getElementsByClassName("form-group")[4];
	
	if(input.value=="O"){
		formGroup.style.display="block";
		formGroup.getElementsByTagName("input")[0].required=true;
	}else{
		formGroup.style.display="none";
		formGroup.getElementsByTagName("input")[0].required=false;
	}
}

function showEnterpriseHolder(button){
	var enterpriseBody=document.getElementById("enterprise-holder");
	var clientBody=enterpriseBody.parentElement.firstElementChild.nextElementSibling;
	var clientInputs=clientBody.getElementsByTagName("input");
	button.classList.add("btn-header-selected");
	button.parentElement.firstElementChild.classList.remove("btn-header-selected");
	enterpriseBody.style.display="block";
	clientBody.style.display="none";
	clientInputs[0].required=false;
	clientInputs[1].required=false;
	clientInputs[4].required=false;

}

function showPersonHolder(button){
	if(button!=null){
		button.classList.add("btn-header-selected");
		button.nextElementSibling.classList.remove("btn-header-selected");
	}

	var enterpriseBody=document.getElementById("enterprise-holder");
	var clientBody=enterpriseBody.parentElement.firstElementChild.nextElementSibling;
	var clientInputs=clientBody.getElementsByTagName("input");
	enterpriseBody.style.display="";
	clientBody.style.display="block";
	clientInputs[0].required=true;
	clientInputs[1].required=true;
	clientInputs[4].required=true;
}