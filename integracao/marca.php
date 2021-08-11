<?php
    header("Access-Control-Allow-Origin: *");
    include("../conexao.php");
    include("../componentes/tray.php");
    include("../componentes/marca.php");

    $traycomp = new Tray();
    $traycomp->link = $link;
    $traycomp->DadosTray();

    $marcacomp = new Marca();
    $marcacomp->link = $link;
    $marcacomp->accesstokentray = $traycomp->access_token;
    $marcacomp->urltray = $traycomp->url;

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
            if($metodo == "InsereMarca")
            {
                $acao = $_POST["acao"];
                $idmarca = $_POST["idmarca"];
                $nome = $_POST["nome"];

                if(strlen($nome) == 0)
                {
                    $mensagem .= "Favor preencher o Nome da Marca.\n";
                    $erro = "S";
                }
                
                if($erro == "N")
                {
                    $marcacomp->idmarca = $idmarca;
                    $marcacomp->acao = $acao;
                    $marcacomp->marca = $nome;
                    $marcacomp->ValidaInsercaoMarcaTray();

                    //print_r($marcacomp->retorno);
                    $codigoexterno = $marcacomp->retorno->id;
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
