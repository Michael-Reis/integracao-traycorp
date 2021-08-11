<?php
	//phpinfo();	
	class ProdutoCaracteristica{
		  
		public $link = ""; 
		public $idcaracteristicaproduto;
		public $idproduto;
		public $caracteristicapai;
		public $caracteristicafilho;


		public function GetAll()
		{
			$qry = 	"  
                        SELECT idcaracteristicaproduto,
							idproduto,
							caracteristicapai,
							caracteristicafilho
						FROM caracteristicaproduto
					";
			//echo $qry;
			$result = mysqli_query($this->link,$qry);
			return $result;
        }


        public function ProdutoInsereCaracteristica()
		{
			//print_r($link);
            $qry = " SELECT * FROM caracteristicaproduto
			WHERE idproduto = '$this->idproduto'
			AND caracteristicapai = '$this->caracteristicapai' 
			AND caracteristicafilho = '$this->caracteristicafilho'"; 
			//print_r($this->link);
			echo $qry;
            $result = mysqli_query($this->link,$qry);
			$quantidadeRegistros = mysqli_num_rows($result);

            if($quantidadeRegistros == 0)
			{

				$qry = "INSERT INTO caracteristicaproduto
				(
                    idproduto,                        
                    caracteristicapai,
                    caracteristicafilho
				)
				VALUES
				(
                    '" . $this->idproduto . "',
                    '" . $this->caracteristicapai . "', 
                    '" . $this->caracteristicafilho . "' 
				)";
                echo $qry . "<br>";
				mysqli_query($this->link,$qry);
				$inseriu = true;
			}
	 

			// if($inseriu)
			// {
			// 	$this->mensagem = 'Dados gravados com sucesso.';
			// }
			//return $inseriu; 
		}


		public function DadosCaracteristicaDetalhe()
		{
			$au = $this->GetAll();
			while($du = mysqli_fetch_array($au,MYSQLI_ASSOC))
			{
                $this->idcaracteristicaproduto = $du["idcaracteristicaproduto"];
                $this->idproduto = $du["idproduto"];
                $this->caracteristicapai = $du["caracteristicapai"];
                $this->caracteristicafilho = $du["caracteristicafilho"]; 
			}
        }

	}
?>