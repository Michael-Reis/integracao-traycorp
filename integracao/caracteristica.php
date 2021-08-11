<?php
    header("Access-Control-Allow-Origin: *");
    include("../conexao.php");
    include("../componentes/tray.php");
    include("../componentes/caracteristica.php");

    $traycomp = new Tray();
    $traycomp->link = $link;
    $traycomp->DadosTray();

    $caracteristicacomp = new Caracteristica();
    $caracteristicacomp->link = $link;
    $caracteristicacomp->accesstokentray = $traycomp->access_token;
    $caracteristicacomp->urltray = $traycomp->url;

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
            if($metodo == "InsereCaracteristica")
            {
                $acao = $_POST["acao"];
                $idcaracteristica = $_POST["id"];
                $nome = $_POST["nome"];
                $valor = $_POST["valor"];

                if(strlen($nome) == 0)
                {
                    $mensagem .= "Favor preencher o Nome da Caracteristica.\n";
                    $erro = "S";
                }
                
                if($erro == "N")
                {
                    $caracteristicacomp->idcaracteristica = $idcaracteristica;
                    $caracteristicacomp->acao = $acao;
                    $caracteristicacomp->propriedade = $nome;
                    $caracteristicacomp->valor = $valor;
                    $caracteristicacomp->ValidaInsercaoCaracteristicaTray();

                    $codigoexterno = $caracteristicacomp->retorno->id;
                    print_r($caracteristicacomp->retorno);

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
