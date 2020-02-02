function getDate(days, input){
	var ret;
	var date= new Date();
	date.setDate(date.getDate()+parseInt(days));
	ret=date.getFullYear() + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + ('0' + date.getDate()).slice(-2);

	if(input!=null)
		document.getElementById(input).value =ret;
	return ret;
}

function calculateDate(date,days){
	var date= new Date(date);
	date.setDate(date.getDate()+1+parseInt(days));

	return date.getFullYear() + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + ('0' + date.getDate()).slice(-2);
}

function getDays(){
	var d1=document.getElementById('start-date').value;
	var d2=document.getElementById('finish-date').value;

	if(d1!=d2)
		document.getElementById("count-nights").value=moment(d2).diff(moment(d1),'days');
	else
		document.getElementById("count-nights").value=1;
}

function hideAlert(alert){
	if(alert.tagName=="SPAN")
		alert=alert.parentElement;

	alert.style.opacity = "0";

	setTimeout(
		function(){ 
			alert.style.display="none"; 

			try{
				document.getElementById("alerts").removeChild(alert);
			}catch(error){}
		}, 600);
}

function showAlert(type,message){
	console.log(type+" "+message);
	var base=document.getElementById(type);
	var alert = document.createElement("div");

	if(base){
		alert.classList=base.classList;
		alert.innerHTML=base.innerHTML;
		alert.getElementsByTagName("p")[0].innerText=message;
		document.getElementById("alerts").appendChild(alert);
		alert.style.opacity = 1;
		alert.style.display = "block"; 

		setTimeout(function(){
			hideAlert(alert);
		}, 5000);
	}
}

function showModal(modal){
	document.getElementById(modal).style.display = "block";
}

function hideModal(modal){
	document.getElementById(modal).style.display = "none";

	switch(modal){
		case 'add-bizz':
		cleanBizz();
		break;
		case 'add-prof':
		cleanProf();
		break;
	}
}

function touchOutside(modal){
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";

			switch(modal.id){
				case 'add-bizz':
				cleanBizz();
				break;
				case 'add-prof':
				cleanProf();
				break;
			}
		}
	}
}

function changeColor(room){
	var cell= document.getElementById("room-"+room);
	var value=document.getElementById("state-"+room).value;

	switch(value){
		case "O":
		cell.style.background='#f44336';
		cell.getElementsByClassName("room-state")[0].innerHTML="Ocupada";
		break;
		case "L":
		cell.style.background='yellow';
		cell.getElementsByClassName("room-state")[0].innerHTML="Disponible";
		break;
		case "R":
		cell.style.background='#ff9800';
		cell.getElementsByClassName("room-state")[0].innerHTML="Con reserva";
		break;
		case "X":
		cell.style.background='gray';
		cell.getElementsByClassName("room-state")[0].innerHTML="Fuera de servicio";
		break;
	}
}

function changeColors(room){
	var cell= document.getElementById("room-"+room);
	var value=cell.getElementsByClassName("room-state")[0].innerHTML;

	switch(value){
		case "Ocupada":
			cell.style.background='#f44336';
			break;

		case "Disponible":
			cell.style.background='yellow';
			break;

		case "Con reserva":
			cell.style.background='#ff9800';
			break;

		case "Fuera de servicio":
			cell.style.background='gray';
			break;
	}
}

function checkColors(){
	var cells=document.getElementsByClassName("room-cell");

	for (var i = 0; i < cells.length; i++) {
		changeColors(cells[i].id.replace("room-",""));
	}
}

function cleanBizz(){
	var bizz=document.getElementById("add-bizz");
	var inputs= bizz.getElementsByTagName("input");

	bizz.style.display = "none";
	bizz.getElementsByTagName("select")[0].value="NULL";

	for (var i = 0; i < inputs.length-2; i++) {
		inputs[i].value="";
	}

	inputs[4].checked=false;
	inputs[5].checked=true;
}

function cleanProf(){
	var prof=document.getElementById("add-prof");
	prof.style.display = "none";
	prof.getElementsByTagName("input")[0].value="";
}

function reduceCard(state,card, col){
	if(state){
		card.classList.remove("col-"+col);
		card.classList.add("col-12");
	}else{
		card.classList.add("col-"+col);
		card.classList.remove("col-12");
	}
}

function changeStateCard(state,card){
	if(state){
		card.getElementsByClassName("card-preview")[0].style.display="none";
		card.getElementsByClassName("card-body")[0].style.display="";
		card.getElementsByClassName("btn-done")[0].innerHTML="Listo";
	}else{
		card.getElementsByClassName("card-preview")[0].style.display="block";
		card.getElementsByClassName("card-body")[0].style.display="none";
		card.getElementsByClassName("btn-done")[0].innerHTML="Editar";
	}
}

function checkInputOnlyLetters(event,input){
	$(input).bind('keypress', function(event){
		var regex = new RegExp("^[a-zA-ZÀ-ÿ\u00f1\u00d1 ]+$");
		var key= String.fromCharCode(!event.charCode? event.which:event.charCode);

		if(!regex.test(key)){
			event.preventDefault();
			return false;
		}
	});
}

/* AJAX */

function updateRoomTypes(index){
	var cardRoom=document.getElementsByClassName('room-group')[index].getElementsByClassName("card-room")[0];

	 $.ajax({
		type: 'post',
		url: '/includes/get.php',
		data: 'entity=roomQuantity&roomQuantity='+cardRoom.getElementsByTagName("select")[0].value+"&startDate='"+document.getElementById("start-date").value+"'&finishDate='"+document.getElementById("finish-date").value+"'",
		success: function (ans) {
			cardRoom.getElementsByTagName("select")[1].innerHTML=ans;
		}
	});
}

function updateRooms(index){
	var cardRoom=document.getElementsByClassName('room-group')[index].getElementsByClassName("card-room")[0];

	 $.ajax({
		type: 'post',
		url: '/includes/get.php',
		data: 'entity=roomType&roomType='+cardRoom.getElementsByTagName("select")[1].value+"&startDate='"+document.getElementById("start-date").value+"'&finishDate='"+document.getElementById("finish-date").value+"'",
		success: function (ans) {
			cardRoom.getElementsByTagName("select")[2].innerHTML=ans;
			assignAttributesToClients(index);
		}
	});
}

function updateRoomTariff(index){
	var cardRoom=document.getElementsByClassName('room-group')[index].getElementsByClassName("card-room")[0];
	var selects=cardRoom.getElementsByTagName("select");
	
	 $.ajax({
		type: 'post',
		url: '/includes/get.php',
		data: 'entity=roomTariff&roomQuantity='+selects[0].value+'&roomType='+selects[1].value,
		success: function (ans) {
			selects[3].innerHTML=ans;
		}
	});
}

function updateCities(obj){
	$.ajax({
		type:'post',
		url:'/includes/get.php',
		data:'entity=country&country='+obj.value,
		success:function(ans){
			obj.parentElement.parentElement.parentElement.getElementsByTagName("select")[1].innerHTML=ans;
		}
	});
}


function updateProfession(){
	sendProfession();
	var cards=document.getElementsByClassName("card-client");
	
	window.setTimeout(function(){
		$.ajax({
			type: 'post',
			url: '/includes/get.php',
			data: 'entity=profession',
			success: function (ans) {
				for (var i = 0; i < cards.length; i++) {
					cards[i].getElementsByTagName("select")[6].innerHTML="<option value='NULL'>NINGUNA</option>"+ans;
				}
				cleanProf();
			}
		});
	},1000);
}

function updateEnterprise(){
	sendEnterprise();
	var cards=document.getElementsByClassName("card-client");
	
	window.setTimeout(function(){
		$.ajax({
			type: 'post',
			url: '/includes/get.php',
			data: 'entity=enterprise',
			success: function (ans) {
				for (var i = 0; i < cards.length; i++) {
					cards[i].getElementsByTagName("select")[7].innerHTML="<option value='NULL'>NINGUNA</option>"+ans;
				}
				cleanBizz();
			}
		});
	},1000);
}

 function setCheckOn(reservation, input){
 	var modal= document.getElementById("confirm-check-on");
 	modal.getElementsByClassName("card-body")[0].getElementsByTagName("label")[0].innerHTML=reservation;
 	modal.getElementsByTagName("button")[0].onclick=function(){confirmCheckOn(reservation);};
 	modal.getElementsByTagName("span")[0].addEventListener("click",function(){input.checked=false;});
	
 	if(input.checked){
 		modal.addEventListener("click", function(){
 			window.onclick = function(event) {
 				if (event.target == modal){ 
 					input.checked=false;
 					modal.style.display="none";
 				}
 			}});
 		showModal('confirm-check-on');
 	}
 }