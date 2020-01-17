<?php 
	require __DIR__.'/vendor/autoload.php';	
	include '../../includes/database.php';

	use Minishlink\WebPush\WebPush;
	use Minishlink\WebPush\Subscription;
	
	$database=new Database();

	//Variables de autorizacion de Push
	$auth = [
	    'VAPID' => [
	        'subject' => 'mailto:me@website.com',
	        'publicKey' => 'BH0mRo0AFWrSJmNT3MONy9mKF8cUBgol23epUYa7w0sQZKBw8NLv9Vjq0q_WNBM5GbaQsRmnbuceqKixHE_-9g8',
	        'privateKey' => 'ZeMwIOy2hB0LfEj_r-Rh1bqJl-KVjt9uaH2gwPOsSRQ'
	    ]
	];

	$webPush = new WebPush($auth);

	if($_POST["id"]=="ALL"){
		//Peticion a la base de datos del cliente receptor 
		$query = $database->connect()->prepare('SELECT endpoint,llave_publica,llave_autorizacion FROM usuarios_aplicacion');
	}else{
		//Peticion a la base de datos del cliente receptor 
		$query = $database->connect()->prepare('SELECT endpoint,llave_publica,llave_autorizacion FROM usuarios_aplicacion WHERE id_usuario_aplicacion='.$_POST["id"]);
	   
	}

 	$query->execute();

	foreach ($query as $current) {
		sendNotification($webPush,$current['endpoint'],$current['llave_publica'],$current['llave_autorizacion']);
	}

	$state=true;

	foreach ($webPush->flush() as $report) {
		if (!$report->isSuccess()) {
			$state=false;
		}
	}

	echo ($state?"alert-s;Exito\n":"alert-d;");

	function sendNotification($webPush,$endpoint,$publicKey,$authToken){
		$webPush->setAutomaticPadding(false);

		$notification = [
			'subscription' => Subscription::create([
				'endpoint' => $endpoint,
	            'publicKey' => $publicKey,
	            'authToken' => $authToken
	        ]),
	        'payload'=>[
	        	'title'=>$_POST["title"],
	        	'body'=>$_POST["content"]
	        ]
	    ];

	    $webPush->sendNotification(
	    	$notification['subscription'],
	    	json_encode($notification['payload'])
	    );
	}
?>