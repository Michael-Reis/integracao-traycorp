<?php
    include("../conexao.php");
    include("../componentes/tray.php");

    $traycomp = new Tray();
    $traycomp->link = $link;
    $traycomp->DadosTray();

    $params["access_token"] = $traycomp->access_token;
    $params["price_range"] = "0";
    $params["page"] = "1";

    $url = $traycomp->url . "/orders/?".http_build_query($params);

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
    
    //echo $code;
    if($code == "200")
    {
        $count = 1;
        $count2 = 1;
        $total = 0;
        $page = 0;
        $offset = 0;
        $limit = 0;
        $maxLimit = 0;

        //print_r($resposta);
        //exit;
        foreach ($resposta as $arraylinha)
        {
            if($count == 1)
            {
                $total = $arraylinha->total;
                $page = $arraylinha->page;
                $offset = $arraylinha->offset;
                $limit = $arraylinha->limit;
                $maxLimit = $arraylinha->maxLimit;
                $totaldepaginas = ceil($total / $maxLimit);
            }
            if($count == 5)
            {
                for($pagina = 1; $pagina <= $totaldepaginas;$pagina++)
                {
                    if($pagina == 1)
                    {
                        for($i=0;$i<$limit;$i++)
                        {
                            print_r($arraylinha[$i]);
                            echo "<br><br>";
                        }
                    }
                    else
                    {
                        $params["page"] = $pagina;
                        $url = $traycomp->url . "/orders/?".http_build_query($params);
                        //echo $url;
                        ob_start();

                        $ch2 = curl_init();
                        curl_setopt($ch2, CURLOPT_URL, $url);
                        curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, "GET");
                        curl_exec($ch2);

                        // JSON de retorno 
                        $code = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
                        $resposta2 = json_decode(ob_get_contents());
                        ob_end_clean();
                        curl_close($ch2);
                        foreach ($resposta2 as $arraylinha2)
                        {
                            
                            if($count2 == 1)
                            {
                                $total2 = $arraylinha2->total;
                                $page2 = $arraylinha2->page;
                                $offset2 = $arraylinha2->offset;
                                $limit2 = $arraylinha2->limit;
                                $maxLimit2 = $arraylinha2->maxLimit;
                                $totaldepaginas2 = ceil($total / $maxLimit);
                            }

                            if($count2 == 5)
                            {
                                echo $limit2;
                                for($i2=0;$i2<$limit2;$i2++)
                                {
                                    print_r($arraylinha2[$i2]);
                                    echo "página 2 <br><br>";
                                }
                            }
                            $count2++;
                        }
                    }
                    
                }
                
            
                
            }
            $count++;
            //print_r($arraylinha);
            //echo "<br><br>";
        }
    }else{
        //Tratamento das mensagens de erro
    }
?>
