<?php
    include("../conexao.php");
    include("../componentes/tray.php");
    include("../componentes/cliente.php");

    $traycomp = new Tray();
    $traycomp->link = $link;
    $traycomp->DadosTray();

    $clientecomp = new Cliente();
    $clientecomp->link = $link;

    $params["access_token"] = $traycomp->access_token;
    $params["page"] = "1";

    $url = $traycomp->url . "/customers/?".http_build_query($params);

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
	print_r($resposta);
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
                            $clientecomp->cliente = $arraylinha[$i]->Customer->name;
                            $clientecomp->codigocliente = $arraylinha[$i]->Customer->id;
                            $clientecomp->cnpj = $arraylinha[$i]->Customer->cnpj;
                            $clientecomp->datacriacao = $arraylinha[$i]->Customer->created;
                            $clientecomp->dataregistro = $arraylinha[$i]->Customer->registration_date;
                            $clientecomp->cpf = $arraylinha[$i]->Customer->cpf;
                            $clientecomp->datanascimento = $arraylinha[$i]->Customer->birth_date;
                            $clientecomp->genero = $arraylinha[$i]->Customer->gender;
                            $clientecomp->email = $arraylinha[$i]->Customer->email;
                            $clientecomp->desconto = $arraylinha[$i]->Customer->discount;
                            $clientecomp->ultimavisita = $arraylinha[$i]->Customer->last_visit;
                            $clientecomp->cidade = $arraylinha[$i]->Customer->city;
                            $clientecomp->uf = $arraylinha[$i]->Customer->state;
                            $clientecomp->newsletter = $arraylinha[$i]->Customer->newsletter;
                            $clientecomp->datamodificacao = $arraylinha[$i]->Customer->modified;
                            
                            $clientecomp->ValidaInsercaoCliente();
                            
                            
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
                                    $clientecomp->cliente = $arraylinha2[$i2]->Customer->name;
                                    $clientecomp->codigocliente = $arraylinha2[$i2]->Customer->id;
                                    $clientecomp->cnpj = $arraylinha2[$i2]->Customer->cnpj;
                                    $clientecomp->datacriacao = $arraylinha2[$i2]->Customer->created;
                                    $clientecomp->dataregistro = $arraylinha2[$i2]->Customer->registration_date;
                                    $clientecomp->cpf = $arraylinha2[$i2]->Customer->cpf;
                                    $clientecomp->datanascimento = $arraylinha2[$i2]->Customer->birth_date;
                                    $clientecomp->genero = $arraylinha2[$i2]->Customer->gender;
                                    $clientecomp->email = $arraylinha2[$i2]->Customer->email;
                                    $clientecomp->desconto = $arraylinha2[$i2]->Customer->discount;
                                    $clientecomp->ultimavisita = $arraylinha2[$i2]->Customer->last_visit;
                                    $clientecomp->cidade = $arraylinha2[$i2]->Customer->city;
                                    $clientecomp->uf = $arraylinha2[$i2]->Customer->state;
                                    $clientecomp->newsletter = $arraylinha2[$i2]->Customer->newsletter;
                                    $clientecomp->datamodificacao = $arraylinha2[$i2]->Customer->modified;
                            
                                    $clientecomp->ValidaInsercaoCliente();
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
