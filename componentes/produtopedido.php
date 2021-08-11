<?php

    include('whatsapp.php');
     
	class pedidoProduto
	{
		public $link = "";
        public $idprodutopedido = "";
        public $codigopedido = "";
        public $codigoproduto = "";
        public $status = "";

		public function GetAll()
		{
			$qry = 	"
                        SELECT 	idprodutopedido,
                                codigopedido,
                                codigoproduto,
                                status                          
						FROM 	produtopedido 
						WHERE 	1=1
					";
			//echo $qry;
			$result = mysqli_query($this->link,$qry);
			return $result;
		}

		
        public function ValidaInsercaoPedidoProduto()
		{

			$mensagem = '';
			$podeconsultar = true;
			$podeinserir = true;

			if($podeinserir)
			{
				$this->InsertPedidoProduto();
			}
		}

		private function InsertPedidoProduto()
		{
            
            $qry = "SELECT  COUNT(0) AS total
                    FROM    produtopedido 
                    WHERE   1=1
                    AND     codigoproduto = '" . $this->codigoproduto . "'";
            $result = mysqli_query($this->link,$qry);
            $dr = mysqli_fetch_array($result,MYSQLI_ASSOC);


            $this->idprodutopedido = strlen($this->idprodutopedido) > 0 ? $this->idprodutopedido : "NULL";
            $this->codigopedido = strlen($this->codigopedido) > 0 ? $this->codigopedido : "NULL";
            $this->codigoproduto = strlen($this->codigoproduto) > 0 ? $this->codigoproduto : "NULL";
            $this->status = strlen($this->status) > 0 ? $this->status : "NULL";


			if($dr["total"] == '0')
			{
				echo "cheguei aqui";
				$qry = "INSERT INTO produtopedido
				(
					codigopedido,
                    codigoproduto,
                    status
				)
				VALUES
				(
					'" . 	$this->codigopedido . "',
                    '" . 	$this->codigoproduto . "',
                    '" . 	$this->status . "'
				)";
                echo $qry . "<br>";
                mysqli_query($this->link,$qry);
                enviaWhatsapp($this->idproduto,'11991552015',$this->codigopedido,$this->link);    
				$this->idpedido = mysqli_insert_id($this->link);;
				$inseriu = true;
			}
			else
			{
				$qry = "UPDATE produtopedido SET 
                                        status = '" . $this->status . "'
                        WHERE codigopedido = '" . $this->codigopedido . "'";
                        //echo $qry . "<br>";

                mysqli_query($this->link,$qry);
                $inseriu = true;

			}

			if($inseriu = true)
			{
				$this->mensagem = 'Dados gravados com sucesso.';
			}
			return $inseriu;
		}

		public function DadosPedidoProduto()
		{
			$au = $this->GetAll();
			while($du = mysqli_fetch_array($au,MYSQLI_ASSOC))
			{
				$this->idprodutopedido = $du["idprodutopedido"];
				$this->codigopedido = $du["codigopedido"];
                $this->codigoproduto = $du["codigoproduto"];
                $this->status = $du["status"];
			}
		}
	}
?>