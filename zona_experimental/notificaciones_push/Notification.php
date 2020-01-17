<?php 
	require __DIR__.'/vendor/autoload.php';	
	include '../../includes/database.php';
	use Minishlink\WebPush\WebPush;
	use Minishlink\WebPush\Subscription;

	class Client{
		private $endpoint;
		private $publicKey;
		private $authToken;

		public function __construct($endpoint,$publicKey,$authToken){
			$this->endpoint=$endpoint;
			$this->publicKey=$publicKey;
			$this->authToken=$authToken;

		}

		public function getSubsciption(){
			return Subscription::create([
				'endpoint' => $this->endpoint,
				'publicKey' => $this->publicKey,
				'authToken' => $this->authToken
			]);
		}
	}

	class Notification extends WebPush{
		private $database;
		private $clients;

		public function __construct($client){
			$this->database=new Database();

			$auth = [
				'VAPID' => [
					'subject' => 'mailto:me@website.com',
					'publicKey' => 'BH0mRo0AFWrSJmNT3MONy9mKF8cUBgol23epUYa7w0sQZKBw8NLv9Vjq0q_WNBM5GbaQsRmnbuceqKixHE_-9g8',
					'privateKey' => 'ZeMwIOy2hB0LfEj_r-Rh1bqJl-KVjt9uaH2gwPOsSRQ'
				]
			];
			parent::__construct($auth);

			if($client=="ALL")
				$query = $this->database->connect()->prepare('SELECT endpoint,llave_publica,llave_autorizacion FROM usuarios_aplicacion');
			else
				$query = $this->database->connect()->prepare('SELECT endpoint,llave_publica,llave_autorizacion FROM usuarios_aplicacion WHERE id_usuario_aplicacion='.$client);

			$query->execute();

			foreach ($query as $current) {
				$this->clients[]=new Client($current['endpoint'],$current['llave_publica'],$current['llave_autorizacion']);
			}
		}

		public function send($title,$content){
			foreach ($this->clients as $client) {
				$this->sendMessage($client,$title,$content);
			}
			
			$state=true;
			$confirm=false;

			foreach ($this->flush() as $report) {
				if (!$report->isSuccess()) {
					$state=false;
				}
				$confirm=true;
			}

			return ($state&&$confirm?"alert-s;Exito\n":"alert-d;\n");
		}


		function sendMessage($client,$title,$content){
			$this->setAutomaticPadding(false);
		    $this->sendNotification(
		    	$client->getSubsciption(),
		    	json_encode(['title'=>$title,'body'=>$content])
		    );
		}
	}
?>