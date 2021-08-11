<?php
	class Cliente
	{
		public $link = "";
        public $idcliente = "";
        public $cliente = "";
        public $codigocliente = "";
        public $cnpj= "";
        public $datacriacao= "";
        public $dataregistro= "";
        public $cpf= "";
        public $datanascimento= "";
        public $genero= "";
        public $email= "";
        public $desconto= "";
        public $ultimavisita= "";
        public $cidade= "";
        public $uf= "";
        public $newsletter= "";
        public $datamodificacao = "";

		public function GetAll()
		{
			$qry = 	"
                        SELECT 	idcliente,
                                cliente,                        
                                codigocliente,
                                cnpj,
                                datacriacao,
                                dataregistro,
                                cpf,
                                datanascimento,
                                genero,
                                email,
                                desconto,
                                ultimavisita,
                                cidade,
                                uf,
                                newsletter,
                                datamodificacao
						FROM 	cliente p
						WHERE 	1=1
					";
			//echo $qry;
			$result = mysqli_query($this->link,$qry);
			return $result;
		}

		
        public function ValidaInsercaoCliente()
		{

			$mensagem = '';
			$podeconsultar = true;
			$podeinserir = true;

			if($podeinserir)
			{
				$this->InsertCliente();
			}
		}

		private function InsertCliente()
		{
            
            $qry = "SELECT  COUNT(0) AS total
                    FROM    cliente c
                    WHERE   1=1
                    AND     c.codigocliente = '" . $this->codigocliente . "'";
            $result = mysqli_query($this->link,$qry);
            $dr = mysqli_fetch_array($result,MYSQLI_ASSOC);

            $this->datacriacao = strlen($this->datacriacao) == 0 || $this->datacriacao == "0000-00-00 00:00:00" ? "NULL" : "'" . $this->datacriacao . "'";
            $this->datanascimento = strlen($this->datanascimento) == 0 || $this->datanascimento == "0000-00-00" ? "NULL" : "'" . $this->datanascimento . "'";
            $this->dataregistro = strlen($this->dataregistro) == 0 || $this->dataregistro == "0000-00-00" ? "NULL" : "'" . $this->dataregistro . "'";
            $this->datamodificacao = strlen($this->datamodificacao) == 0 || $this->datamodificacao == "0000-00-00" ? "NULL" : "'" . $this->datamodificacao . "'";
            $this->ultimavisita = strlen($this->ultimavisita) == 0 || $this->ultimavisita == "0000-00-00" ? "NULL" : "'" . $this->ultimavisita . "'";
            $this->genero = strlen($this->genero) > 0 ? $this->genero : "0";
            $this->newsletter = strlen($this->newsletter) > 0 ? $this->newsletter : "0";
           
			if($dr["total"] == '0')
			{

				$qry = "INSERT INTO cliente
				(
					cliente,
                    codigocliente,
                    cnpj,
                    datacriacao,
                    dataregistro,
                    cpf,
                    datanascimento,
                    genero,
                    email,
                    desconto,
                    ultimavisita,
                    cidade,
                    uf,
                    newsletter,
                    datamodificacao
				)
				VALUES
				(
                    '" . $this->cliente . "',
                    '" . $this->codigocliente . "',
                    '" . $this->cnpj . "',
                    " . $this->datacriacao . ",
                    " . $this->dataregistro . ",
                    '" . $this->cpf . "',
                    " . $this->datanascimento . ",
                    " . $this->genero . ",
                    '" . $this->email . "',
                    " . $this->desconto . ",
                    " . $this->ultimavisita . ",
                    '" . $this->cidade . "',
                    '" . $this->uf . "',
                    " . $this->newsletter . ",
                    " . $this->datamodificacao . "
				)";
                //echo $qry . "<br>";
				mysqli_query($this->link,$qry);
				$this->idcliente = mysqli_insert_id($this->link); 
				$inseriu = true;
			}
			else
			{
				$qry = "UPDATE cliente SET 
                                        cliente = '" . $this->cliente . "',
                                        codigocliente = '" . $this->codigocliente . "',
                                        cnpj = '" . $this->cnpj . "',
                                        datacriacao = " . $this->datacriacao . ",
                                        dataregistro = " . $this->dataregistro . ",
                                        cpf = '" . $this->cpf . "',
                                        datanascimento = " . $this->datanascimento . ",
                                        genero = " . $this->genero . ",
                                        email = '" . $this->email . "',
                                        desconto = " . $this->desconto . ",
                                        ultimavisita = " . $this->ultimavisita . ",
                                        cidade = '" . $this->cidade . "',
                                        uf = '" . $this->uf . "',
                                        newsletter = " . $this->newsletter . ",
                                        datamodificacao = " . $this->datamodificacao . "
                        WHERE codigocliente = '" . $this->codigocliente . "'";
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

		public function DadosCliente()
		{
			$au = $this->GetAll();
			while($du = mysqli_fetch_array($au,MYSQLI_ASSOC))
			{
                $this->cliente = $du["cliente"];
                $this->codigocliente = $du["codigocliente"];
                $this->cnpj = $du["cnpj"];
                $this->datacriacao = $du["datacriacao"];
                $this->dataregistro = $du["dataregistro"];
                $this->cpf = $du["cpf"];
                $this->datanascimento = $du["datanascimento"];
                $this->genero = $du["genero"];
                $this->email = $du["email"];
                $this->desconto = $du["desconto"];
                $this->ultimavisita = $du["ultimavisita"];
                $this->cidade = $du["cidade"];
                $this->uf = $du["uf"];
                $this->newsletter = $du["newsletter"];
                $this->datamodificacao = $du["datamodificacao"];
			}
		}
	}
?>