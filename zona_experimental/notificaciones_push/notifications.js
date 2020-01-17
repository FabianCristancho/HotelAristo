function requestNotificationPermission() {  
	navigator.serviceWorker.register('service-worker.js').then(registration => {
	  const pkey = "BH0mRo0AFWrSJmNT3MONy9mKF8cUBgol23epUYa7w0sQZKBw8NLv9Vjq0q_WNBM5GbaQsRmnbuceqKixHE_-9g8";
	  const vapidKeyArray = urlBase64ToUint8Array(pkey);
	  registration.pushManager.subscribe({
	  	userVisibleOnly: true,
	  	applicationServerKey: vapidKeyArray
	  })
		.then(subscription => {
			var data ='endpoint="'+subscription.endpoint+'"'
			+'&publicKey="'+ generatePublicKey(subscription)+'"'
			+'&authKey="'+generateAuthKey(subscription)
			+'"&name="'+document.getElementsByTagName("form")[0].getElementsByTagName("input")[0].value+'"';
		  	$.ajax({
		  		type: 'post',
		  		url: 'insert.php',
		  		data: data,
		  		success: function (ans) {
		  			var data=ans.split(";");
		  			showAlert(data[0],data[1]);
		  		},
		  		error: function (ans) {
		  			showAlert('alert-e','No se pudo conectar con la base de datos');
		  		}
			});
		});
	})
};

function sendMessage(){
	var form=document.getElementsByTagName("form")[1];
	var title= form.getElementsByTagName("input")[0].value;
	var content=form.getElementsByTagName("textarea")[0].value;
	var id=form.getElementsByTagName("select")[0].value;
	$.ajax({
		type: 'post',
		url: 'sendNotification.php',
		data: "id="+id+"&title="+title+"&content="+content,
		success: function (ans) {
			var data=ans.split(";");
			showAlert(data[0],data[1]);
		},
		error: function (ans) {
			showAlert('alert-e','No se pudo conectar con el aplicativo');
		}
	});
}

function generateKey(keyName, subscription) {
  var rawKey;
  rawKey = subscription.getKey ? subscription.getKey(keyName) : '';
  return rawKey ?
      btoa(String.fromCharCode.apply(null, new Uint8Array(rawKey))) :
      '';
}

function generatePublicKey(subscription) {
  return generateKey('p256dh', subscription);
}

function generateAuthKey(subscription) {
  return generateKey('auth', subscription);
}

function urlBase64ToUint8Array(base64String) {
  const padding = '='.repeat((4 - base64String.length % 4) % 4);
  const base64 = (base64String + padding)
    .replace(/\-/g, '+')
    .replace(/_/g, '/');
  const rawData = window.atob(base64);
  const outputArray = new Uint8Array(rawData.length);
  for (let i = 0; i < rawData.length; ++i) {
    outputArray[i] = rawData.charCodeAt(i);
  }
  return outputArray;
}
