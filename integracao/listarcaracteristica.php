<?php
    include("../conexao.php");
    include("../componentes/tray.php");
    include("../componentes/caracteristica.php");
    include("../componentes/caracteristica_item.php");

    $traycomp = new Tray();
    $traycomp->link = $link;
    $traycomp->DadosTray();
    
    $caracteristicacomp = new Caracteristica();
    $caracteristicacomp->link = $link;

    $caracteristicaitemcomp = new Caracteristicaitem();
    $caracteristicaitemcomp->link = $link;

    $params["access_token"] = $traycomp->access_token;
    $params["page"] = "1";

    $url = $traycomp->url . "/products/properties/?".http_build_query($params);

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
    //var_dump($resposta);
    //exit();
    if($code == 200){
    
        $count = 1;
        $count2 = 1;
        $total = 0;
        $page = 0;
        $offset = 0;
        $limit = 0;
        $maxLimit = 0;
        $limiteregistros = 1;
        //print_r($resposta);
    
        foreach ($resposta as $arraylinha)
        {
            if($count == 1)
            {
                //print_r($arraylinha);
                //echo "<br><br>";
                $totallinhas = $arraylinha->total;
                $page = $arraylinha->page;
                $offset = $arraylinha->offset;
                $limit = $arraylinha->limit;
                $maxLimit = $arraylinha->maxLimit;
                $totaldepaginas = ceil($totallinhas / $limit);
                //echo $totaldepaginas;
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
                            $caracteristicacomp->codigocaracteristica = $arraylinha[$i]->Property->id;
                            $caracteristicacomp->caracteristica = $arraylinha[$i]->Property->name;                      
                            $caracteristicacomp->ValidaInsercaoCaracteristica();

							foreach($arraylinha[$i]->Property->PropertyValues as $propriedade)
                            {      
                                //echo "<br><br>idcaracteristica:";      
                                //echo $caracteristicacomp->idcaracteristica;   
                                //echo "<br><br>property_id:";      
                                //echo $propriedade->property_id;      
                                //echo "<br><br>id:";
                                //echo $propriedade->id;     
                                //echo "<br><br>propriedade: ";
                                //echo $propriedade->name;    

								$caracteristicaitemcomp->idcaracteristica = $caracteristicacomp->idcaracteristica;
								$caracteristicaitemcomp->codigocaracteristicapai = $propriedade->property_id;
								$caracteristicaitemcomp->codigocaracteristicadetalhe = $propriedade->id;
								$caracteristicaitemcomp->caracteristicadetalhe = $propriedade->name; 
                                $caracteristicaitemcomp->ValidaInsercaoCaracteristicaItem();
                            }                      
                            
                            $limiteregistros++;
                            if($limiteregistros > $totallinhas)
                            {
                                break;
                            }
                            
                        }
                    }
                    else
                    {
                        $params["page"] = $pagina;
                        $url = $traycomp->url . "/customers/?".http_build_query($params);
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
                        $count2 = 1;
                        foreach ($resposta2 as $arraylinha2)
                        {
                            
                            if($count2 == 1)
                            {
                                /*
                                echo "pagina: " . $pagina . "<br>";
                                print_r($arraylinha2);
                                echo "<br><br>";
                                */
                                $totallinhas2 = $arraylinha2->total;
                                $page2 = $arraylinha2->page;
                                $offset2 = $arraylinha2->offset;
                                $limit2 = $arraylinha2->limit;
                                $maxLimit2 = $arraylinha2->maxLimit;
                                $totaldepaginas2 = ceil($totallinhas2 / $limit2);
                                
                            }

                            if($count2 == 5)
                            {
                                //echo $limit2;
                                for($i2=0;$i2<$limit2;$i2++)
                                {
                                    /*
                                    echo "<br><br>";
                                    echo "linha 2 <br>";
                                    print_r($arraylinha2[$i2]);
                                    */
                                    foreach($arraylinha[$i]->Property->PropertyValues as $propriedade)
                                    {                            
                                    $caracteristicaitemcomp->codigocaracteristicapai = $propriedade->property_id;
                                    $caracteristicaitemcomp->codigocaracteristicadetalhe = $propriedade->id;
                                    $caracteristicaitemcomp->caracteristicadetalhe = $propriedade->name;
                                    $caracteristicaitemcomp->ValidaInsercaoCaracteristicaItem();
                                    }                          
                                
                                    $caracteristicacomp->codigocaracteristica = $arraylinha[$i]->Property->id;
                                    $caracteristicacomp->caracteristica = $arraylinha[$i]->Property->name;                      
                                    $caracteristicacomp->ValidaInsercaoCaracteristica();

                                    $limiteregistros++;
                                    if($limiteregistros > $totallinhas)
                                    {
                                        break;
                                    }
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
