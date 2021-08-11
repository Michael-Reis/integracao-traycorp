<?php
	class Categoria
	{
		public $link = "";
		public $acao = "";
		public $idcategoria = "";
        public $categoria = "";
        public $codigocategoria = "";
        public $codigocategoriapai = "";
        public $descricao = "";
        public $ativo = "";
		public $descricaocurta = "";
		public $slug = "";
		public $order = "";
		public $titulo = "";
		public $aceitatermo = "";
		public $termodeaceite = "";
		public $keywords = "";
		public $metatagdescricao = "";
		public $propriedade = "";
		public $urltray = "";
		public $accesstokentray = "";
		public $mensagem = "";
		public $erro = "";
		public $retorno = "";

		public function GetAll()
		{
			$qry = 	"
                        SELECT 	idcategoria,
                                categoria,                        
                                codigocategoria,
                                codigocategoria,
                                codigocategoriapai,
                                descricao,
                                descricaocurta,
                                ativo
						FROM 	categoria p
						WHERE 	1=1
					";
			//echo $qry;
			$result = mysqli_query($this->link,$qry);
			return $result;
		}

		
        public function ValidaInsercaoCategoriaTray()
		{

			$mensagem = '';
			$podeconsultar = true;
			$podeinserir = true;

			if($podeinserir)
			{
				$this->InsertCategoriaTray();
			}
		}

		private function InsertCategoriaTray()
		{
            
			$id = $this->acao == "Incluir" ? "" : $this->idcategoria;
			$tipo = $this->acao == "Incluir" ? "POST" : "PUT";

			$params["access_token"] = $this->accesstokentray;

			if(strlen($this->categoria) > 0)
			{
				$data["Category"]["name"] = $this->categoria;
			}
			
			if(strlen($this->codigocategoriapai) > 0)
			{
				$data["Category"]["parent_id"] = $this->codigocategoriapai;
			}

			if(strlen($this->descricao) > 0)
			{
				$data["Category"]["description"] = $this->descricao;
			}
			
			if(strlen($this->slug) > 0)
			{
				$data["Category"]["slug"] = $this->slug;
			}

			if(strlen($this->order) > 0)
			{
				$data["Category"]["order"] = $this->ordem;
			}
			
			if(strlen($this->titulo) > 0)
			{
				$data["Category"]["title"] = $this->titulo;
			}
			
			if(strlen($this->descricaocurta) > 0)
			{
				$data["Category"]["small_description"] = $this->descricaocurta;
			}

			if(strlen($this->aceitatermo) > 0)
			{
				$data["Category"]["has_acceptance_term"] = $this->aceitatermo;
			}

			if(strlen($this->termodeaceite) > 0)
			{
				$data["Category"]["acceptance_term"] = $this->termodeaceite;
			}

			if(strlen($this->keywords) > 0)
			{
				$data["Category"]["metatag"]["keywords"] = $this->keywords;
			}

			if(strlen($this->metatagdescricao) > 0)
			{
				$data["Category"]["metatag"]["description"] = $this->metatagdescricao;
			}

			if(strlen($this->propriedade) > 0)
			{
				$data["Category"]["property"] = [$this->propriedade];
			}
			
			$url = $this->urltray . "/categories/" . $id . "?".http_build_query($params);
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

		public function ValidaInsercaoCategoria()
		{

			$mensagem = '';
			$podeconsultar = true;
			$podeinserir = true;

			if($podeinserir)
			{
				$this->InsertCategoria();
			}
		}

		private function InsertCategoria()
		{
            

			$qry = "SELECT  COUNT(0) AS total
                    FROM    categoria c
                    WHERE   1=1
                    AND     c.codigocategoria = '" . $this->codigocategoria . "'";
            $result = mysqli_query($this->link,$qry);
            $dr = mysqli_fetch_array($result,MYSQLI_ASSOC);


			if($dr["total"] == '0')
			{

				$qry = "INSERT INTO categoria
				(
					categoria,
                    codigocategoria,
                    codigocategoriapai,
                    descricao,
                    ativo,
                    descricaocurta
				)
				VALUES
				(
                    '" . $this->categoria . "',
                    '" . $this->codigocategoria . "',
                    '" . $this->codigocategoriapai . "',
                    '" . $this->descricao . "',
                    " . $this->ativo . ",
                    '" . $this->descricaocurta . "'
				)";
                //echo $qry . "<br>";
				mysqli_query($this->link,$qry);
				$this->idcategoria = mysqli_insert_id($this->link);;
				$inseriu = true;
			}
			else
			{
				$qry = "UPDATE categoria SET 
                                        categoria = '" . $this->categoria . "',
                                        codigocategoria = '" . $this->codigocategoria . "',
                                        codigocategoriapai = '" . $this->codigocategoriapai . "',
                                        descricao = '" . $this->descricao . "',
                                        ativo = " . $this->ativo . ",
                                        descricaocurta = '" . $this->descricaocurta . "'
                        WHERE codigocategoria = '" . $this->codigocategoria . "'";
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

		public function DadosCategoria()
		{
			$au = $this->GetAll();
			while($du = mysqli_fetch_array($au,MYSQLI_ASSOC))
			{
                $this->categoria = $du["categoria"];
                $this->codigocategoria = $du["codigocategoria"];
                $this->codigocategoriapai = $du["codigocategoriapai"];
                $this->descricao = $du["descricao"];
                $this->descricaocurta = $du["descricaocurta"];
                $this->ativo = $du["ativo"];
			}
		}
	}
?>