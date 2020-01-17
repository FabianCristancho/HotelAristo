function showAllInputs(value){
	var rows=document.getElementsByClassName("card-client")[value].getElementsByClassName("row");
	if(rows[1].style.display == "flex"){
		rows[1].style.display="none";
		rows[2].style.display="none";
		rows[4].style.display="none";
		rows[5].getElementsByClassName("form-group")[0].style.display="none";
		rows[5].getElementsByClassName("form-group")[2].style.display="none";
	}else{
		rows[1].style.display="flex";
		rows[2].style.display="flex";
		rows[4].style.display="flex";
		rows[5].getElementsByClassName("form-group")[0].style.display="initial";
		rows[5].getElementsByClassName("form-group")[2].style.display="initial";
	}
}

function assignAttributes(){
	var chkButtons=document.getElementsByClassName("btn-check-in");
	for(var i=0;i<chkButtons.length;i++){
		chkButtons[i].setAttribute("onClick","showAllInputs("+i+");");
	}
	var cards=document.getElementsByClassName("card-client");
	for (var i = 0; i < cards.length; i++) {
		var title= cards[i].getElementsByClassName("card-header")[0].getElementsByTagName("strong")[0];
		title.innerHTML=title.innerHTML+" "+(1+i);
	}
	for (var i = cards.length - 1; i >= 1; i--) {
		cards[i].style.display="none";
	}
	var doneButtons=document.getElementsByClassName("btn-done");
	for(var i=0;i<doneButtons.length;i++){
		doneButtons[i].setAttribute("onClick","reduceClientCard("+i+");");
	}
}

function reduceClientCard(value){
	var card=document.getElementsByClassName("card-client")[value];
	if(card.getElementsByClassName("btn-done")[0].innerHTML=="Editar"){
		card.classList.remove("col-3");
		card.classList.add("col-12");
		card.getElementsByClassName("card-body")[0].style.display="";
		card.getElementsByClassName("btn-check-in")[0].style.display="inline-block";
		card.getElementsByClassName("btn-done")[0].innerHTML="Listo";
	}else{
		card.classList.add("col-3");
		card.classList.remove("col-12");
		card.getElementsByClassName("card-body")[0].style.display="none";
		card.getElementsByClassName("btn-check-in")[0].style.display="none";
		card.getElementsByClassName("btn-done")[0].innerHTML="Editar";
	}

}

function updateGuest(){
	var cards=document.getElementsByClassName("card-client");
	for (var i = 1; i < cards.length; i++) {
		if(i<document.getElementById("cantidad-huespedes").value)
			cards[i].style.display="flex";
		else
			cards[i].style.display="none";
	}

}

function getDate(input,days){
	document.getElementById(input).value =getDate(days);
}

function getDate(days){
	var date= new Date();
	date.setDate(date.getDate()+parseInt(days));
	return date.getFullYear() + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + ('0' + date.getDate()).slice(-2);
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
	var base=document.getElementById(type);
	var alert = document.createElement("div");
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
		case "D":
		cell.style.background='yellow';
		cell.getElementsByClassName("room-state")[0].innerHTML="Disponible";
		break;
		case "M":
		cell.style.background='#ff9800';
		cell.getElementsByClassName("room-state")[0].innerHTML="Con reserva";
		break;
		case "F":
		cell.style.background='gray';
		cell.getElementsByClassName("room-state")[0].innerHTML="Fuera de servicio";
		break;
	}
}

function checkColors(){
	var cells=document.getElementsByClassName("room-cell");
	for (var i = 0; i < cells.length; i++) {
		changeColor(cells[i].id.replace("room-",""));
	}
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

function updateRooms(){
	 $.ajax({
		type: 'post',
		url: '/includes/get.php',
		data: 'entity=roomType&roomType='+document.getElementById('room-type').value,
		success: function (ans) {
			$('#room-select').html(ans);
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

