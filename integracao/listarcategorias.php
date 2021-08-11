<?php
    include("../conexao.php");
    include("../componentes/tray.php");
    include("../componentes/categoria.php");

    $traycomp = new Tray();
    $traycomp->link = $link;
    $traycomp->DadosTray();

    $categoriacomp = new Categoria();
    $categoriacomp->link = $link;

    $params["access_token"] = $traycomp->access_token;
    $params["page"] = "1";

    $url = $traycomp->url . "/categories/?".http_build_query($params);

    ob_start();

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_exec($ch);

    // JSON de retorno  
    $respostasemtratamento = ob_get_contents(); 

    
    $resposta = json_decode(str_replace("window.location.href","localizacao",ob_get_contents()));
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    ob_end_clean();
    curl_close($ch);
    
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

        //var_dump($resposta);
        
        
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
                            /*
                            print_r($arraylinha[$i]);
                            echo "<br><br>";
                            */
                            $categoriacomp->categoria = $arraylinha[$i]->Category->name;
                            $categoriacomp->codigocategoria = $arraylinha[$i]->Category->id;
                            $categoriacomp->codigocategoriapai = $arraylinha[$i]->Category->parent_id;
                            $categoriacomp->descricao = $arraylinha[$i]->Category->description;
                            $categoriacomp->ativo = $arraylinha[$i]->Category->active;
                            $categoriacomp->descricaocurta = '';
                            
                            $categoriacomp->ValidaInsercaoCategoria();
                            
                            
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
                        $url = $traycomp->url . "/categories/?".http_build_query($params);
                        //echo $url;
                        ob_start();

                        $ch2 = curl_init();
                        curl_setopt($ch2, CURLOPT_URL, $url);
                        curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, "GET");
                        curl_exec($ch2);

                        // JSON de retorno 
                        $code = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
                        $resposta2 = json_decode(str_replace("window.location.href","localizacao",ob_get_contents()));
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
                                    $categoriacomp->categoria = $arraylinha2[$i2]->Category->name;
                                    $categoriacomp->codigocategoria = $arraylinha2[$i2]->Category->id;
                                    $categoriacomp->codigocategoriapai = $arraylinha2[$i2]->Category->parent_id;
                                    $categoriacomp->descricao = $arraylinha2[$i2]->Category->description;
                                    $categoriacomp->ativo = $arraylinha2[$i2]->Category->active;
                                    $categoriacomp->descricaocurta = '';
                                    
                                    $categoriacomp->ValidaInsercaoCategoria();
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
