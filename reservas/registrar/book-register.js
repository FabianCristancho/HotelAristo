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
	var res=input.value-cards.length;

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
	var title=group.getElementsByClassName("card-header")[0].getElementsByTagName("strong")[0];
	title.innerHTML="Habitación "+(1+i);
	selects[1].setAttribute('onchange','updateRooms('+i+');');
	selects[2].setAttribute('onchange','updateGuest('+i+',this);');
	assignAttributesToClients(i);
}

function assignAttributesToClients(index){
	var clientCards=document.getElementsByClassName('room-group')[index].getElementsByClassName('client-cards')[0];
	var cards=clientCards.getElementsByClassName("card-client");
	var chkButtons=clientCards.getElementsByClassName("btn-check-in");
	var title;

	for (var i = 0; i < cards.length; i++) {
		title= cards[i].getElementsByClassName("card-header")[0].getElementsByTagName("strong")[0];
		title.innerHTML="Información personal "+(1+index)+"."+(1+i);
		if(index==0&&i==0)
			title.innerHTML="Información personal "+(1+index)+"."+(1+i)+" (Titular)";
		chkButtons[i].setAttribute("onClick","showAllInputs("+index+","+i+");");
	}
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
	var confirm= document.getElementById("confirm-modal");
	var primeCard= document.getElementsByClassName("card-prime")[0];
	var clientCards= document.getElementsByClassName("card-client");
	var titularCard= clientCards[0];
	var primeInputs=primeCard.getElementsByTagName("input");
	var titularInputs=titularCard.getElementsByTagName("input");
	console.log("Titular: " + titularInputs[0].value + " " + titularInputs[1].value);
	console.log("Habitaciones: " + primeInputs[3].value);
	console.log("Personas: " + (clientCards.length-1));
}