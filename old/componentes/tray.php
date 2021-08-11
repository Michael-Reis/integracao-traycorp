<?php
	class Tray
	{
		public $link = "";
        public $consumer_key = "";
        public $consumer_secret = "";
        public $code = "";
        public $refresh_token = ""; 
        public $access_token = "";
        public $url = "";

		public function GetAll()
		{
			$qry = 	"
                        SELECT 	ta.consumer_key,
                                ta.consumer_secret,
                                ta.code,
                                ta.refresh_token,
                                ta.access_token,
                                ta.url
						FROM 	tray_acesso ta
						WHERE 	1=1
					";
			//echo $qry;
			$result = mysqli_query($this->link,$qry);
			return $result;
		}

		
        public function AtualizarToken()
		{
			$qry = "UPDATE tray_acesso SET  refresh_token = '" . $this->refresh_token . "',
                                            access_token = '" . $this->access_token . "'";
			//echo $qry;
			mysqli_query($this->link,$qry);
		}

		public function DadosTray()
		{
			$au = $this->GetAll();
			while($du = mysqli_fetch_array($au,MYSQLI_ASSOC))
			{
				$this->consumer_key = $du["consumer_key"];
				$this->consumer_secret = $du["consumer_secret"];
                $this->code = $du["code"];
                $this->refresh_token = $du["refresh_token"];
                $this->access_token = $du["access_token"];
                $this->url = $du["url"];
			}
		}
	}
?>