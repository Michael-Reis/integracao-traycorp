<?php
	class ProdutoCategoria
	{
		public $link = "";
        public $idprodutocategoria = "";
        public $idcategoria = "";
        public $idproduto = "";

		public function GetAll()
		{
			$qry = 	"
                        SELECT 	idprodutocategoria,
                                idcategoria,
                                idproduto
						FROM 	produtocategoria pp
						WHERE 	1=1
					";
			//echo $qry;
			$result = mysqli_query($this->link,$qry);
			return $result;
		}

		
        public function ValidaInsercaoProdutoCategoria()
		{

			$mensagem = '';
			$podeconsultar = true;
			$podeinserir = true;

			if($podeinserir)
			{
				$this->InsertProdutoCategoria();
			}
		}

		private function InsertProdutoCategoria()
		{
            $inseriu = true;
            $qry = "    SELECT  idproduto
                        FROM    produto
                        WHERE   1=1
                        AND     codigoproduto = '" . $this->idproduto . "'";
            //echo "<br><br> antes do erro".$qry . "<br><br>";
            $result = mysqli_query($this->link,$qry);
            $dp = mysqli_fetch_array($result,MYSQLI_ASSOC);

            $qry = "    SELECT  idcategoria
                        FROM    categoria
                        WHERE   1=1
                        AND     codigocategoria = '" . $this->idcategoria . "'";
            //echo $qry . "<br><br>";
            $result = mysqli_query($this->link,$qry);
            $dc = mysqli_fetch_array($result,MYSQLI_ASSOC);
            
            if(strlen($this->idproduto) > 0 && strlen($this->idcategoria) > 0)
            {
                $qry = "SELECT  COUNT(0) AS total
                        FROM    produtocategoria pp
                        WHERE   1=1
                        AND     pp.idcategoria = " . $dc["idcategoria"] . "
                        AND     pp.idproduto = " . $dp["idproduto"];
                $result = mysqli_query($this->link,$qry);
           
                $dr = mysqli_fetch_array($result,MYSQLI_ASSOC);
                
                if($dr["total"] == '0')
                {

                    $qry = "INSERT INTO produtocategoria
                    (
                        idcategoria,
                        idproduto
                    )
                    VALUES
                    (
                        " . $dc["idcategoria"] . ",
                        " . $dp["idproduto"] . "
                    )";
                    //echo $qry . "<br>";
                    mysqli_query($this->link,$qry);
                    $this->idcategoria = mysqli_insert_id($this->link);;
                    $inseriu = true;
                }

                if($inseriu)
                {
                    $this->mensagem = 'Dados gravados com sucesso.';
                }
            }
            
			return $inseriu;
		}

		public function DadosProdutoCategoria()
		{
			$au = $this->GetAll();
			while($du = mysqli_fetch_array($au,MYSQLI_ASSOC))
			{
                $this->idprodutocategoria = $du["idprodutocategoria"];
                $this->idcategoria = $du["idcategoria"];
                $this->idproduto = $du["idproduto"];
			}
		}
	}
?>