function askPermission() {
	return new Promise(function(resolve, reject) {
		const permissionResult = Notification.requestPermission(function(result) {
			resolve(result);
		});

		if (permissionResult) {
			permissionResult.then(resolve, reject);
		}
	}).then(function(permissionResult) {
		if (permissionResult !== 'granted') {
			 showAlert('alert-w','La suscripción no fue aceptada');
		}else{
			showAlert('alert-i','La suscripción fue aceptada');
			requestNotificationPermission();
		}
	});
}

/**
 * Hace la petición de suscripción en el navegador en uso. 
 * Guarda un nombre clave, la llave publica del navegdor y la llave de autorizacion
*/
function requestNotificationPermission() {  
	navigator.serviceWorker.register('service-worker.js').then(registration => {
	  registration.pushManager.subscribe({
	  	userVisibleOnly: true,
	  	applicationServerKey: urlBase64ToUint8Array("BH0mRo0AFWrSJmNT3MONy9mKF8cUBgol23epUYa7w0sQZKBw8NLv9Vjq0q_WNBM5GbaQsRmnbuceqKixHE_-9g8")
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

/**
 * Realiza el envio de la informacion ingresada como title y message
 * al cliente suscriptor de la aplicacion id
*/
function sendMessage(id, title, message){
	$.ajax({
		type: 'post',
		url: 'sendNotification.php',
		data: "id="+id+"&title="+title+"&content="+message,
		success: function (ans) {
			var data=ans.split(";");
			showAlert(data[0],data[1]);
		},
		error: function (ans) {
			showAlert('alert-d','No se pudo conectar con el aplicativo');
		}
	});
}

/**
 * Realiza el envio de la informacion digitada en la pagina, al destinatario seleccionado.
*/
function sendCustomMessage(){
	var form=document.getElementsByTagName("form")[1];
	sendMessage(
		form.getElementsByTagName("select")[0].value,
		form.getElementsByTagName("input")[0].value,
		form.getElementsByTagName("textarea")[0].value
	);
}
/**
 * Codigo extraido de https://gist.github.com/Duske/7d08d4ed5fef5c009a73e838664876c9
 * Genera llaves unicas de cada navegador para poder utilizar la funcion push
*/
function generateKey(keyName, subscription) {
  var rawKey;
  rawKey = subscription.getKey ? subscription.getKey(keyName) : '';
  return rawKey ?
      btoa(String.fromCharCode.apply(null, new Uint8Array(rawKey))) :
      '';
}
/**Uso de la funcion generateKey con parametro de llave publica*/
function generatePublicKey(subscription) {
  return generateKey('p256dh', subscription);
}
/**Uso de la funcion generateKey con parametro de llave de autorizacion*/
function generateAuthKey(subscription) {
  return generateKey('auth', subscription);
}
/** Codigo extraido de https://gist.github.com/Duske/7d08d4ed5fef5c009a73e838664876c9
 * convierte llaves a base 8 
 */
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
