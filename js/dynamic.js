var maxGuests=3;

function showAllInputs(value){
	
	
	var aux=document.getElementById("input-identity-"+value);
	if(aux.style.display == "block"){
		aux.style.display="none";
		document.getElementById("input-more-"+value).style.display="none";
	}else{
		document.getElementById("input-identity-"+value).style.display="block";
		document.getElementById("input-more-"+value).style.display="block";
	}
	
}

function hideAllInputs(value){
	var aux=document.getElementById("input-identity-"+value);
	if(aux.style.display != "block"){
		aux.style.display="none";
		document.getElementById("input-more-"+value).style.display="none";
	}
}

function updateGuest(){
	for (var i = 0; i < maxGuests; i++) {
		if(document.getElementById("informacion-personal-" + i) != null) {
			document.getElementById("informacion-personal-" + i).style.display = "none";
			hideAllInputs(i);
		}
	}
	for (var i = 1; i <= document.getElementById("cantidad-huespedes").value; i++) {
		if(document.getElementById("informacion-personal-" + i).style.display == "none") {
			document.getElementById("informacion-personal-" + i).style.display = "block";
		}
	}
}

function getDate(input,days){
	var date= new Date();
	date.setDate(date.getDate()+parseInt(days));
	document.getElementById(input).value =date.getFullYear() + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + ('0' + date.getDate()).slice(-2);
}

function getDays(){
	var d1=document.getElementById('start-date').value;
	var d2=document.getElementById('finish-date').value;
	if(d1!=d2)
		document.getElementById("count-nights").value=moment(d2).diff(moment(d1),'days');
	else
		document.getElementById("count-nights").value=1;
}

function hideAlert(type){
	var div=document.getElementById(type);
	div.style.opacity = "0";
	setTimeout(function(){ div.style.display="none"; }, 600);
	
}
function showAlert(type){
	var div=document.getElementById(type);
	div.style.opacity = 1;
	div.style.display = "block"; 
	setTimeout(function(){
		hideAlert(div.id);
	}, 5000);
}

function showModal(modal){
	document.getElementById(modal).style.display = "block";
}

function hideModal(modal){
	document.getElementById(modal).style.display = "none";
}

function touchOutside(modal){
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
}

function changeColor(room){
	var cell= document.getElementById("room-"+room);
	var value=document.getElementById("state-"+room).value;
	switch(value){
		case "1":
		cell.style.background='#f44336';
		break;
		case "2":
		cell.style.background='yellow';
		break;
		case "3":
		cell.style.background='#ff9800';
		break;
		case "4":
		cell.style.background='gray';
		break;
	}
}

function checkColors(){
	var cells=document.getElementsByClassName("room-cell");
	for (var i = 0; i < cells.length; i++) {
		changeColor(cells[i].id.replace("room-",""));
	}
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