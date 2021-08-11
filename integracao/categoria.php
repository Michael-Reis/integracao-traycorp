<?php
    header("Access-Control-Allow-Origin: *");
    include("../conexao.php");
    include("../componentes/tray.php");
    include("../componentes/categoria.php");

    $traycomp = new Tray();
    $traycomp->link = $link;
    $traycomp->DadosTray();

    $categoriacomp = new Categoria();
    $categoriacomp->link = $link;
    $categoriacomp->accesstokentray = $traycomp->access_token;
    $categoriacomp->urltray = $traycomp->url;

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
            if($metodo == "InsereCategoria")
            {
                $acao = $_POST["acao"];
                $idcategoria = $_POST["idcategoria"];
                $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
                $codigocategoriapai = isset($_POST["codigocategoriapai"]) ? $_POST["codigocategoriapai"] : "";
                $propriedade = isset($_POST["propriedade"]) ? $_POST["propriedade"] : "";
                
                $categoriacomp->idcategoria = $idcategoria;
                $categoriacomp->acao = $acao;
                $categoriacomp->categoria = $nome;
                $categoriacomp->codigocategoriapai = $codigocategoriapai;
                $categoriacomp->propriedade = $propriedade;
                $categoriacomp->ValidaInsercaoCategoriaTray();

                $codigoexterno = $categoriacomp->retorno->id;
                //print_r($categoriacomp->retorno);
                echo "estou aqui";
                $arr = array ('erro'=>$erro,'mensagem'=>$mensagem,'codigoexterno'=>$codigoexterno);
                echo json_encode($arr,JSON_UNESCAPED_UNICODE);
                
            }
                
        }
        
        
    }
    
?>
