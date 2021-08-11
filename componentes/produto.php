<?php
	class Produto
	{
		public $link = "";
        public $idproduto = "";
        public $produto = "";
        public $descricao = "";
        public $descricaocurta = "";
        public $codigoproduto = "";
        public $ean = "";
        public $datamodificacao = "";
        public $slug = "";
        public $ncm = "";
        public $temkit = "";
        public $preco = "";
        public $custo = "";
        public $precopromocional = "";
        public $precodolar = "";
        public $iniciopromocao = "";
        public $finalpromocao = "";
        public $marca = "";
        public $modelo = "";
        public $peso = "";
        public $comprimento = "";
        public $largura = "";
        public $altura = "";
        public $pesocubico = "";
        public $estoque = "";
        public $idcategoria = "";
        public $disponivel = "";
        public $disponibilidade = "";
        public $diasdisponiveis = "";
        public $referencia = "";
        public $hot = "";
        public $lancamento = "";
        public $categorias = "";
        public $datalan = "";
        public $foto = "";
        public $dtcriacao = "";
        public $dataativacao = "";
        public $datadesativacao = "";
        public $produtovirtual = "";
        public $id = "";
        
        public function GetAll()
		{
			$qry = 	"
                        SELECT 	idproduto,
                                produto,
                                codigoproduto,
                                ean,
                                descricao,
                                descricaocurta,
                                datamodificacao,
                                slug,
                                ncm,
                                temkit,
                                preco,
                                custo,
                                precopromocional,
                                precodolar,
                                iniciopromocao,
                                finalpromocao,
                                marca,
                                modelo,
                                peso,
                                comprimento,
                                largura,
                                altura,
                                pesocubico,
                                estoque,
                                idcategoria,
                                disponivel,
                                disponibilidade,
                                referencia,
                                hot,
                                lancamento,
                                foto,
                                dataativacao,
                                datadesativacao
						FROM 	produto p
						WHERE 	1=1
					";
			//echo $qry;
			$result = mysqli_query($this->link,$qry);
			return $result;
		}

        public function ValidaInsercaoProdutoTray()
		{

			$mensagem = '';
			$podeconsultar = true;
			$podeinserir = true;

			if($podeinserir)
			{
				$this->InsertProdutoTray();
			}
		}

		private function InsertProdutoTray()
		{
       
            $id = $this->acao == "Incluir" ? "" : $this->idproduto;
			$tipo = $this->acao == "Incluir" ? "POST" : "PUT";

			$params["access_token"] = $this->accesstokentray;
            
            if(strlen($this->ean) > 0)
            {
                $data["Product"]["ean"] = $this->ean;
            }
            
            if(strlen($this->produto) > 0)
            {
                $data["Product"]["name"] = $this->produto;
            }

            if(strlen($this->descricao) > 0)
            {
                $data["Product"]["description"] = $this->descricao;
            }

            if(strlen($this->descricaocurta) > 0)
            {
                $data["Product"]["description_small"] = $this->descricaocurta;
            }

            if(strlen($this->preco) > 0)
            {
                $data["Product"]["price"] = $this->preco;
            }

            if(strlen($this->custo) > 0)
            {
                $data["Product"]["cost_price"] = $this->custo;
            }

            if(strlen($this->precopromocional) > 0)
            {
                $data["Product"]["promotional_price"] = $this->precopromocional;
            }

            if(strlen($this->iniciopromocao) > 0)
            {
                $data["Product"]["start_promotion"] = $this->iniciopromocao;
            }

            if(strlen($this->finalpromocao) > 0)
            {
                $data["Product"]["end_promotion"] = $this->finalpromocao;
            }

            if(strlen($this->marca) > 0)
            {
                $data["Product"]["brand"] = $this->marca;
            }

            if(strlen($this->modelo) > 0)
            {
                $data["Product"]["model"] = $this->modelo;
            }

            if(strlen($this->peso) > 0)
            {
                $data["Product"]["weight"] = $this->peso;
            }

            if(strlen($this->largura) > 0)
            {
                $data["Product"]["length"] = $this->largura;
            }

            if(strlen($this->comprimento) > 0)
            {
                $data["Product"]["length"] = $this->comprimento;
            }

            if(strlen($this->largura) > 0)
            {
                $data["Product"]["width"] = $this->largura;
            }

            if(strlen($this->altura) > 0)
            {
                $data["Product"]["height"] = $this->altura;
            }

            if(strlen($this->estoque) > 0)
            {
                $data["Product"]["stock"] = $this->estoque;
            }

            if(strlen($this->idcategoria) > 0)
            {
                $data["Product"]["category_id"] = $this->idcategoria;
            }

            if(strlen($this->disponivel) > 0)
            {
                $data["Product"]["available"] = $this->disponivel;
            }

            if(strlen($this->disponibilidade) > 0)
            {
                $data["Product"]["availability"] = $this->disponibilidade;
            }

            if(strlen($this->diasdisponiveis) > 0)
            {
                $data["Product"]["availability_days"] = $this->diasdisponiveis;
            }

            if(strlen($this->referencia) > 0)
            {
                $data["Product"]["reference"] = $this->referencia;
            }

            if(strlen($this->categorias) > 0)
            {
                $data["Product"]["related_categories"] = $this->categorias;
            }

            if(strlen($this->datalancamento) > 0)
            {
                $data["Product"]["release_date"] = $this->datalancamento;
            }

            if(strlen($this->atalho) > 0)
            {
                $data["Product"]["shortcut"] = $this->atalho;
            }

            if(strlen($this->produtovirtual) > 0)
            {
                $data["Product"]["virtual_product"] = $this->produtovirtual;
            }
			
			$url = $this->urltray . "/products/" . $id . "?".http_build_query($params);

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
		
        public function ValidaInsercaoProduto()
		{

			$mensagem = '';
			$podeconsultar = true;
			$podeinserir = true;
            echo "<br><br><br>";
            echo "Rodando a função ValidaInsercaoProduto";
            echo $this->codigoproduto;
            echo "<br><br><br>"; 


			if($podeinserir)
			{
				$this->InsertProduto();
			}
		}

		private function InsertProduto()
		{
            
            $qry = "SELECT  idproduto,codigoproduto
                    FROM    produto c
                    WHERE   1=1
                    AND     c.codigoproduto = '" . $this->codigoproduto . "'";
            $result = mysqli_query($this->link,$qry);
            $dr = mysqli_fetch_array($result,MYSQLI_ASSOC);
            echo "primeira query:" . $qry . "<br><br>";

            if(strlen($this->idcategoria) > 0)
            {
                $qry = "SELECT  idcategoria
                        FROM    categoria
                        WHERE   1=1
                        AND     codigocategoria = '" . $this->idcategoria . "'";
                $result = mysqli_query($this->link,$qry);
                $dc = mysqli_fetch_array($result,MYSQLI_ASSOC);
                $this->idcategoria = $dc["idcategoria"];
            }
            else
            {
                $this->idcategorai = "NULL";
            }
            

            
            $this->preco = strlen($this->preco) == 0 ? "NULL" : $this->preco;
            $this->custo = strlen($this->custo) == 0 ? "NULL" : $this->custo;
            $this->precopromocional = strlen($this->precopromocional) == 0 ? "NULL" : $this->precopromocional;
            $this->precodolar = strlen($this->precodolar) == 0 ? "NULL" : $this->precodolar;
            $this->peso = strlen($this->peso) == 0 ? "NULL" : str_replace(",",".",$this->peso);
            $this->iniciopromocao = strlen($this->iniciopromocao) == 0 || $this->iniciopromocao == "0000-00-00" ? "NULL" : "'" . $this->iniciopromocao . "'";
            $this->finalpromocao = strlen($this->finalpromocao) == 0 || $this->finalpromocao == "0000-00-00" ? "NULL" : "'" . $this->finalpromocao . "'";
            $this->datamodificacao = strlen($this->datamodificacao) == 0 || $this->datamodificacao == "0000-00-00" ? "NULL" : "'" . $this->datamodificacao . "'";
            $this->dataativacao = strlen($this->dataativacao) == 0 || $this->dataativacao == "0000-00-00" ? "NULL" : "'" . $this->dataativacao . "'";
            $this->datadesativacao = strlen($this->datadesativacao) == 0 || $this->datadesativacao == "0000-00-00" ? "NULL" : "'" . $this->datadesativacao . "'";
            $this->comprimento = strlen($this->comprimento) == 0 ? "NULL" : $this->comprimento;
            $this->largura = strlen($this->largura) == 0 ? "NULL" : $this->largura;
            $this->pesocubico = strlen($this->pesocubico) == 0 ? "NULL" : $this->pesocubico;
            $this->estoque = strlen($this->estoque) == 0 ? "NULL" : $this->estoque;
            $this->idcategoria = strlen($this->idcategoria) == 0 ? "NULL" : $this->idcategoria;

            //echo(strlen($dr["idproduto"])); 

            
			if(strlen($dr["idproduto"]) == 0)
			{

				$qry = "INSERT INTO produto
				(
                    produto,
                    codigoproduto,
                    descricao,
                    descricaocurta,
                    ean,
                    datamodificacao,
                    slug,
                    ncm,
                    temkit,
                    preco,
                    custo,
                    precopromocional,
                    precodolar,
                    iniciopromocao,
                    finalpromocao,
                    marca,
                    modelo,
                    peso,
                    comprimento,
                    largura,
                    altura,
                    pesocubico,
                    estoque,
                    idcategoria,
                    disponivel,
                    disponibilidade,
                    referencia,
                    hot,
                    lancamento,
                    foto,
                    dataativacao,
                    dtcriacao,
                    datadesativacao
				)
				VALUES
				(
                    '" . $this->produto . "',
                    '" . $this->codigoproduto . "',
                    '" . $this->descricao . "',
                    '" . $this->descricaocurta . "',
                    '" . $this->ean . "',
                    " . $this->datamodificacao . ",
                    '" . $this->slug . "',
                    '" . $this->ncm . "',
                    '" . $this->temkit . "',
                    " . $this->preco . ",
                    " . $this->custo . ",
                    " . $this->precopromocional . ",
                    " . $this->precodolar . ",
                    " . $this->iniciopromocao . ",
                    " . $this->finalpromocao . ",
                    '" . $this->marca . "',
                    '" . $this->modelo . "',
                    " . $this->peso . ",
                    " . $this->comprimento . ",
                    " . $this->largura . ",
                    " . $this->altura . ",
                    " . $this->pesocubico . ",
                    " . $this->estoque . ",
                    " . $this->idcategoria . ", 
                    '" . $this->disponivel . "',
                    '" . $this->disponibilidade . "',
                    '" . $this->referencia . "',
                    '" . $this->hot . "',
                    '" . $this->lancamento . "',
                    '" . $this->foto . "', 
                    " . $this->dataativacao . ",
                    '" . $this->dtcriacao . "',
                    " . $this->datadesativacao . "
				)";
                echo "inserindo produto" . $this->codigoproduto . "<br><br>" . $qry . "<br><br>";  
				mysqli_query($this->link,$qry);
				$this->idproduto = mysqli_insert_id($this->link);;
				$inseriu = true;
			}
			else
			{
				$qry = "UPDATE produto SET 
                                produto = '" . $this->produto . "',
                                codigoproduto = '" . $this->codigoproduto . "',
                                descricao = '" . $this->descricao . "',
                                descricaocurta = '" . $this->descricaocurta . "',
                                ean = '" . $this->ean . "',
                                datamodificacao = " . $this->datamodificacao . ",
                                slug = '" . $this->slug . "',
                                ncm = '" . $this->ncm . "',
                                temkit = '" . $this->temkit . "',
                                preco = " . $this->preco . ",
                                custo = " . $this->custo . ",
                                precopromocional = " . $this->precopromocional . ",
                                precodolar = " . $this->precodolar . ",
                                iniciopromocao = " . $this->iniciopromocao . ",
                                finalpromocao = " . $this->finalpromocao . ",
                                marca = '" . $this->marca . "',
                                modelo = '" . $this->modelo . "',
                                peso = " . $this->peso . ",
                                comprimento = " . $this->comprimento . ",
                                largura = " . $this->largura . ",
                                altura = " . $this->altura . ",
                                pesocubico = " . $this->pesocubico . ",
                                estoque = " . $this->estoque . ",
                                idcategoria = " . $this->idcategoria . ",
                                disponivel = '" . $this->disponivel . "',
                                disponibilidade = '" . $this->disponibilidade . "',
                                referencia = '" . $this->referencia . "',
                                hot = '" . $this->hot . "',
                                lancamento = '" . $this->lancamento . "',
                                foto = '" . $this->foto . "', 
                                dataativacao = " . $this->dataativacao . ",
                                dtcriacao = '" . $this->dtcriacao . "',  
                                datadesativacao = " . $this->datadesativacao . "
                        WHERE codigoproduto = '" . $this->codigoproduto . "'";
                        echo $qry . "<br>";
                mysqli_query($this->link,$qry);
                $this->idproduto = $dr["idproduto"];
				$inseriu = true;
			}

			if($inseriu)
			{
				$this->mensagem = 'Dados gravados com sucesso.';
			}
			return $inseriu;
		}

		public function DadosProduto()
		{
			$au = $this->GetAll();
			while($du = mysqli_fetch_array($au,MYSQLI_ASSOC))
			{
                $this->produto = $du["produto"];
                $this->codigoproduto = $du["codigoproduto"];
                $this->ean = $du["ean"];
                $this->descricao = $du["descricao"];
                $this->descricaocurta = $du["descricaocurta"];
                $this->datamodificacao = $du["datamodificacao"];
                $this->slug = $du["slug"];
                $this->ncm = $du["ncm"];
                $this->temkit = $du["temkit"];
                $this->preco = $du["preco"];
                $this->custo = $du["custo"];
                $this->precopromocional = $du["precopromocional"];
                $this->precodolar = $du["precodolar"];
                $this->iniciopromocao = $du["iniciopromocao"];
                $this->finalpromocao = $du["finalpromocao"];
                $this->marca = $du["marca"];
                $this->modelo = $du["modelo"];
                $this->peso = $du["peso"];
                $this->comprimento = $du["comprimento"];
                $this->largura = $du["largura"];
                $this->altura = $du["altura"];
                $this->pesocubico = $du["pesocubico"];
                $this->estoque = $du["estoque"];
                $this->idcategoria = $du["idcategoria"];
                $this->disponivel = $du["disponivel"];
                $this->disponibilidade = $du["disponibilidade"];
                $this->referencia = $du["referencia"];
                $this->hot = $du["hot"];
                $this->lancamento = $du["lancamento"];
                $this->foto = $du["foto"];
                $this->dataativacao = $du["dataativacao"];
                $this->datadesativacao = $du["datadesativacao"];
			}
		}
	}
?>