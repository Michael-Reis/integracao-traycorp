<?php 
	class Pedidoslistagem
	{
		public $link = "";
        public $idpedido = "";
        public $codigopedido = "";
        public $idpedidostatus = "";
        public $data = "";
        public $codigocliente = "";
        public $valorparcial = "";
        public $taxas = "";
        public $desconto = "";
        public $pontodevenda = "";
        public $metodoentrega = "";
        public $valorfrete = "";
        public $dataentrega = "";
        public $cupomdesconto = "";
        public $taxadopagamento = "";
        public $valor = "";
        public $formapagamento = "";
        public $codigoenviado = "";
        public $idsessao = "";
        public $total = "";
        public $datapagamento = "";
        public $codigoacesso = "";
        public $integradorremessa = "";
        public $datamodificacao = "";
        public $idcotacao = "";
        public $dataestimadaentrega = "";
        public $codigoexterno = "";
        public $totalcomissao = "";
        public $rastreavel = "";

		public function GetAll()
		{
			$qry = 	"
                        SELECT 	idpedido,
                                codigopedido,
                                idpedidostatus,
                                data,
                                codigocliente, 
                                valorparcial,
                                taxas,
                                desconto,
                                pontodevenda,
                                metodoentrega,
                                valorfrete,
                                dataentrega,
                                cupomdesconto,
                                taxadopagamento,
                                valor,
                                formapagamento,
                                codigoenviado,
                                idsessao,
                                total,
                                datapagamento,
                                codigoacesso,
                                integradorremessa,
                                datamodificacao,
                                idcotacao,
                                dataestimadaentrega,
                                codigoexterno,
                                totalcomissao,
                                rastreavel
						FROM 	pedido p
						WHERE 	1=1
					";
			//echo $qry;
			$result = mysqli_query($this->link,$qry);
			return $result;
		}
    

        
		public function DadosPedido()
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