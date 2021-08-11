<?php
    set_time_limit(99999999);
    include("../conexao.php");
    include("../componentes/tray.php");
    include("../componentes/produto.php");
    include("../componentes/produtocategoria.php");

    $traycomp = new Tray();
    $traycomp->link = $link;
    $traycomp->DadosTray();

    $produtocomp = new Produto();
    $produtocomp->link = $link;

    $pccomp = new ProdutoCategoria();
    $pccomp->link = $link;

    $params["access_token"] = $traycomp->access_token;
    $params["page"] = "1";
    $params["sort"] = "id_desc";   

    $url = $traycomp->url . "/products/?".http_build_query($params);

    ob_start();

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_exec($ch);

    // JSON de retorno  
    $resposta = json_decode(ob_get_contents());
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    ob_end_clean();
    curl_close($ch);
    
    echo $code;
    if($code == "200")
    {
        $count = 1;
        $count2 = 1;
        $total = 0;
        $page = 0;
        $offset = 0;
        $limit = 0;
        $maxLimit = 0;
        $limiteregistros = 1;
        
      


        foreach ($resposta as $arraylinha)
        {
           $produto = $arraylinha[0]["Product"]["id"];
           $produto2 = $arraylinha[0]->Product->id;
           $produto3 = $arraylinha[0]->Product["id"];
           print_r($produto2); 
           print_r($produto);
           print_r($produt3);

            //print_r($arraylinha[0]["product"]["id"]);         
            //print_r($arraylinha[0]["Product"]["id"]);         
            //print_r($arraylinha[0]->Product); 


          

            //print_r($arraylinha);
            //echo "<br><br><br>"; 
        }
        
    } 
    
?>
