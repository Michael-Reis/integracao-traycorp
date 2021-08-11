<?php

	class Pedido
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
                                formadepagamento,
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

		
        public function ValidaInsercaoPedido()
		{

			$mensagem = '';
			$podeconsultar = true;
			$podeinserir = true;

			if($podeinserir)
			{
				$this->InsertPedido();
			}
		}

		private function InsertPedido()
		{
            
  
            $this->data = strlen($this->data) == 0 || $this->data == "0000-00-00" ? "NULL" : "'" . $this->data . "'";
            $this->datapagamento = strlen($this->datapagamento) == 0 || $this->datapagamento == "0000-00-00" ? "NULL" : "'" . $this->datapagamento . "'";
            $this->valor = strlen($this->valor) > 0 ? $this->valor : "NULL";
            $this->valorparcial = strlen($this->valorparcial) > 0 ? $this->valorparcial : "NULL";
            $this->taxas = strlen($this->taxas) > 0 ? $this->taxas : "NULL";
            $this->desconto = strlen($this->desconto) > 0 ? $this->desconto : "NULL";
            $this->valorfrete = strlen($this->valorfrete) > 0 ? $this->valorfrete : "NULL";
            $this->dataentrega = strlen($this->dataentrega) == 0 || $this->dataentrega == "0000-00-00" ? "NULL" : "'" . $this->dataentrega . "'";
            $this->taxadopagamento = strlen($this->taxadopagamento) > 0 ? $this->taxadopagamento : "NULL";
            $this->total = strlen($this->total) > 0 ? $this->total : "NULL";
            $this->datamodificacao = strlen($this->datamodificacao) == 0 || $this->datamodificacao == "0000-00-00" ? "NULL" : "'" . $this->datamodificacao . "'";
            $this->dataestimadaentrega = strlen($this->dataestimadaentrega) == 0 || $this->dataestimadaentrega == "0000-00-00" ? "NULL" : "'" . $this->dataestimadaentrega . "'";
            $this->totalcomissao = strlen($this->totalcomissao) > 0 ? $this->totalcomissao : "NULL";
            
            $qry = "SELECT codigopedido
                    FROM pedido
                    WHERE 1=1
                    AND codigopedido = $this->codigopedido";  
    
            $result = mysqli_query($this->link, $qry); 
            $rows = mysqli_num_rows($result);   



            if($rows == 0)
            {                
                
                $qryinsert = "INSERT INTO pedido
				(
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
				)
				VALUES
				(
					'" . 	$this->codigopedido . "',
                    '" . 	$this->idpedidostatus . "', 
                    " . 	$this->data . ",
                    '" .    $this->codigocliente . "',
                    " .    $this->valorparcial . ",
                    " .    $this->taxas . ",
                    " .    $this->desconto . ",
                    '" .    $this->pontodevenda . "',
                    '" .    $this->metodoentrega . "',
                    '" .    $this->valorfrete . "',
                    " .    $this->dataentrega . ",
                    '" .    $this->cupomdesconto . "',
                    " .    $this->taxadopagamento . ",
                    " .    $this->valor . ",
                    '" .    $this->formapagamento . "',
                    '" .    $this->codigoenviado . "',
                    '" .    $this->idsessao . "',
                    " .    $this->total . ",
                    " .    $this->datapagamento . ",
                    '" .    $this->codigoacesso . "',
                    '" .    $this->integradorremessa . "',
                    " .    $this->datamodificacao . ",
                    '" .    $this->idcotacao . "',
                    " .    $this->dataestimadaentrega . ",
                    '" .    $this->codigoexterno . "',
                    " .    $this->totalcomissao . ",
                    '" .    $this->rastreavel . "'
                )"; 
                
                echo $qryinsert;
                echo "<br><br>";
                mysqli_query($this->link,$qryinsert); 
				$this->idpedido = mysqli_insert_id($this->link);  
                $inseriu = true;    
                echo "Pedido novo " . $this->codigopedido . "<br><br>";   


                
                
            }else{
                /*
                echo "Pedido já existia <br> <br>"; 
                echo "contagem de linhas: ". $rows . "<br><br>";   
                echo "Código do pedido: " . $this->codigopedido . "<br><br>";
                echo "Valor total: " . $this->total . "<br><br>";      
                */
                echo "já existe"; 
                echo "<br>";
                echo "idpedido: ".$this->codigopedido; 
                echo "<br>";
                echo "<br>"; 


            }




            


            /*
            $qry = "SELECT  COUNT(0) AS total,
                            F_depara_novo('traystatus','" . $this->idpedidostatus . "') AS idpedidostatus
                    FROM    pedido p
                    WHERE   1=1
                    AND     p.codigopedido = '" . $this->codigopedido . "'";
            $result = mysqli_query($this->link,$qry);
            $dr = mysqli_fetch_array($result,MYSQLI_ASSOC); 

 
            $this->idpedidostatus = $dr["idpedidostatus"];
            $this->data = strlen($this->data) == 0 || $this->data == "0000-00-00" ? "NULL" : "'" . $this->data . "'";
            $this->datapagamento = strlen($this->datapagamento) == 0 || $this->datapagamento == "0000-00-00" ? "NULL" : "'" . $this->datapagamento . "'";
            $this->valor = strlen($this->valor) > 0 ? $this->valor : "NULL";
            $this->valorparcial = strlen($this->valorparcial) > 0 ? $this->valorparcial : "NULL";
            $this->taxas = strlen($this->taxas) > 0 ? $this->taxas : "NULL";
            $this->desconto = strlen($this->desconto) > 0 ? $this->desconto : "NULL";
            $this->valorfrete = strlen($this->valorfrete) > 0 ? $this->valorfrete : "NULL";
            $this->dataentrega = strlen($this->dataentrega) == 0 || $this->dataentrega == "0000-00-00" ? "NULL" : "'" . $this->dataentrega . "'";
            $this->taxadopagamento = strlen($this->taxadopagamento) > 0 ? $this->taxadopagamento : "NULL";
            $this->total = strlen($this->total) > 0 ? $this->total : "NULL";
            $this->datamodificacao = strlen($this->datamodificacao) == 0 || $this->datamodificacao == "0000-00-00" ? "NULL" : "'" . $this->datamodificacao . "'";
            $this->dataestimadaentrega = strlen($this->dataestimadaentrega) == 0 || $this->dataestimadaentrega == "0000-00-00" ? "NULL" : "'" . $this->dataestimadaentrega . "'";
            $this->totalcomissao = strlen($this->totalcomissao) > 0 ? $this->totalcomissao : "NULL";


            $qrys = "SELECT  codigopedido
            FROM    pedido
            WHERE   1=1
            AND     p.codigopedido = '" . $this->codigopedido . "'";
            $results = mysqli_query($this->link,$qrys); 
            $drs = mysqli_fetch_array($result,MYSQLI_ASSOC);  


            if($drs["codigopedido"] == $this->codigopedido){
                echo " Já existia esse pedido " . $this->codigopedido . "<br><br>";  
            } 


            
        


			if($dr["total"] == '0')
			{
				$qry = "INSERT INTO pedido
				(
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
				)
				VALUES
				(
					'" . 	$this->codigopedido . "',
                    " . 	$this->idpedidostatus . ",
                    " . 	$this->data . ",
                    '" .    $this->codigocliente . "',
                    " .    $this->valorparcial . ",
                    " .    $this->taxas . ",
                    " .    $this->desconto . ",
                    '" .    $this->pontodevenda . "',
                    '" .    $this->metodoentrega . "',
                    '" .    $this->valorfrete . "',
                    " .    $this->dataentrega . ",
                    '" .    $this->cupomdesconto . "',
                    " .    $this->taxadopagamento . ",
                    " .    $this->valor . ",
                    '" .    $this->formapagamento . "',
                    '" .    $this->codigoenviado . "',
                    '" .    $this->idsessao . "',
                    " .    $this->total . ",
                    " .    $this->datapagamento . ",
                    '" .    $this->codigoacesso . "',
                    '" .    $this->integradorremessa . "',
                    " .    $this->datamodificacao . ",
                    '" .    $this->idcotacao . "',
                    " .    $this->dataestimadaentrega . ",
                    '" .    $this->codigoexterno . "',
                    " .    $this->totalcomissao . ",
                    '" .    $this->rastreavel . "'
                )"; 
              
                
                //echo $qry . "<br>";
				mysqli_query($this->link,$qry);
				$this->idpedido = mysqli_insert_id($this->link);;
                $inseriu = true;
                
               
			}
			else
			{
	            /*
                        
                echo "Mudou status";
                $to ="michael.reis@orit.com.br";
                $subj = "teste";
                $emailremetente = "suporte.ti@joia1958.com.br";
                $nome = "Mauro";
                $corpo = "Teste de envio.";
                $bcc = "";
                $cc = "";
                // construção do cabecalho
                $headers = "MIME-Version: 1.0\n";
                $headers .= "Content-Type: text/html; charset='UTF-8'\n";
                $headers .= "From: ".$nome." <".$emailremetente.">\n";
                        
                if(strlen($cc) > 0)
                {
                    $headers .= "Cc: $cc\r\n"; 
                }
            
                if(strlen($bcc) > 0)
                {
                    $headers .= "Bcc: $bcc\r\n";
                }
                $headers .= "Return-Path: <$emailremetente>\n";
                $headers .= "Reply-to: $nome <$emailremetente>\n";
                $headers .= "X-Priority: 1\n"; 
                
                 if(mail($to,$subj,$corpo,$headers)){  // enviando o email
                    echo "email enviado.";
                }else{
                    echo "Ocorreu um erro ao tentar enviar o email";
                }
   
				
				$qry = "UPDATE pedido SET 
                                        codigopedido = '" . $this->codigopedido . "',
                                        idpedidostatus = " . $this->idpedidostatus . ",
                                        data = " . $this->data . ",
                                        codigocliente = '" . $this->codigocliente . "',
                                        valorparcial = " . $this->valorparcial . ",
                                        taxas = " . $this->taxas . ",
                                        desconto = " . $this->desconto . ",
                                        pontodevenda = '" . $this->pontodevenda . "',
                                        metodoentrega = '" . $this->metodoentrega . "',
                                        valorfrete = " . $this->valorfrete . ",
                                        dataentrega = " . $this->dataentrega . ",
                                        cupomdesconto = '" . $this->cupomdesconto . "',
                                        taxadopagamento = " . $this->taxadopagamento . ",
                                        valor = " . $this->valor . ",
                                        formapagamento = '" . $this->formapagamento . "',
                                        codigoenviado = '" . $this->codigoenviado . "',
                                        idsessao = '" . $this->idsessao . "',
                                        total = " . $this->total . ",
                                        datapagamento = " . $this->datapagamento . ",
                                        codigoacesso = '" . $this->codigoacesso . "',
                                        integradorremessa = '" . $this->integradorremessa . "',
                                        datamodificacao = " . $this->datamodificacao . ",
                                        idcotacao = '" . $this->idcotacao . "',
                                        dataestimadaentrega = " . $this->dataestimadaentrega . ",
                                        codigoexterno = '" . $this->codigoexterno . "',
                                        totalcomissao = '" . $this->totalcomissao . "',
                                        rastreavel = '" . $this->rastreavel . "'
                        WHERE codigopedido = '" . $this->codigopedido . "'";
                        //echo $qry . "<br>";

                mysqli_query($this->link,$qry);
                $inseriu = true;

                $qry = "SELECT idpedido
                        FROM    pedido
                        WHERE   codigopedido = '" . $this->codigopedido . "'";
                $result = mysqli_query($this->link,$qry);
                $dr = mysqli_fetch_array($result,MYSQLI_ASSOC);
                $this->idpedido = $dr["idpedido"];
			}

			if($inseriu)
			{
				$this->mensagem = 'Dados gravados com sucesso.';
			}
            return $inseriu;
         */  
            
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
?>