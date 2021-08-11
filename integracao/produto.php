<?php
    header("Access-Control-Allow-Origin: *");
    include("../conexao.php");
    include("../componentes/tray.php");
    include("../componentes/produto.php");

    $traycomp = new Tray();
    $traycomp->link = $link;
    $traycomp->DadosTray();

    $produtocomp = new Produto();
    $produtocomp->link = $link;
    $produtocomp->accesstokentray = $traycomp->access_token;
    $produtocomp->urltray = $traycomp->url;

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
        $metodo = $_POST["metodo"];
        $erro = "N";
        $mensagem = "";
        
        if(strlen($metodo) == 0)
        {
            $erro = "S";
            $mensagem = "Favor enviar um método";

            $arr = array ('erro'=>$erro,'mensagem'=>$mensagem);
            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        }
        else
        {
            if($metodo == "InsereProduto")
            {
                $acao = $_POST["acao"];
                $idproduto = $_POST["idproduto"];
                $nome = $_POST["nome"];

                if(strlen($nome) == 0)
                {
                    $mensagem .= "Favor preencher o Nome da Produto.\n";
                    $erro = "S";
                }
                
                if($erro == "N")
                {
                    $produtocomp->idproduto = $idproduto;
                    $produtocomp->acao = $acao;
                    $produtocomp->produto = $nome;
                    $produtocomp->ean = $_POST["ean"];
                    $produtocomp->descricao = $_POST["descricao"];
                    $produtocomp->descricaocurta = $_POST["descricaocurta"];
                    $produtocomp->preco = $_POST["preco"];
                    $produtocomp->custo = $_POST["custo"];
                    $produtocomp->precopromocional = $_POST["precopromocional"];
                    $produtocomp->iniciopromocao = $_POST["iniciopromocao"];
                    $produtocomp->finalpromocao = $_POST["finalpromocao"];
                    $produtocomp->marca = $_POST["marca"];
                    $produtocomp->modelo = $_POST["modelo"];
                    $produtocomp->peso = $_POST["peso"];
                    $produtocomp->largura = $_POST["largura"];
                    $produtocomp->comprimento = $_POST["comprimento"];
                    $produtocomp->largura = $_POST["largura"];
                    $produtocomp->altura = $_POST["altura"];
                    $produtocomp->estoque = $_POST["estoque"];
                    $produtocomp->idcategoria = $_POST["idcategoria"];
                    $produtocomp->disponivel = $_POST["disponivel"];
                    $produtocomp->disponibilidade = $_POST["disponibilidade"];
                    $produtocomp->diasdisponiveis = $_POST["diasdisponiveis"];
                    $produtocomp->referencia = $_POST["referencia"];
                    $produtocomp->categorias = $_POST["categorias"];
                    $produtocomp->datalancamento = $_POST["datalancamento"];
                    $produtocomp->atalho = $_POST["atalho"];
                    $produtocomp->produtovirtual = $_POST["produtovirtual"];
                    $produtocomp->ValidaInsercaoProdutoTray();
                    $codigoexterno = isset($produtocomp->retorno->id) ? $produtocomp->retorno->id : "";
                    print_r($produtocomp->retorno);

                    $arr = array ('erro'=>$erro,'mensagem'=>$mensagem,'codigoexterno'=>$codigoexterno);
                    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
                }
                else
                {
                    $arr = array ('erro'=>$erro,'mensagem'=>$mensagem);
                    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
                }
            }
                
        }
        
        
    }
    
?>
