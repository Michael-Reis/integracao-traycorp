<?php
    include('whatsapp.php');    

	class PedidoProduto
	{
		public $link = "";
        public $idpedidoproduto = "";
        public $idpedido = ""; 
        public $idproduto = "";  
        public $idpedidostatus = "";  
        public $idcategoria = "";

		public function GetAll()
		{
			$qry = 	"
                        SELECT 	idpedidoproduto,
                                idpedido,
                                idproduto
						FROM 	pedidoproduto pp
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

            $qry = "
                SELECT idpedido, idproduto 
                FROM pedidoproduto
                WHERE idpedido=" . $this->idpedido."
                AND idproduto =" . $this->idproduto."
            ";
            $result = mysqli_query($this->link,$qry); 
            $rows = mysqli_num_rows($result);  


            if($rows== 0){
                $qryInsert = " INSERT INTO pedidoproduto(idpedido,idproduto, status)
                               VALUES($this->idpedido, $this->idproduto,'$this->idpedidostatus' )
                "; 

                mysqli_query($this->link,$qryInsert);
                    
                //nicole    
                enviaWhatsapp($this->idproduto, '11996382142', $this->idpedido, $this->link);  

                //michael 
                enviaWhatsapp($this->idproduto, '11991552015', $this->idpedido, $this->link);         

                //nadia
                enviaWhatsapp($this->idproduto, '11992189414', $this->idpedido, $this->link); 

                //ana
                enviaWhatsapp($this->idproduto, '11991737986', $this->idpedido, $this->link);    
                
                //mercia     
                enviaWhatsapp($this->idproduto, '11992834360', $this->idpedido, $this->link);     
                
                //mauricio   
                enviaWhatsapp($this->idproduto, '11999524384', $this->idpedido, $this->link);        
                //marcos        
                enviaWhatsapp($this->idproduto, '11991738187', $this->idpedido, $this->link);  
                
                //giovanna            
                enviaWhatsapp($this->idproduto, '11975987734', $this->idpedido, $this->link);         
                
                //Daniela Brito 
                enviaWhatsapp($this->idproduto, '11992835220', $this->idpedido, $this->link);         
                
                //rony      
                enviaWhatsapp($this->idproduto, '11999733561', $this->idpedido, $this->link);     
                     
                //Marcia corporativo      
                enviaWhatsapp($this->idproduto, '11992839273', $this->idpedido, $this->link);     

            }else{
                
                $qry2 = "
                SELECT pp.idpedido, pp.idproduto, pp.status
                FROM pedidoproduto pp
				WHERE pp.idpedido = " . $this->idpedido."
				AND pp.idproduto = " . $this->idproduto." 
                "; 

                $resultado = mysqli_query($this->link,$qry2); 

                while ($rowat = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
                   $status = $rowat["status"];    
                } 
                
                if($status <> $this->idpedidostatus ){
                    $qryUpdate = "UPDATE pedidoproduto SET status = '{$this->idpedidostatus}'
                    WHERE idpedido = {$this->idpedido} AND idproduto = {$this->idproduto}";   

                    mysqli_query($this->link, $qryUpdate);
                    echo $qryUpdate;
                     
                    //michael
                    mudancaStatus($this->idproduto,'11991552015', $this->idpedido, $this->link);

                    //nicole
                    mudancaStatus($this->idproduto,'11996382142', $this->idpedido, $this->link);
                    
                    //nadia
                    mudancaStatus($this->idproduto,'11992189414', $this->idpedido, $this->link);
                    
                    //rony
                    mudancaStatus($this->idproduto,'11999733561', $this->idpedido, $this->link);

                    //mauricio
                    mudancaStatus($this->idproduto,'11999524384', $this->idpedido, $this->link);

                    //giovanna
                    mudancaStatus($this->idproduto,'11975987734', $this->idpedido, $this->link);

                    //ana
                    mudancaStatus($this->idproduto,'11991737986', $this->idpedido, $this->link);

                    //dani
                    mudancaStatus($this->idproduto,'11992835220', $this->idpedido, $this->link);  
                
                    //Marcia corporativo   
                    mudancaStatus($this->idproduto,'11992839273', $this->idpedido, $this->link);  
                
                }


            }
    
		}

		public function DadosPedidoProduto()
		{
			$au = $this->GetAll();
			while($du = mysqli_fetch_array($au,MYSQLI_ASSOC))
			{
                $this->idpedidoproduto = $du["idpedidoproduto"];
                $this->idpedido 	   = $du["idpedido"];
                $this->idproduto 	   = $du["idproduto"];
			}
		}
	}
?>