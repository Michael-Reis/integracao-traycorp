<?php
	class Caracteristica
	{
		public $link = "";
        public $idcaracteristica = "";
		public $caracteristica = "";
		
		public function GetAll()
		{
			$qry = 	"
                        SELECT 	c.idcaracteristica,
                                c.caracteristica,                        
                                c.codigocaracteristica
                        FROM 	caracteristica c                  
						WHERE 	1=1
					";
			//echo $qry;
			$result = mysqli_query($this->link,$qry);
			return $result;
        }

		
        public function ValidaInsercaoCaracteristica()
		{

			$mensagem = '';
			$podeconsultar = true;
			$podeinserir = true;

			if($podeinserir)
			{
				$this->InsertCaracteristica();
			}
        }

		private function InsertCaracteristica()
		{
            
            $qry = "SELECT  COUNT(0) AS total
                    FROM    caracteristica 
                    WHERE   1=1
                    AND     codigocaracteristica	 = '" . $this->codigocaracteristica	 . "'";
            $result = mysqli_query($this->link,$qry);
            $dr = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
            $this->codigocaracteristica	 = strlen($this->codigocaracteristica) > 0 ? $this->codigocaracteristica : "0";
            $this->caracteristica = strlen($this->caracteristica) > 0 ? $this->caracteristica : "0";
           
			if($dr["total"] == '0')
			{

				$qry = "INSERT INTO caracteristica
				(
                    codigocaracteristica,                        
                    caracteristica
				)
				VALUES
				(
                    '" . $this->codigocaracteristica . "',
                    '" . $this->caracteristica . "'
				)";
                echo $qry . "<br>";
				mysqli_query($this->link,$qry);
				
				//ele está pegando o id gerado pelo banco
				$this->idcaracteristica = mysqli_insert_id($this->link);;
				$inseriu = true;
			}
			else
			{
				$qry = "UPDATE caracteristica SET 
                                        caracteristica = '" . $this->caracteristica . "'
                        WHERE codigocaracteristica = '" . $this->codigocaracteristica . "'";
                        //echo $qry . "<br>";
				mysqli_query($this->link,$qry);
				
				$qry = "SELECT  idcaracteristica
						FROM    caracteristica 
						WHERE   1=1
						AND     codigocaracteristica	 = '" . $this->codigocaracteristica	 . "'";
				$result = mysqli_query($this->link,$qry);
				$dr = mysqli_fetch_array($result,MYSQLI_ASSOC);
				$this->idcaracteristica = $dr["idcaracteristica"];
				$inseriu = true;
			}

			if($inseriu)
			{
				$this->mensagem = 'Dados gravados com sucesso.';
			}
			return $inseriu;
        }


		public function DadosCaracteristica()
		{
			$au = $this->GetAll();
			while($du = mysqli_fetch_array($au,MYSQLI_ASSOC))
			{
                $this->caracteristica = $du["caracteristica"];
                $this->caracteristicapai = $du["caracteristicapai"];
                $this->idcaracteristica = $du["idcaracteristica"];
                $this->caracteristicapai = $du["caracteristicapai"];
                $this->codcaracteristica = $du["codcaracteristica"];
                $this->valuecaracteristica = $du["valuecaracteristica"];
			}
        }

	}
?>