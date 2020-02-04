function loadBooking(id){
	$.ajax({
		type: 'post',
		url: '/includes/get.php',
		data:'entity=booking&id='+id
	}).then(function(ans){
		console.log("LOG: "+ans);
		var main=ans.split("?");
		var data=main[0].split(";");

		var fDate=document.getElementById("finish-date");
		var roomsQ=document.getElementById("rooms-quantity");
		document.getElementById("start-date").value=data[0];
		fDate.value=data[1];
		roomsQ.value=data[2];
		fDate.onchange.call();
		updateRoom(roomsQ);

	});
}