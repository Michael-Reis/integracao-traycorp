<?php
    set_time_limit(99999999);
    include("../conexao.php");
    include("../componentes/tray.php");
    include("../componentes/produto.php");
    include("../componentes/produtocategoria.php");
    include("../componentes/produtocaracteristica.php");

    $traycomp = new Tray();
    $traycomp->link = $link;
    $traycomp->DadosTray();

    $produtocomp = new Produto();
    $produtocomp->link = $link;

    $pccomp = new ProdutoCategoria();
    $pccomp->link = $link; 

    $produtocaracteristica = new ProdutoCaracteristica();
    $produtocaracteristica->link = $link; 

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
    
   
    
    if($code == "200")
    {
        print_r('ok');
        $count = 1;
        $count2 = 1;
        $total = 0;
        $page = 0;
        $offset = 0;
        $limit = 0;
        $maxLimit = 0;
        $limiteregistros = 1;
        
        //print_r($resposta);
        //echo "<br><Br>";
        //exit;  
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
                $totaldepaginas =  ceil($totallinhas / $limit) ;
                //echo $totaldepaginas;
            }
            if($count == 5)
            {
                for($pagina = 1; $pagina <= $totaldepaginas;$pagina++)
                {
                    if($pagina == 1)
                    {
                        for($i=0; $i<$limit; $i++)
                        {
                            //echo "<br><br>"; 
                            //print_r($arraylinha[$i]);
                            //echo "<br><br>"; 
                            $url = $traycomp->url . "/products/" . $arraylinha[$i]->Product->id . "?".http_build_query($params);

                            ob_start();

                            $ch3 = curl_init();
                            curl_setopt($ch3, CURLOPT_URL, $url);
                            curl_setopt($ch3, CURLOPT_CUSTOMREQUEST, "GET");
                            curl_exec($ch3);

                            // JSON de retorno  
                            $resposta3 = json_decode(ob_get_contents());
                            $code3 = curl_getinfo($ch3, CURLINFO_HTTP_CODE);

                            ob_end_clean();
                            curl_close($ch3);

                            $descricao = $resposta3->Product->description;
                            $descricao = $resposta3->Product->description;
                            $descricaocurta = $resposta3->Product->description_small;

                            $produtocomp->dtcriacao = $arraylinha[$i]->Product->created;
                            $produtocomp->produto = $arraylinha[$i]->Product->name;
                            $produtocomp->codigoproduto = $arraylinha[$i]->Product->id;
                            $produtocaracteristica->idproduto = $produtocomp->codigoproduto;
                            $produtocomp->descricao = $descricao;
                            $produtocomp->descricaocurta = $descricaocurta;
                            $produtocomp->ean = $arraylinha[$i]->Product->ean;
                            $produtocomp->datamodificacao = $arraylinha[$i]->Product->modified;
                            $produtocomp->slug = $arraylinha[$i]->Product->slug;
                            $produtocomp->ncm = $arraylinha[$i]->Product->ncm;
                            $produtocomp->temkit = $arraylinha[$i]->Product->is_kit;
                            $produtocomp->preco = $arraylinha[$i]->Product->price;
                            $produtocomp->custo = $arraylinha[$i]->Product->cost_price;
                            $produtocomp->precopromocional = $arraylinha[$i]->Product->promotional_price;
                            $produtocomp->precodolar = $arraylinha[$i]->Product->dollar_cost_price;
                            $produtocomp->iniciopromocao = $arraylinha[$i]->Product->start_promotion;
                            $produtocomp->finalpromocao = $arraylinha[$i]->Product->end_promotion;
                            $produtocomp->marca = $arraylinha[$i]->Product->brand;
                            $produtocomp->modelo = $arraylinha[$i]->Product->model;
                            $produtocomp->peso = $arraylinha[$i]->Product->weight;
                            $produtocomp->comprimento = $arraylinha[$i]->Product->length;
                            $produtocomp->largura = $arraylinha[$i]->Product->width;
                            $produtocomp->altura = $arraylinha[$i]->Product->height;
                            $produtocomp->estoque = $arraylinha[$i]->Product->stock;
                            $produtocomp->idcategoria = $arraylinha[$i]->Product->category_id;
                            $produtocomp->disponivel = $arraylinha[$i]->Product->available;
                            $produtocomp->disponibilidade = $arraylinha[$i]->Product->availability;
                            $produtocomp->referencia = $arraylinha[$i]->Product->reference;
                            $produtocomp->hot = $arraylinha[$i]->Product->hot;
                            $produtocomp->lancamento = $arraylinha[$i]->Product->release;
                            $produtocomp->foto = $arraylinha[$i]->Product->url->https;   
                            
                          
                  
                            //echo "teste";
                            //echo "<br><br><br>";
                            $produtocomp->dataativacao = $arraylinha[$i]->Product->activation_date;
                            $produtocomp->datadesativacao = $arraylinha[$i]->Product->deactivation_date;
                            $produtocomp->ValidaInsercaoProduto();
                            
                            foreach ($arraylinha[$i]->Product->all_categories as $idcategoria)
                            {
                                $pccomp->idprodutocategoria = '';
                                $pccomp->idcategoria = $idcategoria;
                                $pccomp->idproduto = $produtocomp->idproduto;
                                $pccomp->ValidaInsercaoProdutoCategoria();
                            }

                            //caracteristica  
                            foreach ($resposta3->Product->Properties as $chave => $properties) {
                                 
                                foreach ($resposta3->Product->Properties->$chave as $propriedadechave => $registrochave) {
                                  //echo $registrochave;
                                  $produtocaracteristica->caracteristicapai = $chave;
                                  $produtocaracteristica->caracteristicafilho = $registrochave;
                                  $produtocaracteristica->ProdutoInsereCaracteristica();   
                                }
 
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
                        $url = $traycomp->url . "/products/?".http_build_query($params);
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
                                //echo "pagina: " . $pagina . "<br>";
                                //print_r($arraylinha2);
                                //echo "<br><br>";
                                
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
                                for($i2=0; $i2<$limit2 ;$i2++)
                                { 
                                    
                                    //echo "<br><br>";
                                    //echo "linha 2 <br>";
                                    //print_r($arraylinha2[$i2]);

                                    $url = $traycomp->url . "/products/" . $arraylinha2[$i2]->Product->id . "?".http_build_query($params);

                                    ob_start();

                                    $ch4 = curl_init();
                                    curl_setopt($ch4, CURLOPT_URL, $url);
                                    curl_setopt($ch4, CURLOPT_CUSTOMREQUEST, "GET");
                                    curl_exec($ch4);

                                    // JSON de retorno  
                                    $resposta4 = json_decode(ob_get_contents());
                                    $code4 = curl_getinfo($ch4, CURLINFO_HTTP_CODE);

                                    ob_end_clean();
                                    curl_close($ch4);
                                    
                                    $descricao = $resposta4->Product->description;
                                    $descricaocurta = $resposta4->Product->description_small;
                                    
                                    $produtocomp->produto = $arraylinha2[$i2]->Product->name;
                                    $produtocomp->dtcriacao = $arraylinha[$i2]->Product->created;      
                                    $produtocomp->descricao = $descricao;
                                    $produtocomp->descricaocurta = $descricaocurta;
                                    $produtocomp->codigoproduto = $arraylinha2[$i2]->Product->id;
                                    $produtocaracteristica->idproduto =  $arraylinha2[$i2]->Product->id;

                                    $produtocomp->ean = $arraylinha2[$i2]->Product->ean;
                                    $produtocomp->datamodificacao = $arraylinha2[$i2]->Product->modified;
                                    $produtocomp->slug = $arraylinha2[$i2]->Product->slug;
                                    $produtocomp->ncm = $arraylinha2[$i2]->Product->ncm;
                                    $produtocomp->temkit = $arraylinha2[$i2]->Product->is_kit;
                                    $produtocomp->preco = $arraylinha2[$i2]->Product->price;
                                    $produtocomp->custo = $arraylinha2[$i2]->Product->cost_price;
                                    $produtocomp->precopromocional = $arraylinha2[$i2]->Product->promotional_price;
                                    $produtocomp->precodolar = $arraylinha2[$i2]->Product->dollar_cost_price;
                                    $produtocomp->iniciopromocao = $arraylinha2[$i2]->Product->start_promotion;
                                    $produtocomp->finalpromocao = $arraylinha2[$i2]->Product->end_promotion;
                                    $produtocomp->marca = $arraylinha2[$i2]->Product->brand;
                                    $produtocomp->modelo = $arraylinha2[$i2]->Product->model;
                                    $produtocomp->peso = $arraylinha2[$i2]->Product->weight;
                                    $produtocomp->comprimento = $arraylinha2[$i2]->Product->length;
                                    $produtocomp->largura = $arraylinha2[$i2]->Product->width;
                                    $produtocomp->altura = $arraylinha2[$i2]->Product->height;
                                    $produtocomp->estoque = $arraylinha2[$i2]->Product->stock;
                                    $produtocomp->idcategoria = $arraylinha2[$i2]->Product->category_id;
                                    $produtocomp->disponivel = $arraylinha2[$i2]->Product->available;
                                    $produtocomp->disponibilidade = $arraylinha2[$i2]->Product->availability;
                                    $produtocomp->referencia = $arraylinha2[$i2]->Product->reference;
                                    $produtocomp->hot = $arraylinha2[$i2]->Product->hot;
                                    $produtocomp->lancamento = $arraylinha2[$i2]->Product->release;
                                    $produtocomp->foto = $arraylinha2[$i2]->Product->url->https;   
                                    
                                    $produtocomp->dataativacao = $arraylinha2[$i2]->Product->activation_date;
                                    $produtocomp->datadesativacao = $arraylinha2[$i2]->Product->deactivation_date;
                                    $produtocomp->ValidaInsercaoProduto(); 

                                    foreach ($arraylinha2[$i2]->Product->all_categories as $idcategoria)
                                    {
                                        $pccomp->idprodutocategoria = '';
                                        $pccomp->idcategoria = $idcategoria;
                                        $pccomp->idproduto = $produtocomp->idproduto;
                                        $pccomp->ValidaInsercaoProdutoCategoria();  
                                    }
 

                                    //caracteristica  
                                    foreach ($resposta4->Product->Properties as $chave => $properties) {
                                        
                                        foreach ($resposta4->Product->Properties->$chave as $propriedadechave => $registrochave) {
                                            //echo $registrochave;
                                            $produtocaracteristica->caracteristicapai = $chave;
                                            $produtocaracteristica->caracteristicafilho = $registrochave;
                                            $produtocaracteristica->ProdutoInsereCaracteristica(); 
                                        }
        
                                    } 


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
