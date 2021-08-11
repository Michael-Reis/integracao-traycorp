<?php
	class Caracteristicaitem
	{
		public $link = "";
        public $caracteristicadetalhe = "";
        public $idcaracteristica = "";
        public $codigocaracteristicadetalhe = "";
        public $codigocaracteristicapai = "" ;

		public function GetAll()
		{
			$qry = 	"  
                        SELECT idcaracteristicadetalhe, 
                            caracteristicadetalhe, 
                            idcaracteristica, 
                            codigocaracteristicadetalhe, 
                            codigocaracteristicapai 
                        FROM caracteristicadetalhe
                        WHERE 1=1
					";
			//echo $qry;
			$result = mysqli_query($this->link,$qry);
			return $result;
        }

        public function ValidaInsercaoCaracteristicaItem()
		{

			$mensagem = '';
			$podeconsultar = true;
			$podeinserir = true;

			if($podeinserir)
			{
				$this->CaracteristicaItens();
			}
		}

        private function CaracteristicaItens()
		{
            
            $qry = "SELECT  COUNT(0) AS total
                    FROM    caracteristicadetalhe 
                    WHERE   1=1
                    AND     codigocaracteristicadetalhe	 = '" . $this->codigocaracteristicadetalhe	 . "'";
            $result = mysqli_query($this->link,$qry);
            $dr = mysqli_fetch_array($result,MYSQLI_ASSOC);

            $this->codigocaracteristicapai	 = strlen($this->codigocaracteristicapai) > 0 ? $this->codigocaracteristicapai : "0";
            $this->codigocaracteristicadetalhe = strlen($this->codigocaracteristicadetalhe) > 0 ? $this->codigocaracteristicadetalhe : "0";
            $this->caracteristicadetalhe = strlen($this->caracteristicadetalhe) > 0 ? $this->caracteristicadetalhe : "0";
            //echo $this->codigocaracteristicapai;
            //echo $this->codigocaracteristicadetalhe;
            //echo $this->caracteristicadetalhe;
            if($dr["total"] == '0')
			{

				$qry = "INSERT INTO caracteristicadetalhe
				(
                    codigocaracteristicapai,                        
                    codigocaracteristicadetalhe,
                    caracteristicadetalhe,
                    idcaracteristica
				)
				VALUES
				(
                    '" . $this->codigocaracteristicapai . "',
                    '" . $this->codigocaracteristicadetalhe . "',
                    '" . $this->caracteristicadetalhe . "',
                    '" . $this->idcaracteristica . "'
				)";
                //echo $qry . "<br>";
				mysqli_query($this->link,$qry);
				$this->idcaracteristicadetalhe = mysqli_insert_id($this->link);;
				$inseriu = true;
			}
			else
			{
                
				$qry = "UPDATE caracteristicadetalhe SET 
                                caracteristicadetalhe = '" . $this->caracteristicadetalhe . "',
                                idcaracteristica = '" .  $this->idcaracteristica . "',
                                codigocaracteristicadetalhe = '" . $this->codigocaracteristicadetalhe . "',
                                codigocaracteristicapai = '" . $this->codigocaracteristicapai . "'
                        WHERE codigocaracteristicadetalhe = '" . $this->codigocaracteristicadetalhe . "'";
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


		public function DadosCaracteristicaDetalhe()
		{
			$au = $this->GetAll();
			while($du = mysqli_fetch_array($au,MYSQLI_ASSOC))
			{
                $this->caracteristicadetalhe = $du["caracteristicadetalhe"];
                $this->idcaracteristica = $du["idcaracteristica"];
                $this->codigocaracteristicadetalhe = $du["codigocaracteristicadetalhe"];
                $this->codigocaracteristicapai = $du["codigocaracteristicapai"];
			}
        }

	}
?>