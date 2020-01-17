<?php 
	require __DIR__.'/vendor/autoload.php';	
	include '../../includes/database.php';

	use Minishlink\WebPush\WebPush;
	use Minishlink\WebPush\Subscription;

	$database=new Database();

	$query = $database->connect()->prepare('SELECT endpoint,llave_publica,llave_autorizacion FROM usuarios_aplicacion WHERE id_usuario_aplicacion='.$_POST["id"]);
    $query->execute();

    foreach ($query as $current) {
    	$endpoint=$current['endpoint'];
    	$publicKey=$current['llave_publica'];
    	$authToken=$current['llave_autorizacion'];
    }

	$auth = [
	    'GCM' => 'MY_GCM_API_KEY',
	    'VAPID' => [
	        'subject' => 'mailto:me@website.com',
	        'publicKey' => 'BH0mRo0AFWrSJmNT3MONy9mKF8cUBgol23epUYa7w0sQZKBw8NLv9Vjq0q_WNBM5GbaQsRmnbuceqKixHE_-9g8',
	        'privateKey' => 'ZeMwIOy2hB0LfEj_r-Rh1bqJl-KVjt9uaH2gwPOsSRQ'
	    ]
	];

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

	$webPush = new WebPush($auth);
	$webPush->setAutomaticPadding(false);
	
	try{
		$webPush->sendNotification(
		    $notification['subscription'],
		    json_encode($notification['payload'])
		);
	
		foreach ($webPush->flush() as $report) {
		    if ($report->isSuccess()) {
		        echo "alert-s;Exito\n";
		    } else {
		        echo "alert-d;".$report->getReason();
		    }
		}
	}catch(Exception $e){
		echo "alert-d;Error al enviar"."\n".$e->getMessage();
	}


?>