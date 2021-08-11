<?php
	class Marca
	{
		public $link = "";
        public $idmarca = "";
        public $marca = "";
        public $codigomarca = "";
        public $ean = "";
        
        public function GetAll()
		{
			$qry = 	"
                        SELECT 	idmarca,
                                marca,
                                codigomarca,
                                ean,
                                slug
						FROM 	marca p
						WHERE 	1=1
					";
			//echo $qry;
			$result = mysqli_query($this->link,$qry);
			return $result;
		}

        public function ValidaInsercaoMarcaTray()
		{

			$mensagem = '';
			$podeconsultar = true;
			$podeinserir = true;

			if($podeinserir)
			{
				$this->InsertMarcaTray();
			}
		}

		private function InsertMarcaTray()
		{
            
			$id = $this->acao == "Incluir" ? "" : $this->idmarca;
			$tipo = $this->acao == "Incluir" ? "POST" : "PUT";

			$params["access_token"] = $this->accesstokentray;
            $data["Brand"]["brand"] = $this->marca;
            
			$url = $this->urltray . "/products/brands/" . $id . "?".http_build_query($params);
			//echo $url . "<br><Br>";
			ob_start();

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $tipo);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen(json_encode($data)))
			);
			curl_exec($ch);

			// JSON de retorno  
			$resposta = json_decode(ob_get_contents());
			$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			ob_end_clean();
			curl_close($ch);

			$this->retorno = $resposta;
			$this->erro = "S";
			$this->mensagem = "Aconteceu um erro com a gravação.";
			
			if($code == "201")
			{
				$this->erro = "N";
				$this->mensagem = "Gravado com sucesso.";
			}
			
		}
		
        public function ValidaInsercaoMarca()
		{

			$mensagem = '';
			$podeconsultar = true;
			$podeinserir = true;

			if($podeinserir)
			{
				$this->InsertMarca();
			}
		}

		private function InsertMarca()
		{
            
            $qry = "SELECT  COUNT(0) AS total
                    FROM    marca c
                    WHERE   1=1
                    AND     c.codigomarca = '" . $this->codigomarca . "'";
            $result = mysqli_query($this->link,$qry);
            $dr = mysqli_fetch_array($result,MYSQLI_ASSOC);

            if(strlen($this->idmarca) > 0)
            {
                $qry = "SELECT  idmarca
                        FROM    marca
                        WHERE   1=1
                        AND     codigomarca = '" . $this->idmarca . "'";
                $result = mysqli_query($this->link,$qry);
                $dc = mysqli_fetch_array($result,MYSQLI_ASSOC);
                $this->idmarca = $dc["idmarca"];
            }
            else
            {
                $this->idcategorai = "NULL";
            }
            

			if($dr["total"] == '0')
			{

				$qry = "INSERT INTO marca
				(
                    marca,
                    codigomarca,
                    slug
				)
				VALUES
				(
                    '" . $this->marca . "',
                    '" . $this->codigomarca . "',
                    '" . $this->slug . "'
				)";
                //echo $qry . "<br>";
				mysqli_query($this->link,$qry);
				$this->idmarca = mysqli_insert_id($this->link);;
				$inseriu = true;
			}
			else
			{
				$qry = "UPDATE marca SET 
                                marca = '" . $this->marca . "',
                                codigomarca = '" . $this->codigomarca . "',
                                slug = '" . $this->slug . "'
                        WHERE codigomarca = '" . $this->codigomarca . "'";
                        //echo $qry . "<br>";
				mysqli_query($this->link,$qry);

				$inseriu = true;
			}

			if($inseriu)
			{
				$this->mensagem = 'Dados gravados com sucesso.';
			}
			return $inseriu;
		}

		public function DadosMarca()
		{
			$au = $this->GetAll();
			while($du = mysqli_fetch_array($au,MYSQLI_ASSOC))
			{
                $this->marca = $du["marca"];
                $this->codigomarca = $du["codigomarca"];
                $this->slug = $du["slug"];
			}
		}
	}
?>