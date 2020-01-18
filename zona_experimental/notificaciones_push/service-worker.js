/**
 * Recibe la informacion del servidor y la muestra en una notificacion Push
*/
self.addEventListener('push', function(event) {
	var data=event.data;
	if(data){
		data=data.json();
		const title = data.title;
		const options = {
			body: data.body,
			icon: '/res/img/logoA.png',
			badge: '/res/img/badge.png',
			actions: [
			{
					action: 'answer',
					title: 'Responder'
				}
			]
		};
		event.waitUntil(self.registration.showNotification(title,options));
		const promiseChain = clients.openWindow(examplePage);
		clients.window.open('/zona_experimental/notificaciones_push');
	}else{
		event.waitUntil(self.registration.showNotification("data es null"));
	}
});

