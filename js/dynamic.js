var maxGuests=3;

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
function showAlert(type,message){
	var div=document.getElementById(type);
	var m=div.getElementsByTagName("p")[0];
	m.innerText=message;
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
		console.log(i);
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

function updateCities(){
	$.ajax({
		type:'post',
		url:'/includes/get.php',
		data:'entity=country&country='+document.getElementById('pais').value,
		success:function(ans){
			$('#ciudad').html(ans);
		}
	});
}